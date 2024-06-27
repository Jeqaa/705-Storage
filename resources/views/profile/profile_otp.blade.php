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
    <div class="content-wrapper ">
        <section class="content">
            <div class="container-fluid d-flex justify-content-center pt-5">
                <form id="profile_otp_send" class="col-md-6" action="{{ route('profile.verifyOtp', Auth::user()->id) }}"
                    method="POST">
                    <div class="card-header d-flex flex-column justify-content-center border-bottom mb-4">
                        <h3 class="card-title py-1 fs-4 fw-bold">VERIFY OTP</h3>
                        @if ($page == 1 || $page == 3)
                            <p>Check your email to enter the OTP. OTP code sent to {{ Auth::user()->email }}.
                            </p>
                        @elseif ($page == 2)
                            <p>Check your email to enter the OTP. The OTP code will be sent to your new email.</p>
                        @endif
                    </div>
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <input type="text" class="form-control" name="otp" id="otp"
                            placeholder="Enter your OTP" required>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="{{ route('profile.edit') }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>


            </div>
        </section>
    </div>
@endsection
