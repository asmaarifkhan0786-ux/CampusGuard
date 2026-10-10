<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IncidentAssignment extends Model
{
    protected $fillable = [
        'emergency_report_id',
        'response_team_id',
        'assigned_by',
        'assigned_at',
        'completed_at',
        'notes',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'assigned_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function report(): BelongsTo
    {
        return $this->belongsTo(
            EmergencyReport::class,
            'emergency_report_id'
        );
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(ResponseTeam::class, 'response_team_id');
    }

    public function assignedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_by');
    }
}
