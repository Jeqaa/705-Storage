<div class="row">
    <div class="w-100">
        <div class="card marginbot-0">
            <div class="card-body table-responsive p-0">
                <div id="container-table">
                    @if (isset($produk) && count($produk) > 0)
                        <table class="table table-hover text-nowrap">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($produk as $prd)
                                    <tr>
                                        <td>{{ $i }}</td>
                                        <td>{{ $prd->nama_produk }}</td>
                                        <td>{{ $prd->kategori }}</td>
                                        <td>{{ $prd->jumlah_barang }}</td>
                                        <td>
                                            <form action="{{ route('produk.destroy', $prd->nama_produk) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @php $i++; @endphp
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-danger font-weight-bold text-center pt-3">No products found.</p>
                    @endif
                </div>
            </div>

        </div>

    </div>
</div>
