<?php

namespace App\Http\Controllers;

use App\Models\EmergencyReport;
use App\Models\CrisisCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class EmergencyReportController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Admin - All Emergency Reports
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $reports = EmergencyReport::with(['user', 'category'])
            ->latest()
            ->paginate(10);

        $totalIncidents = EmergencyReport::count();

        return view('emergency-reports.index', compact(
            'reports',
            'totalIncidents'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | Student - Create Emergency Report
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        if (!Auth::check()) {
            return redirect()
                ->route('student.login')
                ->with('error', 'Please log in to submit an emergency report.');
        }

        $categories = CrisisCategory::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'emergency-reports.create',
            compact('categories')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Student - Store Emergency Report
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()
                ->route('student.login')
                ->with('error', 'Please log in before submitting a report.');
        }

        // Only students can submit reports through the student portal.
        if (Auth::user()->role !== 'student') {
            abort(403, 'Only student accounts can submit emergency reports.');
        }

        $data = $request->validate([
            'crisis_category_id' => [
                'nullable',
                'integer',
                Rule::exists('crisis_categories', 'id')
                    ->where('is_active', true),
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
                'max:5000',
            ],

            'location' => [
                'required',
                'string',
                'max:255',
            ],

            'priority' => [
                'required',
                Rule::in([
                    'low',
                    'medium',
                    'high',
                    'critical',
                ]),
            ],

            'contact_number' => [
                'nullable',
                'string',
                'max:30',
            ],
        ]);

        // Automatically attach the logged-in student's ID.
        $data['user_id'] = Auth::id();

        // New reports start as pending.
        $data['status'] = 'pending';

        // Save report in database.
        EmergencyReport::create($data);

        /*
        |--------------------------------------------------------------------------
        | IMPORTANT
        |--------------------------------------------------------------------------
        | Do NOT redirect the student to emergency-reports.index.
        | That page belongs to the admin portal.
        |
        | Instead, return to the student report form and show a
        | successful submission message.
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('emergency-reports.create')
            ->with(
                'success',
                'Your emergency report has been submitted successfully. The response team will review it shortly.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Admin - View Single Report
    |--------------------------------------------------------------------------
    */

    public function show(EmergencyReport $emergencyReport)
    {
        $emergencyReport->load([
            'user',
            'category',
            'assignments.team',
        ]);

        return view(
            'emergency-reports.show',
            compact('emergencyReport')
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Admin - Edit Report
    |--------------------------------------------------------------------------
    */

    public function edit(EmergencyReport $emergencyReport)
    {
        $categories = CrisisCategory::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view(
            'emergency-reports.edit',
            compact(
                'emergencyReport',
                'categories'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Admin - Update Report
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        EmergencyReport $emergencyReport
    ) {
        $data = $request->validate([
            'crisis_category_id' => [
                'nullable',
                'integer',
                Rule::exists('crisis_categories', 'id')
                    ->where('is_active', true),
            ],

            'title' => [
                'required',
                'string',
                'max:255',
            ],

            'description' => [
                'required',
                'string',
                'max:5000',
            ],

            'location' => [
                'required',
                'string',
                'max:255',
            ],

            'priority' => [
                'required',
                Rule::in([
                    'low',
                    'medium',
                    'high',
                    'critical',
                ]),
            ],

            'status' => [
                'required',
                Rule::in([
                    'pending',
                    'under_review',
                    'assigned',
                    'in_progress',
                    'resolved',
                    'rejected',
                ]),
            ],

            'contact_number' => [
                'nullable',
                'string',
                'max:30',
            ],
        ]);

        $data['resolved_at'] = $data['status'] === 'resolved'
            ? ($emergencyReport->resolved_at ?? now())
            : null;

        $emergencyReport->update($data);

        return redirect()
            ->route('emergency-reports.index')
            ->with(
                'success',
                'Emergency report updated successfully.'
            );
    }


    /*
    |--------------------------------------------------------------------------
    | Admin - Delete Report
    |--------------------------------------------------------------------------
    */

    public function destroy(EmergencyReport $emergencyReport)
    {
        $emergencyReport->delete();

        return redirect()
            ->route('emergency-reports.index')
            ->with(
                'success',
                'Emergency report deleted successfully.'
            );
    }
}