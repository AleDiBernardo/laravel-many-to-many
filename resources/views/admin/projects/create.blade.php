@extends('layouts.admin')


@section('content')

<div class="container">
    <h1 class="mt-4 fw-bold">Add Project</h1>
    
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

    <form action="{{ route('admin.projects.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="owner">Owner:</label>
            <input type="text" class="form-control" id="owner" name="owner" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <label for="type_id" class="form-label">Typology:</label>

        <select class="form-select" name="type_id" id="type_id">
            <option value=""></option>
            @foreach($types as $type)
                <option value="{{ $type->id }}">{{ $type->name }}</option>
            @endforeach
        </select>

        <div>
            <span>Slug:</span>
            <p class="fw-bold" id="slug"></p>
        </div>
        

        <button type="submit" class="btn btn-primary mt-2">Add</button>
        <a href="{{route('admin.projects.index')}}" class="btn btn-secondary mt-2">Cancel</a>

    </form>
</div>




@endsection