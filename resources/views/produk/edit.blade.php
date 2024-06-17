@section('content')
    <section class = "page-section portfolio" id ="tambah">
        <div class="container">
            <h1>Edit Produk</h1>

            <form action="{{ route('produk.update', $prd->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="nama_produk">Nama Produk:</label>
                    <input type="nama_produk" name="nama_produk" id="nama_produk" value="{{ $prd->nama_produk }}" required>
                </div>
                <div class="mb-3">
                    <label for="kategori" class="form-label">Kategori</label>
                    <select class="form-select" id="kategori" name="kategori">
                        <option value="Best Seller" {{ $prd->kategori == 'Best Seller' ? 'selected' : '' }}>Best Seller</option>
                        <option value="Other" {{ $prd->kategori == 'Other' ? 'selected' : '' }}>Other</option>
                        <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="jumlah_barang">Jumlah_barang:</label>
                    <div class="input-group">
                        <!-- <button class="btn btn-outline-secondary" type="button" id="btnMinus">-</button> -->
                        <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control input-number"
                            value="{{ $prd->jumlah_barang }}" min="0" required>
                        <!-- <button class="btn btn-outline-secondary" type="button" id="btnPlus">+</button> -->
                    </div>
                </div>


                <button type="submit" class ="btn btn-primary">Submit</button>
            </form>
        </div>
    </section>
