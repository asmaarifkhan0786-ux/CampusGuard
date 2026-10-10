<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResponseTeam extends Model
{
    protected $fillable = [
        'name',
        'team_type',
        'leader_name',
        'contact_number',
        'email',
        'location',
        'availability',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }
}