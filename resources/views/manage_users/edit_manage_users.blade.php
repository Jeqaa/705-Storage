@extends('layoutslte.template')
@section('content')
    <section class="content">
        <div class="container-fluid">


            <form id="myEditForm" class="col-md-6" action="{{ route('manage-users.update', $user->id) }}" method="POST">
                <div class="card-header d-flex justify-content-center border-bottom mb-3">
                    <h3 class="card-title py-3 fs-4 fw-bold">EDIT USER</h3>
                </div>
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="nama_user" class="form-label">Nama User:</label>
                    <input type="nama_user" class="form-control" name="nama_user" id="nama_user" value="{{ $user->name }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}"
                        required>
                </div>

                <div class="form-group">
                    <label for="nama_role" class="form-label">Role Name</label>
                    <select class="form-select" id="nama_role" name="nama_role">
                        <option selected disabled>Pilih Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('manage-users.view') }}" type="button" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection
