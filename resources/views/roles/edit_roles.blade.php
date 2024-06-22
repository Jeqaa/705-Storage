@extends('layoutslte.template')
@section('content')
    <section class="content">
        <div class="container-fluid">


            <form id="myEditForm" class="col-md-6" action="{{ route('roles.update', $roles->id) }}" method="POST">
                <div class="card-header d-flex justify-content-center border-bottom mb-3">
                    <h3 class="card-title py-3 fs-4 fw-bold">EDIT ROLE</h3>
                </div>
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="nama_role" class="form-label">Nama Role:</label>
                    <input type="nama_role" class="form-control" name="nama_role" id="nama_role" value="{{ $roles->name }}"
                        required>
                </div>

                <div class="form-group d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('all.roles') }}" type="button" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection
