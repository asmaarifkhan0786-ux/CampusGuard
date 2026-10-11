@extends('layouts.app')

@section('title', $pageTitle ?? 'Campus Crisis Management')

@section('heading', $pageTitle ?? 'Campus Crisis Management')

@section('content')

<div class="page-heading">
    <div>
        <h1>{{ $pageTitle ?? 'Campus Crisis Management' }}</h1>
        <p class="muted">
            Manage and monitor this CampusGuard module.
        </p>
    </div>
</div><div class="card">
    <div style="padding:24px;">
        <h2>{{ $pageTitle ?? 'Campus Crisis Management' }}</h2>    <p class="muted" style="margin-top:12px;">
        This module page is connected to the main dashboard.
        Its form, table and database functionality can be added here.
    </p>

    <div style="margin-top:24px;">
        <a href="{{ route('dashboard') }}" class="btn btn-primary">
            Back to Dashboard
        </a>
    </div>
</div>

</div>@endsection