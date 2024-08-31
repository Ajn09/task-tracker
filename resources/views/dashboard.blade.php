@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="d-flex justify-content-center">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="text-center">
                        <h3 class="text-2xl font-bold mb-4">{{ __("Welcome, " . Auth::user()->name . "!") }}</h3>
                        <a href="{{ route('tasks.index') }}" class="btn btn-primary">
                            Go to Tasks
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
