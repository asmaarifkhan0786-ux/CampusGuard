<?php

namespace App\Http\Controllers;

use App\Models\EmergencyAlert;
use App\Models\EmergencyReport;
use App\Models\ResponseTeam;
use App\Models\IncidentAssignment;

class DashboardController extends Controller
{
    public function index()
    {
        // Currently logged-in admin
        $user = auth()->user();

        // Total emergency reports
        $totalReports = EmergencyReport::count();

        // Pending reports
        $pendingReports = EmergencyReport::where(
            'status',
            'pending'
        )->count();

        // Active reports
        $activeReports = EmergencyReport::whereIn('status', [
            'under_review',
            'assigned',
            'in_progress',
        ])->count();

        // Resolved reports
        $resolvedReports = EmergencyReport::where(
            'status',
            'resolved'
        )->count();

        // Total active response teams
        $totalTeams = ResponseTeam::where(
            'is_active',
            true
        )->count();

        // Available response teams
        $availableTeams = ResponseTeam::where(
            'is_active',
            true
        )->where(
            'availability',
            'available'
        )->count();

        // Active emergency alerts
        $activeAlerts = EmergencyAlert::where(
            'is_active',
            true
        )
            ->where(function ($query) {
                $query->whereNull('starts_at')
                    ->orWhere('starts_at', '<=', now());
            })
            ->where(function ($query) {
                $query->whereNull('expires_at')
                    ->orWhere('expires_at', '>', now());
            })
            ->latest()
            ->get();

        // Recent emergency reports
        $recentReports = EmergencyReport::with([
            'user',
            'category',
        ])
            ->latest()
            ->take(8)
            ->get();

        // Recent incident assignments
        $recentAssignments = IncidentAssignment::with([
            'report',
            'team',
        ])
            ->latest()
            ->take(5)
            ->get();

        // Return dashboard with all required data
        return view('dashboard', compact(
            'user',
            'totalReports',
            'pendingReports',
            'activeReports',
            'resolvedReports',
            'totalTeams',
            'availableTeams',
            'activeAlerts',
            'recentReports',
            'recentAssignments'
        ));
    }
}