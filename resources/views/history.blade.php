<!DOCTYPE html>
<html>
<head>
    <title>History Page</title>
    <style>
        .red-row {
            background-color: #F7BEC0; /* Warna merah */
        }
        .green-row {
            background-color: #94C973; /* Warna hijau */
        }
        .yellow-row {
            background-color: #FEDE00; /* Warna kuning */
        }
        .blue-row {
            background-color: #75E6DA; /* Warna biru */
        }
        .pagination-links {
            font-size: 14px; /* Atur ukuran teks sesuai kebutuhan */
        }
    </style>
</head>
<body>
    <h1>History Page</h1>
    
    <a href="{{ route('produk') }}">Kembali ke Halaman Utama</a>
    <!-- Tampilkan informasi tambahan jika diperlukan -->
    <div class="row">
        <div class="w-100">
            <div class="card">
                <div class="card-body table-responsive p-0">
                    <div id="container-table" class="overflow-hidden">
                        @if (isset($history) && $history->count() > 0)
                            <table class="table table-hover text-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Nama Pengguna</th>
                                    <th class="text-center">Nama Produk</th>
                                    <th class="text-center">Keterangan</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="text-center">Waktu Perubahan</th>
                                </tr>

                                </thead>
                                <tbody>
                                    @php $i = ($history->currentPage() - 1) * $history->perPage() + 1; @endphp
                                    @foreach ($history as $his)
                                        @php
                                            $keywords = explode(', ', $his->keterangan);
                                            $row_class = '';
                                            foreach ($keywords as $keyword) {
                                                if (strpos($keyword, 'Mengurangi Produk') !== false) {
                                                    $row_class = 'red-row';
                                                    break;
                                                } elseif (strpos($keyword, 'Menambahkan Produk') !== false) {
                                                    $row_class = 'green-row';
                                                    break;
                                                } elseif (strpos($keyword, 'Menghapus Produk') !== false) {
                                                    $row_class = 'yellow-row';
                                                    break;
                                                } elseif (strpos($keyword, 'Membuat Produk') !== false) {
                                                    $row_class = 'blue-row';
                                                    break;
                                                }
                                            }
                                        @endphp
                                        <tr class="{{ $row_class }}">
                                            <td class="text-center">{{ $i }}</td>
                                            <td class="text-center">{{ $his->username }}</td>
                                            <td class="text-center">{{ $his->nama_produk }}</td>
                                            <td class="text-center">{{ $his->keterangan }}</td>
                                            <td class="text-center">{{ $his->jumlah_barang }}</td>
                                            <td class="text-center">{{ $his->created_at }}</td>
                                        </tr>
                                        @php $i++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- Tampilkan pagination -->
                            <div class="pagination-links">
                                {{ $history->links() }}
                            </div>
                        @else
                            <p class="text-danger font-weight-bold text-center pt-3">No history found.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
