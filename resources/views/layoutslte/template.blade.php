<!DOCTYPE html>
<html lang="en">

@include('layoutslte.header')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        @include('layoutslte.navbar')
        @include('layoutslte.sidebar')
        @yield('content')

        {{-- @include('layoutslte.footer') --}}
        @include('layoutslte.script')
    </div>
</body>

</html>
