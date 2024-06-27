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
<div class="card">

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
                    @if ($showedAnnouncement != null)
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <p class="flex-grow-1">
                                        <span class="text-bold text-lg">{{ $showedAnnouncement->title }}</span>
                                    </p>
                                    <button class="btn btn-link toggle-content" data-toggle="collapse"
                                        data-target="#collapseContent" aria-expanded="false"
                                        aria-controls="collapseContent">
                                        <i class="fas fa-chevron-down"></i>
                                    </button>
                                </div>
                                <div id="collapseContent" class="collapse">
                                    <div class="additional-content">
                                        {{ $showedAnnouncement->content }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

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
                                    <a href="{{ route('produk') }}" class="small-box-footer" style="color: #ffffff;">More
                                        info
                                        <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        @endif

                        {{-- Box untuk produk yang stocknya < 8 --}}
                        @if (Auth::user()->can('produk.view'))
                            <div class="col-lg-3 col-6">
                                <div class="small-box bg-warning">
                                    <div class="inner">
                                        <h3 style="color: #ffffff;">{{ $totalLowStockProducts }} <sup
                                                style="font-size: 20px">(
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



                    <!-- Bar chart 5 produk dengan stok tertinggi -->
                    @if (Auth::user()->can('produk.view'))
                        <div class="row mt-4">
                            <div class="col">
                                <div class="card card-dark">
                                    <div class="card-header">
                                        <h3 class="card-title">Top 5 Products with Highest Stock</h3>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="barChart" style="height: 400px; width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Pie Chart Kategori Produk -->
                    @if (Auth::user()->can('produk.view'))
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Product By Category</h3>
                            </div>
                            <div class="card-body">
                                <div class="chartjs-size-monitor">
                                    <div class="chartjs-size-monitor-expand">
                                        <div class=""></div>
                                    </div>
                                    <div class="chartjs-size-monitor-shrink">
                                        <div class=""></div>
                                    </div>
                                </div>
                                <canvas id="pieChart"
                                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 343px;"
                                    width="343" height="250" class="chartjs-render-monitor"></canvas>
                            </div>
                        </div>
                    @endif

                    <!-- Edit/Update 5 pertama produk (history) -->
                    @if (Auth::user()->can('history.view'))
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card card-dark">
                                    <div class="card-header">
                                        <h3 class="card-title">Latest Edits</h3>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group">
                                            @foreach ($latestEdits as $edit)
                                                <li class="list-group-item list-group-item-info">
                                                    Product: <span class="fw-bold">{{ $edit->nama_produk }}</span>
                                                    by <span class="fw-bold">{{ $edit->username }}</span>
                                                    at {{ $edit->created_at }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- 8 user terbaru yang registrasi -->
                    @if (Auth::user()->can('user.management.view'))
                        <div class="card card-dark">
                            <div class="card-header">
                                <h3 class="card-title">Latest Users</h3>
                            </div>

                            <div class="card-body p-0">
                                <ul class="users-list clearfix">
                                    @foreach ($latestUsers as $user)
                                        <li>
                                            <!-- <img src="{{ asset('dist/img/user-placeholder.png') }}" alt="User Image"> -->
                                            <img src="{{ asset($user->image_path ?: 'profileImage/default.png')  }}" alt="User Image">
                                            <a class="users-list-name" href="{{ route('manage-users.edit', $user->id) }}"
                                                data-toggle="tooltip" title="Edit">{{ $user->name }}</a>
                                            <span class="users-list-date">{{ $user->created_at->diffForHumans() }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="card-footer text-center">
                                <a href="{{ route('manage-users.view') }}">Manage Users</a>
                            </div>
                        </div>
                    @endif
                </div>
        </div>

        </section>

    </div>
    <script>
        // Low stock product scroll
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

        // Data for the chart
        var labels = {!! json_encode($topProducts->pluck('nama_produk')) !!};
        var data = {!! json_encode($topProducts->pluck('jumlah_barang')) !!};

        // Bar chart configuration
        var ctx = document.getElementById('barChart').getContext('2d');
        var barChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Stock Quantity',
                    data: data,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false // Hide legend for simplicity
                    }
                },
                layout: {
                    padding: {
                        left: 10,
                        right: 10,
                        top: 10,
                        bottom: 10
                    }
                },
                tooltips: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.yLabel;
                        }
                    }
                }
            },
        });

        // Pie Chart
        var ctx = document.getElementById('pieChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: {!! json_encode(array_keys($productCountsByCategory)) !!},
                datasets: [{
                    label: 'Product Count by Category',
                    data: {!! json_encode(array_values($productCountsByCategory)) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(75, 192, 192, 0.8)',
                        'rgba(255, 206, 86, 0.8)',
                        'rgba(153, 102, 255, 0.8)',
                        'rgba(255, 159, 64, 0.8)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });

        // Tooltip bootstrap
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection
