@extends('layouts.admin')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-5">
                <div class="card-header">
                    <h2>{{ $project->title }}</h2>
                </div>
                <div class="card-body">
                    <p><strong>Owner:</strong> {{ $project->owner }}</p>
                    <p><strong>Description:</strong> {{ $project->description }}</p>
                    <p><strong>Type:</strong> {{ $project->type?->name ? $project->type?->name : 'Unknown'  }}</p>
                </div>
            </div>
            <a href="{{ route('admin.projects.edit',['project'=>$project->slug])  }}" class="btn btn-warning fw-bold text-light mt-2">Edit</a>
            <a href="{{route('admin.projects.index')}}" class="btn btn-secondary mt-2">Back</a>
        </div>
    </div>

</div>
@endsection