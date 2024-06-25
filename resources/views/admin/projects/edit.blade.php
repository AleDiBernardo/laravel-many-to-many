@extends('layouts.admin')

@section('content')

<div class="container">
    <h1 class="mt-4 fw-bold">Edit Project</h1>
    
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.projects.update', $project->slug) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $project->title) }}" required>
        </div>

        <div class="form-group">
            <label for="owner">Owner:</label>
            <input type="text" class="form-control" id="owner" name="owner" value="{{ old('owner', $project->owner) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $project->description) }}</textarea>
        </div>

        <label for="type_id" class="form-label">Typology:</label>

        <select class="form-select" name="type_id" id="type_id">
            <option value=""></option>
            @foreach($types as $index => $type)
                <option @selected($project->type_id === $index+1) value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-primary mt-2">Update</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary mt-2">Cancel</a>
    </form>
</div>

@endsection
