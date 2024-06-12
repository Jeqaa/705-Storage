<style>
    /* Sembunyikan form pada awalnya */
    #myForm {
        display: none;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 1000;
        background: white;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    /* Background overlay untuk modal */
    #modalOverlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 999;
    }
</style>

<nav class="navbar justify-content-lg-around pt-4">
    <form role="search">
        <input class="form-control rounded-5" type="search" placeholder="Search" aria-label="Search" />
    </form>
    <div class="profile d-flex align-items-center">
        <a href="#">
            <img src="img/profile.png" alt="profile" class="profilePicture me-3" />
        </a>
        <p class="m-0 fw-medium">Steven Curry</p>
    </div>
    <div class="addItemBtn">
        <a class="btn btn-light addBtn d-flex flex-column justify-content-center" href="#" role="button"
            id="addItemBtn">
            <i class="bi bi-upload"></i>
            <div class="ms-2">Add Item</div>
        </a>
    </div>
</nav>

<!-- Background overlay -->
<div id="modalOverlay"></div>

<!-- Form yang akan ditampilkan sebagai modal -->
<form id="myForm" class="mt-3" action="{{ route('produk.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="nama_produk" class="form-label">Nama Produk</label>
        <input type="text" class="form-control" id="nama_produk" name="nama_produk" required>
    </div>
    <div class="mb-3">
        <label for="kategori" class="form-label">Kategori</label>
        <select class="form-select" id="kategori" name="kategori">
            <option value="Best Seller">Best Seller</option>
            <option value="Other">Other</option>
            <!-- Tambahkan opsi kategori lainnya sesuai kebutuhan -->
        </select>
    </div>

    <div class="mb-3">
        <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
        <textarea class="form-control" id="jumlah_barang" name="jumlah_barang" rows="3" required></textarea>
    </div>
    <div class="d-flex justify-content-between">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-secondary" id="cancelBtn">Cancel</button>
    </div>
</form>


<script>
    // JavaScript untuk menampilkan form ketika tombol diklik
    document.getElementById('addItemBtn').addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah tautan untuk mengikuti href #
        document.getElementById('myForm').style.display = 'block'; // Menampilkan form
        document.getElementById('modalOverlay').style.display = 'block'; // Menampilkan overlay
    });

    // JavaScript untuk menyembunyikan form dan overlay ketika klik di luar form atau klik tombol Cancel
    document.getElementById('modalOverlay').addEventListener('click', function() {
        document.getElementById('myForm').style.display = 'none';
        document.getElementById('modalOverlay').style.display = 'none';
    });

    document.getElementById('cancelBtn').addEventListener('click', function() {
        document.getElementById('myForm').style.display = 'none';
        document.getElementById('modalOverlay').style.display = 'none';
    });

    // Mencegah penutupan form ketika di dalam form di klik
    document.getElementById('myForm').addEventListener('click', function(event) {
        event.stopPropagation();
    });
</script>
