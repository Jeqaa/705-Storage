# 705 Storage
**Kelompok 2:**
 - Shinzi (535220118)
 - Jonathan Kennedy Torsandy (535220127)
 - Gabriel Nathanael Irawan (535220142)
 - Felix Ferdinand (535220161)

## Tentang Website
Website ini dibuat dengan sesuai mitra (705 Net Official) dari usaha bisnis yang fokus ke makanan burung. Penjualan makanan burung tersebut dijual secara daring. Mitra 705 Net Official tidak memiliki toko fisik dan proses produksi berada di lokasi yang berbeda (gudang). Produk yang diambil dari gudang ke tempat penjualan  diproses dan dijual ke pembeli secara daring.  Pengambilan setiap produk tersebut dihitung dan yang stoknya rendah dikirimkan ke grup WhatsApp kepada Admin penjualan untuk memproduksi stok produk yang rendah. Oleh karena itu, diperlukan sebuah aplikasi atau website yang dapat mencatakan produk stok yang rendah dan mencatat tanggal dan waktu stok baru yang dimasukkan.

## Fitur-Fitur
 - Login dan register dengan verifikasi email dan lupa password.
 - Menu Dashboard menunjukkan overview (box, grafik, dan informasi singkat).
 - Menu Products berfungsi untuk tambah produk, edit (mengganti nama, kategori, dan jumlah/stok), dan menghapus produk yang ada.
 - Menu History menunjukkan riwayat data yang mengatur di menu Products.
 - Menu Todo dapat digunakan untuk menuliskan note/catatan yang harus dilakukan. Pada menu ini dapat membuat todo/catatan dengan *pinned* supaya dapat ditunjukkan di paling atas kolom. Edit dan menggantikan judul, deskripsi, menambahkan dan menghapus *pinned*. Setiap todo dapat di tandai sudah selesai dan tidak selesai. Todo yang belum selesai dilakukan dan yang sudah dilakukan dapat di hapuskan.
 - Menu Permission digunakan untuk membuat, merubah, dan menghapus permission yang digunakan untuk izin dari semua halaman.
 - Menu Roles dapat digunakan untuk membuat, merubah, dan menghapus role.
 - Menu Active Roles adalah tempat di mana suatu role dapat diberikan 1 atau lebih permission. Pada menu ini dapat juga di ubah permission pada role yang sudah ada dan menghapus role.
 - Menu User Management untuk mengatur user/pengguna. Dalam halaman ini, dapat mengubah nama, email, dan role dari pengguna tersebut. Pada halaman inilah, user yang baru registrasi harus di ganti role menjadi role yang mempunyai akses (seperti karyawan) agar dapat mengakses website.
 - Menu Announcement dapat digunakan untuk mengirimkan pengumuman dan diaktifkan biasanya oleh admin (dapat juga dengan role yang mempunyai group permission announcement). Pengumuman ini ditampilkan pada halaman dashboard.

## Instalasi

 1. Clone repistory.
    ```
    git clone https://github.com/Jeqaa/705-Storage.git
    ```

 2. Install dependency 
    ```
    composer install
    npm install
    ```

3. Copy environment (.env) example dan isi .env sesuai dengan perangkat dan database yang digunakan.
    ```
    cp .env.example .env
    ```

4. Generate key untuk APP_KEY pada file .env.
    ```
    php artisan key:generate
    ```

5. Lakukan seed database untuk mendapatkan data dummy dan akun yang dapat digunakan langsung.
    ```    
    php artisan migrate
    php artisan db:seed
    ```

6. Jalankan server.
    ```    
    php artisan serve
    npm run dev
    ```

7. Akses website melalui `http://127.0.0.1:8000` atau `http://localhost:8000`

## Akun buatan (seed)
Beberapa akun dapat digunakan langsung untuk testing.
 - admin@mail.com dengan role admin yang dapat akses semua fitur.
 - emp@mail.com dengan role employee yang dapat akses fitur untuk karyawan (seperti dashboard, product management, history, dan to-do).
 - user@mail.com dengan role user yang tidak dapat akses website sama sekali (butuh penggantian role ke role lainnya (dengan salah satu permission) agar dapat mengakses website.
 - emp2@mail.com dapat digunakan hingga emp3@mail.com
 - user2@mail.com dapat digunakan hingga user5@mail.com
 
Password yang digunakan pada semua akun buatan tersebut adalah **password**

