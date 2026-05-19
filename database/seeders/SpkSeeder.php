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
        $semenGresik = Brand::updateOrCreate(['name' => 'Semen Gresik', 'category_id' => $semen->id], ['satuan' => '50 kg']);
        $tigaRoda    = Brand::updateOrCreate(['name' => 'Tiga Roda',    'category_id' => $semen->id], ['satuan' => '50 kg']);
        $dynamix     = Brand::updateOrCreate(['name' => 'Dynamix',      'category_id' => $semen->id], ['satuan' => '50 kg']);

        // Kategori Pasir
        $pasirLumajang = Brand::updateOrCreate(['name' => 'Pasir Lumajang', 'category_id' => $pasir->id], ['satuan' => 'per m3']);
        $pasirBangka   = Brand::updateOrCreate(['name' => 'Pasir Bangka',   'category_id' => $pasir->id], ['satuan' => 'per m3']);
        $pasirCilegon  = Brand::updateOrCreate(['name' => 'Pasir Cilegon',  'category_id' => $pasir->id], ['satuan' => 'per m3']);

        // Kategori Cat
        $avian       = Brand::updateOrCreate(['name' => 'Avian',        'category_id' => $cat->id], ['satuan' => '5 kg']);
        $nipponPaint = Brand::updateOrCreate(['name' => 'Nippon Paint', 'category_id' => $cat->id], ['satuan' => '5 kg']);
        $dulux       = Brand::updateOrCreate(['name' => 'Dulux',        'category_id' => $cat->id], ['satuan' => '5 kg']);

        // ── 5. Nilai Penilaian Brand ───────────────────────────────────
        // Semen (nilai contoh: Harga=harga relatif, Kualitas & Minat Pasar=skor 1-10)
        BrandScore::updateOrCreate(['brand_id' => $semenGresik->id], ['harga' => 70000, 'kualitas' => 92, 'minat_pasar' => 95]);
        BrandScore::updateOrCreate(['brand_id' => $tigaRoda->id],    ['harga' => 70000, 'kualitas' => 90, 'minat_pasar' => 88]);
        BrandScore::updateOrCreate(['brand_id' => $dynamix->id],     ['harga' => 68000, 'kualitas' => 85, 'minat_pasar' => 80]);

        // Pasir
        BrandScore::updateOrCreate(['brand_id' => $pasirLumajang->id], ['harga' => 280000, 'kualitas' => 90, 'minat_pasar' => 85]);
        BrandScore::updateOrCreate(['brand_id' => $pasirBangka->id],   ['harga' => 320000, 'kualitas' => 95, 'minat_pasar' => 80]);
        BrandScore::updateOrCreate(['brand_id' => $pasirCilegon->id],  ['harga' => 250000, 'kualitas' => 80, 'minat_pasar' => 75]);

        // Cat
        BrandScore::updateOrCreate(['brand_id' => $avian->id],        ['harga' => 165000, 'kualitas' => 80, 'minat_pasar' => 85]);
        BrandScore::updateOrCreate(['brand_id' => $nipponPaint->id],  ['harga' => 210000, 'kualitas' => 95, 'minat_pasar' => 90]);
        BrandScore::updateOrCreate(['brand_id' => $dulux->id],        ['harga' => 235000, 'kualitas' => 98, 'minat_pasar' => 92]);
    }
}
