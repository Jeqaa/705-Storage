@extends('layoutslte.template')


@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->

                <section class="content">
                    <div class="container-fluid">
                        <form>
                            <div class="row">
                                <div class="col-md-10 px-0">
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Sort</label>
                                                <select class="select2" id="sort" name="sort" style="width: 100%;">
                                                    <option value="asc">Low to High Stock</option>
                                                    <option value="desc">High to Low Stock</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-3">
                                            <div class="form-group">
                                                <label>Category</label>
                                                <select class="select2" id="category" name="category" style="width: 100%;">
                                                    <option value="all">All</option>
                                                    <option value="best_seller">Best Seller</option>
                                                    <option value="other">Other</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    {{-- search bar --}}
                                    <div class="form-group">
                                        <div class="input-group input-group-lg">
                                            <input name="search" id="search" type="text" autocomplete="off"
                                                class="form-control form-control-lg" placeholder="Search...">
                                        </div>
                                    </div>
                                </div>
                                <div class="addItemBtn px-0">
                                    <a class="btn btn-danger d-flex flex-column justify-content-center mb-3" href="#"
                                        role="button" id="addItemBtn">
                                        <i class="bi bi-upload"></i>
                                        <div class="ms-2">Add Item</div>
                                    </a>
                                </div>
                                <div id="modalOverlay"></div>
                            </div>
                        </form>


                        <form id="myForm" class="col-md-6" action="{{ route('produk.store') }}" method="POST">
                            <div class="card-header d-flex justify-content-center border-bottom mb-3">
                                <h3 class="card-title py-3 fs-4 fw-bold">ADD ITEM</h3>
                            </div>
                            <div class="card-body">
                                @csrf
                                <div class="form-group">
                                    <label for="nama_produk" class="form-label">Nama Produk</label>
                                    <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
                                </div>
                                <div class="form-group">
                                    <label for="kategori" class="form-label">Kategori</label>
                                    <select class="form-select" id="kategori" name="kategori">
                                        <option value="Best Seller">Best Seller</option>
                                        <option value="Other">Other</option>
                                        <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                                    <input class="form-control" id="jumlah_barang" name="jumlah_barang" rows="3"
                                        required></input>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
                                </div>
                            </div>
                        </form>


                    </div>
                </section>


                <div class="row">
                    <div class="w-100">
                        <div class="card ">
                            <div class="card-body table-responsive p-0">
                                <div id="container-table" class="overflow-hidden">
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
                                                            <form action="{{ route('produk.destroy', $prd->id) }}"
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

            </div>
        </section>
        <!-- /.content -->
    </div>
    <!-- ./wrapper -->
@endsection
