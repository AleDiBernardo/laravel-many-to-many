@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="ms-table-container mt-5">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="fw-bold">Types</h1>
                
                <div class="d-flex flex-column">
                    <a href="{{route('admin.types.create')}}" class="btn btn-primary fw-bold">Add New </a>
            <span class="fw-bold">Total row: <?= count($types)?> </span>

                </div>
                
            </div>
            <hr>
            
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Color</th>
                        <th scope="col">Functions</th>
                    </tr>
                    </thead>
                    <tbody>

                        @foreach ($types as $curType)
                            <tr>
                                <th scope="row">{{ $loop->index + 1}}</th>
                                <td>{{ $curType->name }}</td>
                                <td>{{ $curType->description }}</td>
                                <td>{{ $curType->color ? $curType->color : 'Not Setted' }}</td>

                                {{-- @if (count($curType->technologies) > 0)
                                    
                                    <td>{{ count($curType->technologies) }}</td>
                                @else
                                    <td> None </td>
                                @endif --}}

                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ route('admin.types.show',['type'=>$curType->id])  }}" class="btn btn-success fw-bold text-light">Details</a>
                                        <a href="{{ route('admin.types.edit',['type'=>$curType->id])  }}" class="btn btn-warning fw-bold text-light">Edit</a>
                                        <form action="{{ route('admin.types.destroy', ['type' => $curType->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn fw-bold btn-danger" onclick="return confirm('Are you sure you want to delete this comic?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        
                    </tbody>
                </table>
        </div>
    </div>
@endsection