<?php

namespace App\Services;

use App\Models\AhpComparison;
use App\Models\Brand;
use App\Models\BrandScore;
use App\Models\Category;
use App\Models\Criteria;
use App\Models\RankingResult;
use Illuminate\Support\Collection;

/**
 * Service untuk menghitung bobot AHP dan ranking SAW
 *
 * Metode AHP (Analytic Hierarchy Process):
 * - Membuat matriks perbandingan berpasangan
 * - Normalisasi matriks
 * - Menghitung bobot prioritas (eigenvector)
 *
 * Metode SAW (Simple Additive Weighting):
 * - Normalisasi nilai: benefit (x/max) | cost (min/x)
 * - Hitung nilai akhir: jumlah (bobot * nilai normalisasi)
 */
class SpkService
{
    /**
     * Hitung bobot kriteria menggunakan metode AHP
     * Mengembalikan array ['criteria_id' => bobot]
     */
    public function calculateAhpWeights(): array
    {
        $criterias = Criteria::all();
        $n = $criterias->count();

        if ($n === 0) {
            return [];
        }

        // Buat matriks perbandingan n x n
        $matrix = [];
        foreach ($criterias as $c1) {
            foreach ($criterias as $c2) {
                if ($c1->id === $c2->id) {
                    $matrix[$c1->id][$c2->id] = 1.0;
                } else {
                    $comparison = AhpComparison::where('criteria_1_id', $c1->id)
                        ->where('criteria_2_id', $c2->id)
                        ->first();

                    if ($comparison) {
                        $matrix[$c1->id][$c2->id] = (float) $comparison->value;
                    } else {
                        // Cek kebalikannya
                        $reverseComparison = AhpComparison::where('criteria_1_id', $c2->id)
                            ->where('criteria_2_id', $c1->id)
                            ->first();
                        $matrix[$c1->id][$c2->id] = $reverseComparison
                            ? 1 / (float) $reverseComparison->value
                            : 1.0;
                    }
                }
            }
        }

        // Hitung jumlah tiap kolom
        $colSums = [];
        foreach ($criterias as $c2) {
            $colSums[$c2->id] = 0;
            foreach ($criterias as $c1) {
                $colSums[$c2->id] += $matrix[$c1->id][$c2->id];
            }
        }

        // Normalisasi matriks
        $normalizedMatrix = [];
        foreach ($criterias as $c1) {
            foreach ($criterias as $c2) {
                $normalizedMatrix[$c1->id][$c2->id] = $colSums[$c2->id] > 0
                    ? $matrix[$c1->id][$c2->id] / $colSums[$c2->id]
                    : 0;
            }
        }

        // Hitung rata-rata tiap baris = bobot prioritas
        $weights = [];
        foreach ($criterias as $c1) {
            $rowSum = array_sum($normalizedMatrix[$c1->id]);
            $weights[$c1->id] = $rowSum / $n;
        }

        return $weights;
    }

