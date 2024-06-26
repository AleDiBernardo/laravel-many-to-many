@extends('layouts.admin')


@section('content')

<div class="container">
    <h1 class="mt-4 fw-bold">Add Types</h1>
    
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

    <form action="{{ route('admin.types.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>

        <label for="color" class="form-label">Color:</label>

        <select class="form-select" name="color" id="color">
            <option value=""></option>
            @foreach($colors as $color)
                <option value="{{ $color }}">{{ $color }}</option>
            @endforeach
        </select>

        <div>
            <span>Slug:</span>
            <p class="fw-bold" id="slug"></p>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Add</button>
        <a href="{{route('admin.types.index')}}" class="btn btn-secondary mt-2">Cancel</a>

    </form>
    
</div>




@endsection