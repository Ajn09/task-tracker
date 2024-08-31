@extends('layouts.app')
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<!-- Font Awesome CSS (for icons) -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">


@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-4">Task Tracker</h1>
        <a href="{{ route('tasks.create') }}" class="btn btn-success btn-lg">
    <i class="fas fa-plus"></i> Create Task
</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            @if($tasks && $tasks->count() > 0)
                @foreach($tasks as $task)
                    <div class="card mb-3 border-primary">
                        <div class="card-body">
                            <h5 class="card-title">{{ $task->title }}</h5>
                            <p class="card-text">{{ $task->description }}</p>
                            <p class="card-text">
                                <small class="text-muted">Start: {{ $task->start_date }} | End: {{ $task->end_date }}</small>
                            </p>
                            <p class="card-text">
                                Status: <span class="badge badge-{{ $task->status == 'completed' ? 'success' : ($task->status == 'ongoing' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($task->status) }}
                                </span>
                            </p>
                            <div class="d-flex justify-content-between">
                                <!-- Edit Button -->
                                <form action="{{ route('tasks.edit', $task) }}" method="GET" class="d-inline">
                                    <button type="submit" class="btn btn-info btn-sm">
                                        <i class="fas fa-edit"></i> Edit
                                    </button>
                                </form>

                                <!-- Delete Button -->
                                <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this task?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="alert alert-info" role="alert">
                    No tasks available. Create a new task to get started.
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
