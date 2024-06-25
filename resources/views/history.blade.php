@extends('layoutslte.template')


@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">History</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="w-100">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <div id="container-table" class="overflow-hidden">
                                    @if (isset($history) && $history->count() > 0)
                                        <table class="table table-history  mb-0">
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
                                                                $row_class = 'table-warning';
                                                                break;
                                                            } elseif (
                                                                strpos($keyword, 'Menambahkan Produk') !== false
                                                            ) {
                                                                $row_class = 'table-primary';
                                                                break;
                                                            } elseif (strpos($keyword, 'Menghapus Produk') !== false) {
                                                                $row_class = 'table-danger';
                                                                break;
                                                            } elseif (strpos($keyword, 'Membuat Produk') !== false) {
                                                                $row_class = 'table-success';
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
            </div>
        </div>
    </div>
@endsection
