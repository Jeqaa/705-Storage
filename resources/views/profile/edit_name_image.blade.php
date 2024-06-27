@extends('layoutslte.template')

@section('content')
    <script src="{{ asset('js/swa2.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (Session::has('message'))
                let message = "{{ Session::get('message') }}";
                let type = "{{ Session::get('alert-type', 'info') }}";
                Swal.fire({
                    title: type.charAt(0).toUpperCase() + type.slice(1),
                    text: message,
                    icon: type,
                    showConfirmButton: true,
                });
            @endif
        });
    </script>
    <section class="content">
        <div class="container-fluid">
            @if (Auth::user()->can('profile.edit'))
                <div class="text-center mb-4">
                    <img src="{{ Auth::user()->image_path }}" width="90" height="80" class="imgProfile rounded-circle"
                        alt="User Image">
                    <form id="uploadForm" action="{{ route('profile.changePicture', Auth::user()->id) }}" method="POST"
                        enctype="multipart/form-data" class="formChangeImg">
                        @csrf
                        <input type="file" name="profilePicture" id="profilePicture" required
                            accept="image/jpeg, image/png" class="inputChangeImg" />
                        <button type="submit" id="submitButton" class="btn btn-primary mt-2">Save</button>
                    </form>

                </div>
                <form id="myEditForm" class="col-md-6 mx-auto" action="{{ route('profile.updateName', Auth::user()->id) }}"
                    method="POST">
                    <div class="card-header d-flex justify-content-center border-bottom mb-3">
                        <h3 class="card-title py-3 fs-4 fw-bold">EDIT PROFILE</h3>
                    </div>
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label for="nama_pengguna" class="form-label">Nama Pengguna:</label>
                        <input type="text" class="form-control" name="nama_pengguna" id="nama_pengguna"
                            value="{{ Auth::user()->name }}" required>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <a href="{{ route('profile.sendToOldMail', Auth::user()->id) }}" class="btn btn-link">Ganti
                            Email</a>
                        <a href="{{ route('profile.sendResetPassword', Auth::user()->id) }}" class="btn btn-link">Ganti
                            Password</a>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('dashboard.view') }}" class="btn btn-secondary">Back</a>
                    </div>
                </form>
            @endif
        </div>
    </section>
@endsection
