@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex">
                        <div class="mr-auto">
                            Tasks
                        </div>
                    </div>

                    <div class="card-body">

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                </tr>
                                </thead>

                                <tbody>
                                @forelse($tasks as $task)
                                    <tr>
                                        <td><a href="{{ route('updateTask', $task) }}">{{ $task->title }}</a></td>
                                        <td>{{ str_limit($task->description, 100) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3">There are no tasks to display.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mt-3 text-center">
                    {{ $tasks->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection