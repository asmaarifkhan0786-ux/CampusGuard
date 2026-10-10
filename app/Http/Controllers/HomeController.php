<?php

namespace App\Http\Controllers;

use App\Models\CrisisCategory;
use App\Models\EmergencyAlert;

class HomeController extends Controller
{
    public function index()
    {
        $categories = CrisisCategory::where('is_active', true)
            ->orderBy('name')
            ->get();

        $alerts = EmergencyAlert::where('is_active', true)
            ->where(function ($query) {
                $query->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->latest()
            ->take(5)
            ->get();

        return view('home', compact('categories', 'alerts'));
    }
}
