@extends('layoutslte.template')

@section('content')
    <script src="{{ asset('js/swa2.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
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

            // Validation script to check if passwords match
            let form = document.getElementById('myEditForm');
            form.addEventListener('submit', function(event) {
                let password1 = document.getElementById('password').value;
                let password2 = document.getElementById('password_confirmation').value;

                if (password1 !== password2) {
                    alert('Passwords do not match. Please enter the same password in both fields.');
                    event.preventDefault(); // Prevent form submission
                }
            });
        });
    </script>
    <section class="content">
        <div class="container-fluid">
            <form id="myEditForm" class="col-md-6" action="{{ route('profile.changePassword',Auth::user()->id) }}" method="POST">
                <div class="card-header d-flex justify-content-center border-bottom mb-3">
                    <h3 class="card-title py-3 fs-4 fw-bold">ENTER NEW PASSWORD</h3>
                </div>
                @csrf
                @method('POST')
                <div class="form-group">
                    <label for="password">New Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter New Password" pattern=".{8,}" title="Must be at least 8 characters long" required>
                    <small class="text-muted">Must be at least 8 characters long</small>
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Repeat Password</label>
                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Repeat New Password" pattern=".{8,}" title="Must be at least 8 characters long" required>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection
