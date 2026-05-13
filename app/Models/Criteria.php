<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Criteria extends Model
{
    protected $fillable = [
        'name',
        'type',
    ];

    public function comparisonsAsFirst(): HasMany
    {
        return $this->hasMany(AhpComparison::class, 'criteria_1_id');
    }

    public function comparisonsAsSecond(): HasMany
    {
        return $this->hasMany(AhpComparison::class, 'criteria_2_id');
    }
}

