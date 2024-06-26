@extends('layouts.admin')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>{{ $type->name }}</h2>
                </div>
                <div class="card-body">
                    <p><strong>Description:</strong> {{ $type->description }}</p>
                    <p><strong>Color:</strong> {{ $type->color ? $type->color : 'Not setted'  }}</p>
                </div>
            </div>
            <a href="{{ route('admin.types.edit',['type'=>$type->id])  }}" class="btn btn-warning fw-bold text-light mt-2">Edit</a>
            <a href="{{route('admin.types.index')}}" class="btn btn-secondary mt-2">Back</a>
        </div>
    </div>

</div>
@endsection