<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\produk;
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
    
    
        

    
        // if ($request->filled('sort')) {
        //     $sortDirection = $request->input('sort') == 'asc' ? 'asc' : 'desc';
        //     $query->orderBy('jumlah_barang', $sortDirection);
        // }
        // $produk = $query->get();
        // return view('dashboardlte', ['produk' => $produk, 'request'=>$request]);
        
        // if($search = $request->get('search')){
        //     $query = $query->whereRaw('LOWER(nama_produk) LIKE ?', ['%' . strtolower($search) . '%']);
        // }

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

