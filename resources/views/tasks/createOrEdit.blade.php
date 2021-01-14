@extends('layout')

@section('title')
    @if(!$task->exists)
        Create new task
    @else
        Edit task #{{ $task->id }}
    @endif
@endsection

@section('content')
    <form action="{{ !$task->exists ? route('tasks.store') : route('tasks.update', $task) }}" method="POST">
        @csrf
        @if($task->exists)
            @method('PUT')
        @endif
        <div class="mb-3">
            <label class="form-label" for="title">Title</label>
            <input
                class="form-control @error('title') is-invalid @enderror"
                type="text"
                id="title"
                name="title"
                placeholder="To do something"
                value="{{ old('title', $task->title) }}"
                required
            >
            @error('title')
            <div class="invalid-feedback">
                {{ $errors->first('title') }}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label" for="description">Description</label>
            <textarea
                class="form-control"
                id="description"
                name="description"
                placeholder="What exactly has to be done"
                rows="15"
            >{{ old('description', $task->description) }}</textarea>
        </div>
        <div class="mb-3">
            <input
                class="btn btn-primary"
                type="submit"
                value="{{ !$task->exists ? 'Create' : 'Update' }}"
            >
            <a
                class="btn btn-secondary"
                href="{{ route('tasks.index') }}"
            >Cancel</a>
        </div>
    </form>
@endsection
