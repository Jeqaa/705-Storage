@extends('layoutslte.template')

@section('content')
    <script src="{{ asset('js/swa2.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
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
    <div class="content-wrapper">
        @if (Auth::user()->can('profile.edit'))
            <section class="content">
                <div class="container-fluid d-flex justify-content-center flex-row pt-5">
                    <div class="img-edit me-4">
                        <div class="d-flex justify-content-center border-bottom mb-3">
                            <h3 class="card-title py-3 fs-4 fw-bold">EDIT IMAGE</h3>
                        </div>
                        <img src="{{ asset(Auth::user()->image_path) }}" width="100" height="100"
                            class="imgProfile rounded-circle mb-4" alt="User Image">
                        <form id="uploadForm" class="uploadForm "
                            action="{{ route('profile.changePicture', Auth::user()->id) }}" method="POST"
                            enctype="multipart/form-data" class="formChangeImg">
                            @csrf
                            <input type="file" name="profilePicture" id="profilePicture" required
                                accept="image/jpeg, image/png" class="inputChangeImg mb-2" />
                            <button type="submit" id="submitButton" class="btn btn-primary mt-2">Save</button>
                        </form>
                    </div>

                    <form id="edit-name-image" class="col-md-6" action="{{ route('profile.updateName', Auth::user()->id) }}"
                        method="POST">
                        <div class="card-header d-flex justify-content-center border-bottom mb-3">
                            <h3 class="card-title py-3 fs-4 fw-bold">EDIT PROFILE</h3>
                        </div>
                        @csrf
                        @method('POST')

                        <div class="form-group mb-4">
                            <label for="nama_pengguna" class="form-label">Username :</label>
                            <input type="text" class="form-control" name="nama_pengguna" id="nama_pengguna"
                                value="{{ Auth::user()->name }}" required>
                        </div>
                        <div class="form-group d-flex flex-column">
                            <button type="submit" class="btn btn-primary mb-2">Save</button>
                            <a href="{{ route('dashboard.view') }}" class="btn btn-secondary">Back</a>
                        </div>
                        <div class="form-group d-flex gap-2 justify-content-around">
                            <a href="{{ route('profile.sendToOldMail', Auth::user()->id) }}"
                                class="btn btn-outline-primary btn-block">Change
                                Email</a>
                            <a href="{{ route('profile.sendResetPassword', Auth::user()->id) }}"
                                class="m-0 btn btn-outline-danger btn-block">Change
                                Password</a>
                        </div>

                    </form>
                </div>

            </section>
        @endif
    </div>
@endsection
