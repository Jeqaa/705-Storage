<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\produk;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class ProdukController extends Controller
{
    public function index()
    {
        $produk = produk::all();
        return view('dashboardlte',['produk' => $produk]);

    }

    public function search(Request $request)
    {
        $query = Produk::query();

        // Filter berdasarkan pencarian
        if ($request->filled('search')) {
            $search = strtolower($request->input('search'));
            $query->whereRaw('LOWER(nama_produk) LIKE ?', ["%{$search}%"]);
        }

        // Filter berdasarkan kategori
        if ($request->filled('category') && $request->input('category') != 'all') {
            $category = $request->input('category');
            if ($category == 'best_seller') {
                $query->where('kategori', '=', 'Best Seller');
            } else if ($category == 'other') {
                $query->where('kategori', '=', 'Other');
            }
        }

        // Mengatur pengurutan
        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            if ($sort == 'asc') {
                $query->orderBy('jumlah_barang', 'asc');
            } else if ($sort == 'desc') {
                $query->orderBy('jumlah_barang', 'desc');
            }
        }

        $produk = $query->get();

            // Jika request adalah AJAX, kembalikan response JSON atau HTML
        // if ($request->ajax()) {
        //     return view('/layouts/table', ['produk' => $produk])->render();
        // }

        return view('/layoutslte/table', ['produk' => $produk]);
    }

    public function store(Request $request)
    {
        $nama_produk = $request->input('nama_produk');
        $kategori = $request->input('kategori');
        $jumlah_barang = $request->input('jumlah_barang');

        $now = \Carbon\Carbon::now('Asia/Jakarta');

        $inputNamaProduk = strtolower(str_replace(' ', '', $request->input('nama_produk')));
        $productCount = produk::whereRaw('LOWER(REPLACE(nama_produk, \' \', \'\')) = ?', [$inputNamaProduk])
                              ->count();



        if($productCount>0)  {
            $errorMsg = 'Tidak Dapat Membuat Produk Baru Dengan Nama Yang Sudah Ada.';
            return view('error', compact('errorMsg'));
        }  else{
            $result = DB::insert('INSERT INTO produk (nama_produk, kategori, jumlah_barang, created_at, updated_at) VALUES (?, ?, ?, ?, ?)', [
                $nama_produk,
                $kategori,
                $jumlah_barang,
                $now,
                $now]);

            $username = Auth::user()->name;
            $insertToHistory = DB::insert('INSERT INTO history (username, nama_produk, keterangan, jumlah_barang, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [
                $username,
                $nama_produk,
                'Membuat Produk Baru',
                $jumlah_barang,
                $now,
                $now
            ]);

            if ($result) {
                return redirect('/')->with('success', 'Data berhasil dimasukkan!');
            } else {
                return redirect('/')->with('error', 'Gagal memasukkan data.');
            }
        }
    }

    public function destroy($id)
    {
        $prd = produk::find($id);
        $nama_produk = $prd->nama_produk;
        $now = \Carbon\Carbon::now('Asia/Jakarta');

        $username = Auth::user()->name;
        $insertToHistory = DB::insert('INSERT INTO history (username, nama_produk, keterangan, jumlah_barang, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [
            $username,
            $nama_produk,
            'Menghapus Produk',
            '-',
            $now,
            $now
        ]);
        $prd->delete();

        return redirect()->route('produk')->with('success', 'Produk deleted successfully.');
    }

    public function edit($id){
        $prd = produk::find($id);
        return view('produk.edit',compact('prd'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_produk' => 'required',
            'kategori' => 'required',
            'jumlah_barang' => 'required',
        ]);

        // variabel yang menyimpan waktu sekarang
        $now = \Carbon\Carbon::now('Asia/Jakarta');

        $update = [
            'nama_produk'=>$request->input('nama_produk'),
            'kategori'=>$request->input('kategori'),
            'jumlah_barang'=>$request->input('jumlah_barang'),
            'updated_at'=>$now
        ];

        // untuk mencari apakah sebelumnya itu sudah ada produk yang sama
        $inputNamaProduk = strtolower(str_replace(' ', '', $request->input('nama_produk')));
        $productCount = produk::whereRaw('LOWER(REPLACE(nama_produk, \' \', \'\')) = ?', [$inputNamaProduk])
        ->where('id', '<>', $id)
        ->count();

        // kalau ternyata user mencoba mengedit nama proudk ke nama yang sudah ada, maka akan masuk ke if, jika tidak maka akan ke else
        if ($productCount > 0) {
            // error message untuk user yang mencoba mengganti nama produk menggunakan yang sudah ada
            $errorMsg = 'Tidak Dapat Mengganti Nama Produk Dengan Yang Sudah Ada.';
            return view('error', compact('errorMsg'));
        } else {
            // inisialisasi variabel pendukung
            $gantiNama = 'False';
            $keteranganList = [];
            $username = Auth::user()->name;

            // ambil data produk sebelum diupdate (yang nanti akan dipakai untuk membandingkan)
            $data_barang_lama = produk::where('id', $id)
            ->first();
            $jumlah_barang_lama = $data_barang_lama->jumlah_barang;
            $nama_barang_lama = $data_barang_lama->nama_produk;
            $kategori_barang_lama = $data_barang_lama->kategori;

            // update produk
            produk::whereId($id)->update($update);
            $data_barang_baru = produk::where('id', $id)
            ->first();

            // ambil data produk setelah diupdate (yang nanti akan dipakai untuk membandingkan)
            $jumlah_barang_baru = $data_barang_baru->jumlah_barang;
            $nama_barang_baru = $data_barang_baru->nama_produk;
            $kategori_barang_baru = $data_barang_baru->kategori;

            // untuk menghitung berapa jumlah produk yang berubah
            $sum = abs($jumlah_barang_lama - $jumlah_barang_baru);

            // untuk menuliskan keterangan, apa saja yang diubah oleh user
            if($nama_barang_lama != $nama_barang_baru){
                $keteranganList[] = "Mengganti Nama Produk";
            }
            if ($jumlah_barang_lama < $jumlah_barang_baru){
                $keteranganList[] = "Menambahkan Produk";
            }
            if ($jumlah_barang_lama > $jumlah_barang_baru){
                $keteranganList[] = "Mengurangi Produk";
            }
            if ($kategori_barang_lama != $kategori_barang_baru){
                $keteranganList[] = "Mengubah Kategori Produk";
            }

            // untuk menambahkan data ke tabel history jika memang terjadi perubahan (jadi kalau tidak ada perubahan yg dilakukan
            // pasti keteranganList itu null)
            if($keteranganList){
                $keterangan = implode(', ', $keteranganList);

                $insertToHistory = DB::insert('INSERT INTO history (username, nama_produk, keterangan, jumlah_barang, created_at, updated_at) VALUES (?, ?, ?, ?, ?, ?)', [
                    $username,
                    $request->input('nama_produk'),
                    $keterangan,
                    $sum,
                    $now,
                    $now
                ]);

            }

            // untuk kembali ke halaman produk
            return redirect()->route('produk')
            ->with('success','Produk Berhasil Diupdate');
        }

    }
}

