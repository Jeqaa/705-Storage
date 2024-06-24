@extends('layoutslte.template')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit To-do</div>
                    <div class="card-body">
                        <form action="{{ route('to-dos.update', $todo->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control"
                                    value="{{ $todo->title }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control" rows="4" required>{{ $todo->description }}</textarea>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" name="pinned" id="pinned" class="form-check-input"
                                    {{ $todo->pinned ? 'checked' : '' }}>
                                <label for="pinned" class="form-check-label">Pin this todo</label>
                            </div>
                            <button type="submit" class="btn btn-primary">Update Todo</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
