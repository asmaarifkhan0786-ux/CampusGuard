@extends('layouts.app')

@section('title', 'Crisis Categories')
@section('heading', 'Crisis Categories')

@section('content')

<div class="page-heading">
    <div>
        <h1>Crisis Categories</h1>
        <p class="muted">Manage the types of emergencies that can occur on campus.</p>
    </div>

    <a href="{{ route('crisis-categories.create') }}" class="btn btn-primary">
        + Add Category
    </a>
</div>

<div class="card">
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category Name</th>
                    <th>Description</th>
                    <th>Severity</th>
                    <th>Status</th>
                    <th>Created</th>
                </tr>
            </thead>

            <tbody>
                @forelse($categories as $category)
                    <tr>
                        <td>#{{ $category->id }}</td>

                        <td>
                            <strong>{{ $category->name }}</strong>
                        </td>

                        <td>
                            {{ $category->description ?: 'No description provided' }}
                        </td>

                        <td>
                            <span class="badge {{ $category->severity }}">
                                {{ ucfirst($category->severity) }}
                            </span>
                        </td>

                        <td>
                            @if($category->is_active)
                                <span class="badge resolved">Active</span>
                            @else
                                <span class="badge rejected">Inactive</span>
                            @endif
                        </td>

                        <td>{{ $category->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty">
                                <h3>No Crisis Categories Found</h3>
                                <p>Add categories such as Medical, Fire, Security or Natural Disaster.</p>

                                <div style="margin-top:18px;">
                                    <a href="{{ route('crisis-categories.create') }}"
                                       class="btn btn-primary">
                                        + Create First Category
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:20px;">
        {{ $categories->links() }}
    </div>
</div>

@endsection