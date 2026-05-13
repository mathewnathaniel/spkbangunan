<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Brand extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
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
}
