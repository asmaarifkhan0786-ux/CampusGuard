@extends('layouts.app')

@section('title', 'Add Crisis Category')
@section('heading', 'Add Crisis Category')

@section('content')

<div class="page-heading">
    <div>
        <h1>Create Crisis Category</h1>
        <p class="muted">
            Add a category to classify campus emergencies.
        </p>
    </div>

    <a href="{{ route('crisis-categories.index') }}" class="btn btn-secondary">
        ← Back to Categories
    </a>
</div>

<div class="card" style="max-width:850px;">

    <form action="{{ route('crisis-categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Category Name *</label>

            <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="e.g. Medical Emergency"
                maxlength="255"
                required
            >

            <p class="muted" style="margin-top:6px;">
                Examples: Medical, Fire, Security, Natural Disaster.
            </p>
        </div>

        <div class="form-group">
            <label for="description">Description</label>

            <textarea
                id="description"
                name="description"
                maxlength="2000"
                placeholder="Describe this emergency category..."
            >{{ old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="severity">Default Severity *</label>

            <select id="severity" name="severity" required>
                <option value="low" {{ old('severity') == 'low' ? 'selected' : '' }}>
                    Low
                </option>

                <option value="medium" {{ old('severity', 'medium') == 'medium' ? 'selected' : '' }}>
                    Medium
                </option>

                <option value="high" {{ old('severity') == 'high' ? 'selected' : '' }}>
                    High
                </option>

                <option value="critical" {{ old('severity') == 'critical' ? 'selected' : '' }}>
                    Critical
                </option>
            </select>
        </div>

        <div style="background:#f8fafc;padding:15px;border-radius:8px;margin-bottom:22px;">
            <strong style="font-size:13px;">Category Guidelines</strong>

            <p class="muted" style="margin-top:7px;">
                Choose the default severity carefully. The actual priority of an
                emergency report can still depend on the situation.
            </p>
        </div>

        <button type="submit" class="btn btn-primary">
            Save Category
        </button>

        <a href="{{ route('crisis-categories.index') }}"
           class="btn btn-secondary"
           style="margin-left:8px;">
            Cancel
        </a>

    </form>

</div>

@endsection