<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AhpComparison extends Model
{
    protected $fillable = [
        'criteria_1_id',
        'criteria_2_id',
        'value',
    ];

    protected $casts = [
        'value' => 'decimal:4',
    ];

    public function criteria1(): BelongsTo
    {
        return $this->belongsTo(Criteria::class, 'criteria_1_id');
    }

    public function criteria2(): BelongsTo
    {
        return $this->belongsTo(Criteria::class, 'criteria_2_id');
    }
}
