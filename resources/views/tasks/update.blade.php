@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Update Task</div>

                    <div class="card-body">
                        <form name="createTask" method="post" action="{{ route('updateTask', $task) }}">
                            <!-- Title -->
                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label">Title</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="title" name="title"
                                           placeholder="Title of your task" value="{{ old('title', $task->title) }}">
                                </div>
                            </div>

                            <!-- Description -->
                            <div class="form-group row">
                                <label for="description" class="col-sm-2 col-form-label">Description</label>
                                <div class="col-sm-10">
                                    <textarea name="description" id="description" class="form-control"
                                              rows="5" placeholder="Describe your task." >{{ old('title', $task->title) }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-sm-12 text-right">
                                    <button type="submit" class="btn btn-primary">Create Task</button>
                                </div>
                            </div>

                            @csrf
                            @method('put')
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection