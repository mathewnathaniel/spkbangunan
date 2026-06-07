<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Services\SpkService;

class BrandScore extends Model
{
    protected $fillable = [
        'brand_id',
        'harga',
        'kualitas',
        'minat_pasar',
    ];

    protected $casts = [
        'harga'       => 'decimal:2',
        'kualitas'    => 'decimal:2',
        'minat_pasar' => 'decimal:2',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    protected static function booted(): void
    {
        // Recalculate SPK setiap kali skor brand berubah atau dihapus
        static::saved(function (self $model) {
            try {
                (new SpkService())->calculateSawRanking();
            } catch (\Throwable $e) {
                // jangan lempar exception di model events — log jika perlu
            }
        });

        static::deleted(function (self $model) {
            try {
                (new SpkService())->calculateSawRanking();
            } catch (\Throwable $e) {
                // jangan lempar exception di model events — log jika perlu
            }
        });
    }
}