    /**
     * Hitung ranking brand menggunakan metode SAW
     * berdasarkan bobot AHP yang sudah dihitung
     */
    public function calculateSawRanking(): void
    {
        $criterias = Criteria::all();
        $categories = Category::with('brands.score')->get();
        $weights   = $this->calculateAhpWeights();

        if ($categories->isEmpty() || $criterias->isEmpty() || empty($weights)) {
            return;
        }

        // Tentukan jenis tiap kriteria dari database
        // Kriteria dengan nama mengandung 'harga' → cost, lainnya → benefit
        $criteriaTypes = [];
        foreach ($criterias as $c) {
            $criteriaTypes[strtolower($c->name)] = $c->type;
        }

        // Field mapping ke nama kriteria
        $fieldCriteriaMap = [
            'harga'       => 'harga',
            'kualitas'    => 'kualitas',
            'minat_pasar' => 'minat pasar',
        ];

        foreach ($categories as $category) {
            $brands = $category->brands;
            if ($brands->isEmpty()) {
                continue;
            }

            // Kumpulkan nilai tiap kriteria untuk normalisasi per kategori
            // Hanya ambil nilai numerik yang ada (hindari memasukkan 0/null dari brand tanpa score)
            $criteriaValues = [];
            foreach (['harga', 'kualitas', 'minat_pasar'] as $field) {
                $values = $brands->map(fn($b) => $b->score ? $b->score->{$field} : null)
                    ->filter(fn($v) => is_numeric($v))
                    ->map(fn($v) => (float) $v)
                    ->values()
                    ->toArray();

                $criteriaValues[$field] = $values;
            }

            // Tentukan max dan min untuk normalisasi per kategori
            $maxMin = [];
            foreach (['harga', 'kualitas', 'minat_pasar'] as $field) {
                $values = $criteriaValues[$field];

                // fallback jika tidak ada nilai sama sekali
                if (empty($values)) {
                    $max = 1;
                    $min = 1;
                } else {
                    $max = max($values);

                    // Untuk min (cost) gunakan nilai positif terkecil (>0). Jika tidak ada, fallback ke max atau 1.
                    $positive = array_values(array_filter($values, fn($v) => $v > 0));
                    $min = !empty($positive) ? min($positive) : ($max > 0 ? $max : 1);
                }

                $maxMin[$field] = [
                    'max' => $max > 0 ? $max : 1,
                    'min' => $min > 0 ? $min : 1,
                ];
            }

            // Hitung skor SAW untuk setiap brand di kategori ini
            $scores = [];
            foreach ($brands as $brand) {
                if (! $brand->score) {
                    $scores[$brand->id] = 0;
                    continue;
                }

                $finalScore   = 0;
                $detailScores = [];

                foreach (['harga', 'kualitas', 'minat_pasar'] as $field) {
                    $rawValue  = is_numeric($brand->score->{$field}) ? (float) $brand->score->{$field} : 0;
                    $criteriaName = $fieldCriteriaMap[$field];
                    $type = $criteriaTypes[$criteriaName] ?? 'benefit';

                    // Normalisasi SAW
                    if ($type === 'cost') {
                        // Cost: min_positive / nilai (nilai > 0)
                        $normalized = $rawValue > 0
                            ? $maxMin[$field]['min'] / $rawValue
                            : 0;
                    } else {
                        // Benefit: nilai / max
                        $normalized = $maxMin[$field]['max'] > 0
                            ? $rawValue / $maxMin[$field]['max']
                            : 0;
                    }

                    // Cari bobot berdasarkan nama kriteria
                    // Cari criteria id dengan normalisasi nama untuk mengurangi mismatches
                    $normalizedCriteriaName = str_replace(' ', '', strtolower($criteriaName));
                    $criteriaId = $criterias->firstWhere(fn($c) => str_replace(' ', '', strtolower($c->name)) === $normalizedCriteriaName)?->id;

                    $weight = $criteriaId ? ($weights[$criteriaId] ?? 0) : 0;

                    $weightedScore = $normalized * $weight;
                    $finalScore   += $weightedScore;

                    $detailScores[$field] = [
                        'raw'        => $rawValue,
                        'normalized' => round($normalized, 6),
                        'weight'     => round($weight, 6),
                        'weighted'   => round($weightedScore, 6),
                        'type'       => $type,
                    ];
                }

                $scores[$brand->id] = $finalScore;

                // Simpan detail ke tabel ranking_results (update atau create)
                RankingResult::updateOrCreate(
                    ['brand_id' => $brand->id],
                    [
                        'final_score'   => $finalScore,
                        'ranking'       => 0, // akan di-update setelah sorting per kategori
                        'detail_scores' => $detailScores,
                    ]
                );
            }

            // Urutkan dan update ranking per kategori
            arsort($scores);
            $rank = 1;
            foreach ($scores as $brandId => $score) {
                RankingResult::where('brand_id', $brandId)->update(['ranking' => $rank]);
                $rank++;
            }
        }
    }

    /**
     * Hitung Consistency Ratio AHP untuk validasi matriks
     */
    public function calculateConsistencyRatio(): array
    {
        // Random Index (RI) untuk n = 1..10
        $ri = [0, 0, 0, 0.58, 0.90, 1.12, 1.24, 1.32, 1.41, 1.45, 1.49];

        $criterias = Criteria::all();
        $n = $criterias->count();

        if ($n < 2) {
            return ['cr' => 0, 'ci' => 0, 'lambda_max' => 0, 'consistent' => true];
        }

        $weights = $this->calculateAhpWeights();

        // Hitung lambda_max
        $lambdaMax = 0;
        foreach ($criterias as $c1) {
            $weightedSum = 0;
            foreach ($criterias as $c2) {
                $comparison = AhpComparison::where('criteria_1_id', $c1->id)
                    ->where('criteria_2_id', $c2->id)->first()
                    ?? AhpComparison::where('criteria_1_id', $c2->id)
                    ->where('criteria_2_id', $c1->id)->first();

                if ($c1->id === $c2->id) {
                    $val = 1.0;
                } elseif ($comparison) {
                    $val = $comparison->criteria_1_id === $c1->id
                        ? (float) $comparison->value
                        : 1 / (float) $comparison->value;
                } else {
                    $val = 1.0;
                }

                $weightedSum += $val * ($weights[$c2->id] ?? 0);
            }
            if (($weights[$c1->id] ?? 0) > 0) {
                $lambdaMax += $weightedSum / $weights[$c1->id];
            }
        }

        $lambdaMax /= $n;
        $ci = ($lambdaMax - $n) / ($n - 1);
        $riVal = $ri[$n] ?? 1;
        $cr = $riVal > 0 ? $ci / $riVal : 0;

        return [
            'lambda_max' => round($lambdaMax, 4),
            'ci'         => round($ci, 4),
            'cr'         => round($cr, 4),
            'consistent' => $cr <= 0.1,
        ];
    }
}
