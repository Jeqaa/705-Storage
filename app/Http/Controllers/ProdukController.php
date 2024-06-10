<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\produk;
class ProdukController extends Controller
{
    public function index()
    {
        $produk = produk::all();
        $title = 'Home';
        return view('home',['produk' => $produk,'title'=>$title]);
    }

    public function store(Request $request)
    {
        $nama_produk = $request->input('nama_produk');
        $kategori = $request->input('kategori');
        $jumlah_barang = $request->input('jumlah_barang');

        $now = \Carbon\Carbon::now('Asia/Jakarta');

        $result = DB::insert('INSERT INTO produk (nama_produk, kategori, jumlah_barang, created_at, updated_at) VALUES (?, ?, ?, ?, ?)', [$nama_produk, $kategori, $jumlah_barang, $now, $now]);

        if ($result) {
            return redirect('/')->with('success', 'Data berhasil dimasukkan!');
        } else {
            return redirect('/')->with('error', 'Gagal memasukkan data.');
        }
    }

    public function destroy($nama_produk)
    {
        $prd = Produk::findOrFail($nama_produk);
        $prd->delete();

        return redirect()->route('produk')->with('success', 'Produk deleted successfully.');
    }
}



