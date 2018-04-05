@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ $task->title }}
                    </div>

                    <div class="card-body">
                        {{ $task->description }}
                    </div>

                    <div class="card-footer text-muted d-flex">
                        <div class="mr-auto">
                            @can('delete', $task)
                                <form action="{{ route('deleteTask', $task) }}" method="post">
                                    <button class="btn btn-sm btn-secondary">Delete</button>
                                    @method('delete')
                                    @csrf
                                </form>
                            @endcan
                        </div>

                        <div>
                            @can('update', $task)
                                <a href="{{ route('editTask', $task) }}">Edit</a>
                            @endcan
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection