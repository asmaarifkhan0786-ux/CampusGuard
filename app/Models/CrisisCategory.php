<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CrisisCategory extends Model
{
    protected $fillable = [
        'name',
        'description',
        'severity',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function reports(): HasMany
    {
        return $this->hasMany(
            EmergencyReport::class,
            'crisis_category_id'
        );
    }
}