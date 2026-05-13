<?php

namespace Database\Seeders;

use App\Models\AhpComparison;
use App\Models\Brand;
use App\Models\BrandScore;
use App\Models\Category;
use App\Models\Criteria;
use Illuminate\Database\Seeder;

class SpkSeeder extends Seeder
{
    /**
     * Seed data sesuai PRD:
     * - 3 Kriteria: Harga (Cost), Kualitas (Benefit), Minat Pasar (Benefit)
     * - 3 Kategori: Semen, Pasir, Cat
     * - 9 Brand total (3 per kategori)
     * - Matriks AHP sesuai PRD
     * - Nilai penilaian brand (contoh)
     */
    public function run(): void
    {
        // ── 1. Kriteria ────────────────────────────────────────────────
        $harga      = Criteria::firstOrCreate(['name' => 'Harga'],      ['type' => 'cost']);
        $kualitas   = Criteria::firstOrCreate(['name' => 'Kualitas'],   ['type' => 'benefit']);
        $minatPasar = Criteria::firstOrCreate(['name' => 'Minat Pasar'],['type' => 'benefit']);

        // ── 2. Perbandingan AHP sesuai matriks PRD ─────────────────────
        // Matriks PRD:
        // Harga vs Kualitas = 1/5  → Kualitas lebih penting dari Harga
        // Harga vs Minat Pasar = 3 → Harga lebih penting dari Minat Pasar
        // Kualitas vs Minat Pasar = 5 → Kualitas lebih penting dari Minat Pasar

        AhpComparison::updateOrCreate(
            ['criteria_1_id' => $harga->id, 'criteria_2_id' => $kualitas->id],
            ['value' => 1 / 5]  // Harga : Kualitas = 1/5
        );
        AhpComparison::updateOrCreate(
            ['criteria_1_id' => $harga->id, 'criteria_2_id' => $minatPasar->id],
            ['value' => 3]      // Harga : Minat Pasar = 3
        );
        AhpComparison::updateOrCreate(
            ['criteria_1_id' => $kualitas->id, 'criteria_2_id' => $minatPasar->id],
            ['value' => 5]      // Kualitas : Minat Pasar = 5
        );

        // ── 3. Kategori ────────────────────────────────────────────────
        $semen = Category::firstOrCreate(['name' => 'Semen'], ['description' => 'Produk semen untuk konstruksi']);
        $pasir = Category::firstOrCreate(['name' => 'Pasir'],  ['description' => 'Produk pasir untuk bangunan']);
        $cat   = Category::firstOrCreate(['name' => 'Cat'],    ['description' => 'Produk cat untuk dinding dan kayu']);

        // ── 4. Brand ───────────────────────────────────────────────────
        // Kategori Semen
        $semenGresik = Brand::firstOrCreate(['name' => 'Semen Gresik', 'category_id' => $semen->id]);
        $tigaRoda    = Brand::firstOrCreate(['name' => 'Tiga Roda',    'category_id' => $semen->id]);
        $dynamix     = Brand::firstOrCreate(['name' => 'Dynamix',      'category_id' => $semen->id]);

        // Kategori Pasir
        $pasirLumajang = Brand::firstOrCreate(['name' => 'Pasir Lumajang', 'category_id' => $pasir->id]);
        $pasirBangka   = Brand::firstOrCreate(['name' => 'Pasir Bangka',   'category_id' => $pasir->id]);
        $pasirCilegon  = Brand::firstOrCreate(['name' => 'Pasir Cilegon',  'category_id' => $pasir->id]);

        // Kategori Cat
        $avian      = Brand::firstOrCreate(['name' => 'Avian',       'category_id' => $cat->id]);
        $nipponPaint = Brand::firstOrCreate(['name' => 'Nippon Paint','category_id' => $cat->id]);
        $dulux      = Brand::firstOrCreate(['name' => 'Dulux',        'category_id' => $cat->id]);

        // ── 5. Nilai Penilaian Brand ───────────────────────────────────
        // Semen (nilai contoh: Harga=harga relatif, Kualitas & Minat Pasar=skor 1-10)
        BrandScore::updateOrCreate(['brand_id' => $semenGresik->id], ['harga' => 8, 'kualitas' => 9, 'minat_pasar' => 9]);
        BrandScore::updateOrCreate(['brand_id' => $tigaRoda->id],    ['harga' => 7, 'kualitas' => 8, 'minat_pasar' => 7]);
        BrandScore::updateOrCreate(['brand_id' => $dynamix->id],     ['harga' => 6, 'kualitas' => 7, 'minat_pasar' => 6]);

        // Pasir
        BrandScore::updateOrCreate(['brand_id' => $pasirLumajang->id], ['harga' => 9, 'kualitas' => 9, 'minat_pasar' => 8]);
        BrandScore::updateOrCreate(['brand_id' => $pasirBangka->id],   ['harga' => 7, 'kualitas' => 8, 'minat_pasar' => 7]);
        BrandScore::updateOrCreate(['brand_id' => $pasirCilegon->id],  ['harga' => 8, 'kualitas' => 7, 'minat_pasar' => 6]);

        // Cat
        BrandScore::updateOrCreate(['brand_id' => $avian->id],       ['harga' => 6, 'kualitas' => 8, 'minat_pasar' => 9]);
        BrandScore::updateOrCreate(['brand_id' => $nipponPaint->id],  ['harga' => 8, 'kualitas' => 9, 'minat_pasar' => 8]);
        BrandScore::updateOrCreate(['brand_id' => $dulux->id],        ['harga' => 9, 'kualitas' => 9, 'minat_pasar' => 7]);
    }
}
