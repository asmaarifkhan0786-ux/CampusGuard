@extends('layouts.app')

@section('title', 'Campus Locations')

@section('content')

<div class="page-heading">

    <div>
        <h1>Campus Locations</h1>

        <p class="muted">
            Manage and monitor important locations across the campus.
        </p>
    </div>

</div>


<div class="card">

    <div
        style="
            display:flex;
            align-items:center;
            justify-content:space-between;
            gap:20px;
            margin-bottom:25px;
            padding-bottom:20px;
            border-bottom:1px solid #e8edf5;
        "
    >

        <div>

            <h2 style="margin:0 0 7px;">
                Campus Locations
            </h2>

            <p class="muted" style="margin:0;">
                Important buildings, blocks and emergency response locations.
            </p>

        </div>

        <button
            type="button"
            class="btn btn-primary"
            onclick="alert('Campus location management will be available here.')"
        >
            + Add Location
        </button>

    </div>


    <div
        style="
            display:grid;
            grid-template-columns:repeat(3, 1fr);
            gap:20px;
        "
        class="location-grid"
    >

        {{-- SCIENCE BLOCK --}}
        <div
            style="
                border:1px solid #e4eaf2;
                border-radius:12px;
                padding:20px;
                background:#fff;
            "
        >

            <div
                style="
                    width:45px;
                    height:45px;
                    border-radius:10px;
                    background:#eaf2ff;
                    color:#1769df;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    font-size:20px;
                    margin-bottom:15px;
                "
            >
                📍
            </div>

            <h3 style="margin:0 0 8px;">
                Science Block
            </h3>

            <p
                class="muted"
                style="margin:0 0 12px;"
            >
                Laboratories and science classrooms.
            </p>

            <span class="badge">
                Active
            </span>

        </div>


        {{-- ADMIN BLOCK --}}
        <div
            style="
                border:1px solid #e4eaf2;
                border-radius:12px;
                padding:20px;
                background:#fff;
            "
        >

            <div
                style="
                    width:45px;
                    height:45px;
                    border-radius:10px;
                    background:#eaf2ff;
                    color:#1769df;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    font-size:20px;
                    margin-bottom:15px;
                "
            >
                🏢
            </div>

            <h3 style="margin:0 0 8px;">
                Administration Block
            </h3>

            <p
                class="muted"
                style="margin:0 0 12px;"
            >
                Main administration and management offices.
            </p>

            <span class="badge">
                Active
            </span>

        </div>


        {{-- MAIN GATE --}}
        <div
            style="
                border:1px solid #e4eaf2;
                border-radius:12px;
                padding:20px;
                background:#fff;
            "
        >

            <div
                style="
                    width:45px;
                    height:45px;
                    border-radius:10px;
                    background:#eaf2ff;
                    color:#1769df;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    font-size:20px;
                    margin-bottom:15px;
                "
            >
                🚪
            </div>

            <h3 style="margin:0 0 8px;">
                Main Campus Gate
            </h3>

            <p
                class="muted"
                style="margin:0 0 12px;"
            >
                Main entrance and campus security checkpoint.
            </p>

            <span class="badge">
                Active
            </span>

        </div>


        {{-- LIBRARY --}}
        <div
            style="
                border:1px solid #e4eaf2;
                border-radius:12px;
                padding:20px;
                background:#fff;
            "
        >

            <div
                style="
                    width:45px;
                    height:45px;
                    border-radius:10px;
                    background:#eaf2ff;
                    color:#1769df;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    font-size:20px;
                    margin-bottom:15px;
                "
            >
                📚
            </div>

            <h3 style="margin:0 0 8px;">
                Central Library
            </h3>

            <p
                class="muted"
                style="margin:0 0 12px;"
            >
                Library, study areas and reading rooms.
            </p>

            <span class="badge">
                Active
            </span>

        </div>


        {{-- HOSTELS --}}
        <div
            style="
                border:1px solid #e4eaf2;
                border-radius:12px;
                padding:20px;
                background:#fff;
            "
        >

            <div
                style="
                    width:45px;
                    height:45px;
                    border-radius:10px;
                    background:#eaf2ff;
                    color:#1769df;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    font-size:20px;
                    margin-bottom:15px;
                "
            >
                🏠
            </div>

            <h3 style="margin:0 0 8px;">
                Student Hostels
            </h3>

            <p
                class="muted"
                style="margin:0 0 12px;"
            >
                Residential area for students.
            </p>

            <span class="badge">
                Active
            </span>

        </div>


        {{-- SPORTS AREA --}}
        <div
            style="
                border:1px solid #e4eaf2;
                border-radius:12px;
                padding:20px;
                background:#fff;
            "
        >

            <div
                style="
                    width:45px;
                    height:45px;
                    border-radius:10px;
                    background:#eaf2ff;
                    color:#1769df;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    font-size:20px;
                    margin-bottom:15px;
                "
            >
                🏟
            </div>

            <h3 style="margin:0 0 8px;">
                Sports Area
            </h3>

            <p
                class="muted"
                style="margin:0 0 12px;"
            >
                Sports grounds and outdoor activity areas.
            </p>

            <span class="badge">
                Active
            </span>

        </div>

    </div>

</div>


<style>

    .location-grid .badge {
        display:inline-block;
        padding:5px 10px;
        border-radius:20px;
        background:#eaf8ef;
        color:#176b37;
        font-size:12px;
        font-weight:700;
    }

    @media(max-width:900px) {

        .location-grid {
            grid-template-columns:repeat(2, 1fr) !important;
        }

    }

    @media(max-width:600px) {

        .location-grid {
            grid-template-columns:1fr !important;
        }

    }

</style>

@endsection