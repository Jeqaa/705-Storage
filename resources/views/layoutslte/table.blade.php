<div class="row">
    <div class="w-100">
        <div class="card marginbot-0">
            <div class="card-body table-responsive p-0">
                <div id="container-table">
                    @if (isset($produk) && count($produk) > 0)
                        <table class="table table-hover text-nowrap mb-0">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Category</th>
                                    <th class="text-center">Stock</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php $i = 1; @endphp
                                @foreach ($produk as $prd)
                                    <tr>
                                        <td class="text-center">{{ $i }}</td>
                                        <td class="text-center">{{ $prd->nama_produk }}</td>
                                        <td class="text-center">{{ $prd->kategori }}</td>
                                        <td class="text-center">{{ $prd->jumlah_barang }}</td>
                                        <td class="d-flex justify-content-center">
                                            <a href="{{ route('produk.edit', $prd->id) }}"
                                                class ="btn btn-primary me-2">Edit</a>
                                            <form action="{{ route('produk.destroy', $prd->id) }}" method="POST">
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
