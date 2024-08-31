@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="display-4">Edit Task</h1>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary btn-lg">
            <i class="fas fa-arrow-left"></i> Back to Task List
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" id="description" name="description">{{ $task->description }}</textarea>
                </div>

                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" class="form-control" id="start_date" name="start_date" value="{{ \Carbon\Carbon::parse($task->start_date)->format('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" class="form-control" id="end_date" name="end_date" value="{{ \Carbon\Carbon::parse($task->end_date)->format('Y-m-d') }}" required>
                </div>

                <div class="form-group">
                    <label for="status">Status</label>
                    <select class="form-control" id="status" name="status" required>
                        <option value="not started" {{ $task->status == 'not started' ? 'selected' : '' }}>Not Started</option>
                        <option value="ongoing" {{ $task->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                        <option value="completed" {{ $task->status == 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Update Task
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
