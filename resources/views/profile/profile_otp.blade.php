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
        <form id="myEditForm" class="col-md-6" action="{{ route('profile.verifyOtp',Auth::user()->id) }}" method="POST">
            <div class="card-header d-flex justify-content-center border-bottom mb-3">
                <h3 class="card-title py-3 fs-4 fw-bold">VERIFY OTP</h3>
                @if ($page == 1 || $page == 3)
                    <p>Periksa email anda untuk memasukkan OTP. Kode OTP terkirim ke {{ Auth::user()->email }}.</p>
                @elseif ($page == 2)
                    <p>Periksa email anda untuk memasukkan OTP. Kode OTP terkirim ke email baru anda.</p>
                @endif
            </div>
            @csrf
            @method('POST')
            <div class="form-group">
                <input type="text" class="form-control" name="otp" id="otp" placeholder="Masukkan OTP Anda" required>
            </div>
            <div class="form-group d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Submit</button>
                <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>

        </div>
    </section>
@endsection
