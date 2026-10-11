@extends('layouts.app')

@section('title', 'Report an Emergency')

@section('content')

<div class="page-heading">

    <div>
        <h1>Report an Emergency</h1>

        <p class="muted">
            Submit a campus emergency report so the relevant response
            team can review and manage the incident.
        </p>
    </div>

    <a
        href="{{ route('emergency-reports.index') }}"
        class="btn"
    >
        ← Back to Emergency Reports
    </a>

</div>


{{-- SUCCESS MESSAGE --}}
@if (session('success'))

    <div
        class="alert"
        style="
            background:#eaf8ef;
            color:#176b37;
            border:1px solid #bce7ca;
            padding:14px 16px;
            border-radius:10px;
            margin-bottom:20px;
        "
    >
        {{ session('success') }}
    </div>

@endif


{{-- VALIDATION ERRORS --}}
@if ($errors->any())

    <div
        class="alert"
        style="
            background:#fff0f0;
            color:#a51f2b;
            border:1px solid #ffc9ce;
            padding:14px 16px;
            border-radius:10px;
            margin-bottom:20px;
        "
    >

        <strong>
            Please correct the following errors:
        </strong>

        <ul style="margin:8px 0 0 20px;">

            @foreach ($errors->all() as $error)

                <li>{{ $error }}</li>

            @endforeach

        </ul>

    </div>

@endif


{{-- MAIN FORM CARD --}}
<div class="card">

    <div
        style="
            padding-bottom:20px;
            margin-bottom:25px;
            border-bottom:1px solid #e8edf5;
        "
    >

        <h2 style="margin-bottom:7px;">
            Emergency Details
        </h2>

        <p class="muted">
            Fields marked with * are required.
            Provide accurate information so the response team
            can respond quickly.
        </p>

    </div>


    <form
        action="{{ route('emergency-reports.store') }}"
        method="POST"
    >

        @csrf


        <div
            class="emergency-form-grid"
            style="
                display:grid;
                grid-template-columns:1fr 1fr;
                gap:22px;
            "
        >


            {{-- EMERGENCY TITLE --}}
            <div style="grid-column:1 / -1;">

                <label
                    for="title"
                    style="
                        display:block;
                        margin-bottom:8px;
                        font-weight:600;
                    "
                >
                    Emergency Title
                    <span style="color:#dc3545;">*</span>
                </label>

                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title') }}"
                    placeholder="e.g. Fire Emergency in Science Block"
                    maxlength="255"
                    required
                    style="width:100%;"
                >

                @error('title')

                    <div
                        style="
                            color:#dc3545;
                            font-size:13px;
                            margin-top:6px;
                        "
                    >
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- CRISIS CATEGORY --}}
            <div>

                <label
                    for="crisis_category_id"
                    style="
                        display:block;
                        margin-bottom:8px;
                        font-weight:600;
                    "
                >
                    Crisis Category
                </label>

                <select
                    id="crisis_category_id"
                    name="crisis_category_id"
                    style="width:100%;"
                >

                    <option value="">
                        Select category
                    </option>

                    @forelse ($categories as $category)

                        <option
                            value="{{ $category->id }}"
                            {{ (string) old('crisis_category_id') === (string) $category->id ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>

                    @empty

                        <option value="" disabled>
                            No categories available
                        </option>

                    @endforelse

                </select>


                @if ($categories->isEmpty())

                    <p
                        class="muted"
                        style="
                            margin-top:7px;
                            font-size:12px;
                        "
                    >
                        No active categories were found.
                    </p>

                @endif


                @error('crisis_category_id')

                    <div
                        style="
                            color:#dc3545;
                            font-size:13px;
                            margin-top:6px;
                        "
                    >
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- PRIORITY --}}
            <div>

                <label
                    for="priority"
                    style="
                        display:block;
                        margin-bottom:8px;
                        font-weight:600;
                    "
                >
                    Priority
                    <span style="color:#dc3545;">*</span>
                </label>

                <select
                    id="priority"
                    name="priority"
                    style="width:100%;"
                    required
                >

                    <option value="">
                        Select priority
                    </option>

                    <option
                        value="low"
                        {{ old('priority') === 'low' ? 'selected' : '' }}
                    >
                        Low
                    </option>

                    <option
                        value="medium"
                        {{ old('priority') === 'medium' ? 'selected' : '' }}
                    >
                        Medium
                    </option>

                    <option
                        value="high"
                        {{ old('priority') === 'high' ? 'selected' : '' }}
                    >
                        High
                    </option>

                    <option
                        value="critical"
                        {{ old('priority') === 'critical' ? 'selected' : '' }}
                    >
                        Critical
                    </option>

                </select>


                @error('priority')

                    <div
                        style="
                            color:#dc3545;
                            font-size:13px;
                            margin-top:6px;
                        "
                    >
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- LOCATION --}}
            <div style="grid-column:1 / -1;">

                <label
                    for="location"
                    style="
                        display:block;
                        margin-bottom:8px;
                        font-weight:600;
                    "
                >
                    Emergency Location
                    <span style="color:#dc3545;">*</span>
                </label>

                <input
                    type="text"
                    id="location"
                    name="location"
                    value="{{ old('location') }}"
                    placeholder="Building name, room number or campus area"
                    maxlength="255"
                    required
                    style="width:100%;"
                >


                @error('location')

                    <div
                        style="
                            color:#dc3545;
                            font-size:13px;
                            margin-top:6px;
                        "
                    >
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- CONTACT NUMBER --}}
            <div style="grid-column:1 / -1;">

                <label
                    for="contact_number"
                    style="
                        display:block;
                        margin-bottom:8px;
                        font-weight:600;
                    "
                >
                    Contact Number
                </label>

                <input
                    type="tel"
                    id="contact_number"
                    name="contact_number"
                    value="{{ old('contact_number') }}"
                    placeholder="e.g. 03001234567"
                    maxlength="30"
                    style="width:100%;"
                >

                <p
                    class="muted"
                    style="
                        margin-top:7px;
                        font-size:12px;
                    "
                >
                    Enter a number the response team can use
                    to contact the person reporting the incident.
                </p>


                @error('contact_number')

                    <div
                        style="
                            color:#dc3545;
                            font-size:13px;
                            margin-top:6px;
                        "
                    >
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- DESCRIPTION --}}
            <div style="grid-column:1 / -1;">

                <label
                    for="description"
                    style="
                        display:block;
                        margin-bottom:8px;
                        font-weight:600;
                    "
                >
                    Emergency Description
                    <span style="color:#dc3545;">*</span>
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="7"
                    maxlength="5000"
                    required
                    placeholder="Describe what happened, where it happened, and what assistance is required..."
                    style="
                        width:100%;
                        resize:vertical;
                    "
                >{{ old('description') }}</textarea>


                @error('description')

                    <div
                        style="
                            color:#dc3545;
                            font-size:13px;
                            margin-top:6px;
                        "
                    >
                        {{ $message }}
                    </div>

                @enderror

            </div>

        </div>


        {{-- FORM BUTTONS --}}
        <div
            class="form-actions"
            style="
                display:flex;
                justify-content:flex-end;
                gap:12px;
                margin-top:28px;
                padding-top:22px;
                border-top:1px solid #e8edf5;
            "
        >

            <a
                href="{{ route('emergency-reports.index') }}"
                class="btn"
            >
                Cancel
            </a>


            <button
                type="submit"
                class="btn btn-primary"
            >
                Submit Emergency Report →
            </button>

        </div>

    </form>

</div>


<style>

    .emergency-form-grid input,
    .emergency-form-grid select,
    .emergency-form-grid textarea {
        padding:12px 14px;
        border:1px solid #d8e0eb;
        border-radius:8px;
        font-family:inherit;
        font-size:14px;
        background:#fff;
        color:#243b53;
        outline:none;
        box-sizing:border-box;
    }


    .emergency-form-grid input:focus,
    .emergency-form-grid select:focus,
    .emergency-form-grid textarea:focus {
        border-color:#1769df;
        box-shadow:0 0 0 3px rgba(23,105,223,.10);
    }


    .emergency-form-grid label {
        color:#102a43;
    }


    @media(max-width:700px) {

        .emergency-form-grid {
            grid-template-columns:1fr !important;
        }

        .emergency-form-grid > div {
            grid-column:1 / -1 !important;
        }

        .form-actions {
            flex-direction:column;
        }

        .form-actions .btn {
            width:100%;
            text-align:center;
        }

    }

</style>

@endsection