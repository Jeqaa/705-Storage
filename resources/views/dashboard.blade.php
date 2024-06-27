@extends('layoutslte.template')
<style>
    .scroll-container {
        height: 40px;
        overflow: hidden;
        position: relative;
    }

    .scroll-content {
        position: absolute;
        width: 100%;
    }

    .scroll-content ul {
        padding: 0;
        margin: 0;
    }

    .scroll-content li {
        list-style: none;
        height: 40px;
        line-height: 40px;
        background-color: #ffc107;
        border: none;
        color: #ffffff;
    }
</style>

@section('content')
    <div class="content-wrapper" style="min-height: 805px;">

        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>


        <section class="content">
            <div class="container-fluid">
                <div class="row">

                    {{-- Box untuk total produk --}}
                    @if (Auth::user()->can('produk.view'))
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>{{ $totalProducts }}</h3>
                                    <p>Products</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pricetags"></i>
                                </div>
                                <a href="{{ route('produk') }}" class="small-box-footer" style="color: #ffffff;">More info
                                    <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif

                    {{-- Box untuk produk yang stocknya < 8 --}}
                    @if (Auth::user()->can('produk.view'))
                        <div class="col-lg-3 col-6">
                            <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3 style="color: #ffffff;">{{ $totalLowStockProducts }} <sup style="font-size: 20px">(
                                            <8 in stock)</sup>
                                    </h3>
                                    @if (count($lowStockProducts) == 0)
                                        <p style="color: #ffffff;">No products in low stock</p>
                                    @else
                                        <div class="scroll-container">
                                            <div class="scroll-content">
                                                <ul class="list-group">
                                                    @foreach ($lowStockProducts as $product)
                                                        <li class="list-group-item">
                                                            {{ $product->nama_produk }} -
                                                            {{ $product->jumlah_barang }} in stock
                                                        </li>
                                                    @endforeach
                                                </ul>
                                                <ul class="list-group">
                                                    @foreach ($lowStockProducts as $product)
                                                        <li class="list-group-item">
                                                            {{ $product->nama_produk }} -
                                                            {{ $product->jumlah_barang }} in stock
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="icon">
                                    <i class="ion ion-alert"></i>
                                </div>
                                <a href="{{ route('produk') }}" class="small-box-footer"
                                    style="color: #ffffff !important;">More info <i
                                        class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    @endif

                    {{-- Box untuk history terbaru --}}
                    @if (Auth::user()->can('history.view'))
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                @if ($latestHistory)
                                    <h3>Product: {{ $latestHistory->nama_produk }}</h3>
                                    <p>last updated by {{ $latestHistory->username }}</p>
                                @else
                                    <h3>None</h3>
                                    <p>No history found</p>
                                @endif

                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="{{ route('history.view') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif

                    {{-- Box untuk todo yang belum selesai --}}
                    @if (Auth::user()->can('todos.view'))
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-primary">
                            <div class="inner">
                                <h3>{{ $totalInProgressTodos }}</h3>
                                <p>In Progress To-Dos</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-clipboard"></i>
                            </div>
                            <a href="{{ route('to-dos.view') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif

                    {{-- Box untuk user yang tidak memiliki akses ke aplikasi --}}
                    @if (Auth::user()->can('user.management.view'))
                    <div class="col-lg-3 col-6">
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ $totalNotEmployeeUsers }}</h3>
                                <p>Users without access to the application</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person"></i>
                            </div>
                            <a href="{{ route('manage-users.view') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </section>

    </div>
    <script>
        $(document).ready(function() {
            var $scrollContainer = $('.scroll-container');
            var $scrollContent = $('.scroll-content');
            var itemHeight = $('.list-group-item').outerHeight();
            var scrollHeight = $scrollContent.height() / 2;

            function scroll() {
                $scrollContainer.animate({
                    scrollTop: '+=' + itemHeight
                }, 1500, 'linear', function() {
                    if ($scrollContainer.scrollTop() >= scrollHeight) {
                        $scrollContainer.scrollTop(0); // Reset scroll position to top
                    }
                    scroll(); // Repeat the scrolling
                });
            }

            scroll(); // Start the scrolling
        });
    </script>
@endsection
