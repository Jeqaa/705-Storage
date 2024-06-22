@extends('layoutslte.template')
@section('content')
    <section class="content">
        <div class="container-fluid">


            <form id="myEditForm" class="col-md-6" action="{{ route('permission.update', $permission->id) }}" method="POST">
                <div class="card-header d-flex justify-content-center border-bottom mb-3">
                    <h3 class="card-title py-3 fs-4 fw-bold">EDIT PERMISSION</h3>
                </div>
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="nama_permission" class="form-label">Nama Permission:</label>
                    <input type="nama_permission" class="form-control" name="nama_permission" id="nama_permission"
                        value="{{ $permission->name }}" required>
                </div>
                <div class="form-group">
                    <label for="nama_group" class="form-label">Nama Group</label>
                    <select class="form-select" id="nama_group" name="nama_group">
                        <option value="dashboard" {{ $permission->group_name == 'dashboard' ? 'selected' : '' }}>Dashboard
                        </option>
                        <option value="history" {{ $permission->group_name == 'history' ? 'selected' : '' }}>History
                        </option>
                        <option value="todo" {{ $permission->group_name == 'todo' ? 'selected' : '' }}>To Do List</option>
                        <option value="role" {{ $permission->group_name == 'role' ? 'selected' : '' }}>Role</option>
                        <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                    </select>
                </div>


                <div class="form-group d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('all.permission') }}" type="button" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection
