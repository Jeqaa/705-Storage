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

