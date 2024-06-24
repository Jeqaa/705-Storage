@extends('layoutslte.template')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">To-do List</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="col-md-12">
                    <div class="card">
                        @if (Auth::user()->can('todos.store'))
                            <div class="card-header"><strong>Add To-do</strong></div>
                            <div class="card-body">
                                <form action="{{ route('to-dos.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="title">Title</label>
                                        <input type="text" name="title" id="title" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea name="description" id="description" class="form-control" style="max-height: 200px; overflow-y: auto;"
                                            required></textarea>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="pinned" id="pinned" class="form-check-input">
                                        <label for="pinned" class="form-check-label">Pin this to-do</label>
                                    </div>
                                    <button type="submit" class="btn btn-dark">Add To-do</button>
                                </form>
                                <hr>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><strong>In Progress</strong></div>
                        <div class="card-body">
                            @php
                                $inProgress = $todos
                                    ->where('completed', false)
                                    ->sortByDesc('updated_at')
                                    ->sortByDesc('pinned');
                            @endphp
                            @if ($inProgress->count() > 0)
                                <div id="in-progress" class="list-group border p-2">
                                    @foreach ($inProgress as $todo)
                                        <div class="list-group-item todo" data-id="{{ $todo->id }}"
                                            style="{{ $todo->pinned ? 'border-left: 5px solid gold;' : 'border-left: 5px solid teal;' }}">
                                            @if ($todo->pinned)
                                                <span class="badge bg-warning text-dark mb-1">Pinned</span>
                                            @endif
                                            <h5>{{ $todo->title }}</h5>
                                            <p>{{ $todo->description }}</p>
                                            <p><strong>Updated at:</strong> {{ $todo->updated_at }}</p>
                                            <p><strong>Created at:</strong> {{ $todo->created_at }}</p>
                                            <div class="todo-buttons">
                                                <form action="{{ route('to-dos.markAsDone', $todo->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="completed" value="1">
                                                    @if (Auth::user()->can('todos.edit'))
                                                        <button type="submit" class="btn btn-success btn-sm">Done</button>
                                                    @endif
                                                </form>
                                                @if (Auth::user()->can('todos.edit'))
                                                    <a href="{{ route('to-dos.edit', $todo->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                @endif
                                                <form action="{{ route('to-dos.delete', $todo->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    @if (Auth::user()->can('todos.delete'))
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm swa2-confirm-delete">Delete</button>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-danger font-weight-bold text-center pt-3">No in-progress todos were found.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header"><strong>Completed</strong></div>
                        <div class="card-body">
                            @php
                                $completed = $todos
                                    ->where('completed', true)
                                    ->sortByDesc('updated_at')
                                    ->sortByDesc('pinned');
                            @endphp
                            @if ($completed->count() > 0)
                                <div id="completed" class="list-group border p-2">
                                    @foreach ($completed as $todo)
                                        <div class="list-group-item todo" data-id="{{ $todo->id }}"
                                            style="{{ $todo->pinned ? 'border-left: 5px solid gold;' : 'border-left: 5px solid teal;' }}">
                                            @if ($todo->pinned)
                                                <span class="badge bg-warning text-dark mb-1">Pinned</span>
                                            @endif
                                            <h5>{{ $todo->title }}</h5>
                                            <p>{{ $todo->description }}</p>
                                            <p><strong>Updated at:</strong> {{ $todo->updated_at }}</p>
                                            <p><strong>Created at:</strong> {{ $todo->created_at }}</p>
                                            <div class="todo-buttons">
                                                <form action="{{ route('to-dos.markAsUndone', $todo->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="completed" value="0">
                                                    @if (Auth::user()->can('todos.edit'))
                                                        <button type="submit"
                                                            class="btn btn-success btn-sm">Undone</button>
                                                    @endif
                                                </form>
                                                @if (Auth::user()->can('todos.edit'))
                                                    <a href="{{ route('to-dos.edit', $todo->id) }}"
                                                        class="btn btn-primary btn-sm">Edit</a>
                                                @endif
                                                <form action="{{ route('to-dos.delete', $todo->id) }}" method="POST"
                                                    class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    @if (Auth::user()->can('todos.delete'))
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm swa2-confirm-delete">Delete</button>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-danger font-weight-bold text-center pt-3">No completed todos were found.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    </div>
@endsection
