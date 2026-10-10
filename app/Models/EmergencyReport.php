<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EmergencyReport extends Model
{
    protected $fillable = [
        'user_id',
        'crisis_category_id',
        'title',
        'description',
        'location',
        'priority',
        'status',
        'contact_number',
        'evidence_path',
        'resolved_at',
    ];

    protected function casts(): array
    {
        return [
            'resolved_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(
            CrisisCategory::class,
            'crisis_category_id'
        );
    }
}