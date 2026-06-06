<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Services\SpkService;

class Brand extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'image',
        'satuan',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function score(): HasOne
    {
        return $this->hasOne(BrandScore::class);
    }

    public function rankingResult(): HasOne
    {
        return $this->hasOne(RankingResult::class);
    }

    protected static function booted(): void
    {
        // Recalculate SPK ketika brand dibuat atau dihapus (misal menambah/mengurangi kandidat)
        static::created(function () {
            try {
                (new SpkService())->calculateSawRanking();
            } catch (\Throwable $e) {
            }
        });

        static::deleted(function () {
            try {
                (new SpkService())->calculateSawRanking();
            } catch (\Throwable $e) {
            }
        });
    }
}
