<!DOCTYPE html>
<html lang="en">

@include('layouts.header');

<body>
    @include('layouts.navbar');
    @include('layouts.sidebar');
    @yield('content');

    @include('layouts.script')
</body>
</html>
  