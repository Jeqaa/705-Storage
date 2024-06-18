@extends('layoutslte.template')
@section('content')
    <section class="content">
        <div class="container-fluid">


            <form id="myEditForm" class="col-md-6" action="{{ route('produk.update', $prd->id) }}" method="POST">
                <div class="card-header d-flex justify-content-center border-bottom mb-3">
                    <h3 class="card-title py-3 fs-4 fw-bold">EDIT ITEM</h3>
                </div>
                @method('PUT')
                @csrf
                <div class="form-group">
                    <label for="nama_produk" class="form-label">Nama Produk:</label>
                    <input type="nama_produk" class="form-control" name="nama_produk" id="nama_produk"
                        value="{{ $prd->nama_produk }}" required>
                </div>
                <div class="form-group">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori">
                        <option value="Best Seller" {{ $prd->kategori == 'Best Seller' ? 'selected' : '' }}>Best Seller</option>
                        <option value="Other" {{ $prd->kategori == 'Other' ? 'selected' : '' }}>Other</option>
                        <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                    </select>
                </div>
                <div class="form-group">
                    <label for="jumlah_barang" class="form-label">Jumlah_barang:</label>
                    <div class="input-group">
                        <!-- <button class="btn btn-outline-secondary" type="button" id="btnMinus">-</button> -->
                        <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control input-number"
                            value="{{ $prd->jumlah_barang }}" min="0" required>
                        <!-- <button class="btn btn-outline-secondary" type="button" id="btnPlus">+</button> -->
                    </div>
                </div>


                <div class="form-group d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('produk') }}" type="button" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </section>
@endsection
