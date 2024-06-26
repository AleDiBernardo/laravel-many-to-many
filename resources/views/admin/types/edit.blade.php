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

    <form action="{{ route('admin.types.update', $type->id) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $type->name) }}" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description">{{ old('description', $type->description) }}</textarea>
        </div>

        <div class="form-group">
            <label for="color">Color:</label>
            <select class="form-select" id="color" name="color">
                <option value=""></option>
                @foreach($colors as $color)
                    <option value="{{ $color }}" {{ $color == $type->color ? 'selected' : '' }}>{{ $color }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <span>Slug:</span>
            <p class="fw-bold" id="slug">{{ old('slug',$type->slug) }}</p>
        </div>

        

        <button type="submit" class="btn btn-primary mt-2">Save Changes</button>
        <a href="{{ route('admin.types.index') }}" class="btn btn-secondary mt-2">Cancel</a>
    </form>
</div>

@endsection
