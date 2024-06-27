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
        });
    </script>
    <section class="content">
        <div class="container-fluid">
            <form id="myEditForm" class="col-md-6" action="{{ route('profile.sendToNewMail', ['id' => Auth::user()->id]) }}" method="POST">
                <div class="card-header d-flex justify-content-center border-bottom mb-3">
                    <h3 class="card-title py-3 fs-4 fw-bold">ENTER NEW EMAIL</h3>
                </div>
                @csrf
                @method('POST')
                <div class="form-group">
                    <input type="text" class="form-control" name="email" id="email" placeholder="Masukkan Email Baru Anda." required>
                </div>
                <div class="form-group d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection
