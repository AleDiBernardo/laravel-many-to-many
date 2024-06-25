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

    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST">
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

        <div class="form-group">
            <label for="type_id">Typology:</label>
            <select class="form-select" id="type_id" name="type_id">
                <option value=""></option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ $project->type_id == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <span>Slug:</span>
            <p class="fw-bold" id="slug">{{ old('slug',$project->slug) }}</p>
        </div>

        <div class="form-group">
            <label for="technologies">Technologies:</label><br>
            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                @foreach ($technologies as $technology)
                    <input type="checkbox" class="btn-check" id="tech-{{ $technology->id }}" name="technologies[]" value="{{ $technology->id }}" {{ $project->technologies->contains($technology->id) ? 'checked' : '' }}>
                    <label class="btn btn-outline-primary" for="tech-{{ $technology->id }}">{{ $technology->name }}</label>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary mt-2">Cancel</a>
    </form>
</div>

@endsection
