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
        // $title = 'Home';
        return view('dashboardlte',['produk' => $produk]);
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
            $result = DB::insert('INSERT INTO produk (nama_produk, kategori, jumlah_barang, created_at, updated_at) VALUES (?, ?, ?, ?, ?)', [$nama_produk, $kategori, $jumlah_barang, $now, $now]);

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
        $now = \Carbon\Carbon::now('Asia/Jakarta');

        $update = [
            'nama_produk'=>$request->input('nama_produk'),
            'kategori'=>$request->input('kategori'),
            'jumlah_barang'=>$request->input('jumlah_barang'),
            'updated_at'=>$now
        ];
        
        $inputNamaProduk = strtolower(str_replace(' ', '', $request->input('nama_produk')));
        $productCount = produk::whereRaw('LOWER(REPLACE(nama_produk, \' \', \'\')) = ?', [$inputNamaProduk])
                        ->where('id', '<>', $id)
                        ->count();
        
        if ($productCount > 0) {
            // Lakukan sesuatu jika data tidak ditemukan
            $errorMsg = 'Tidak Dapat Mengganti Nama Produk Dengan Yang Sudah Ada.';
            return view('error', compact('errorMsg'));
        } else {
                // Lakukan pembaruan data jika data tersebut tidak ada
            produk::whereId($id)->update($update);
            return redirect()->route('produk')
            ->with('success','Produk Berhasil Diupdate');
        }

    }
}

