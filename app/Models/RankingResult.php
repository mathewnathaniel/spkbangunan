<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RankingResult extends Model
{
    protected $fillable = [
        'brand_id',
        'final_score',
        'ranking',
        'detail_scores',
    ];

    protected $casts = [
        'final_score'   => 'decimal:6',
        'detail_scores' => 'array',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
