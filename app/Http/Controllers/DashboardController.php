<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\History;
use App\Models\User;
use App\Models\Todo;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function view()
    {
        $totalProducts = Produk::count();
        $lowStockProducts = Produk::where('jumlah_barang', '<', 8)->get();
        $totalLowStockProducts = $lowStockProducts->count();
        $latestHistory = History::orderBy('created_at', 'desc')->first();
        $totalInProgressTodos = Todo::where('completed', false)->count();
        $totalNotEmployeeUsers = User::with('roles')->get()->filter(
            fn ($user) => $user->roles->where('name', 'user')->toArray()
        )->count();

        $topProducts = Produk::orderBy('jumlah_barang', 'desc')->take(5)->get();

        $productCountsByCategory = Produk::select('kategori', DB::raw('count(*) as total'))
            ->groupBy('kategori')
            ->pluck('total', 'kategori')
            ->toArray();

        $history = History::orderBy('created_at', 'desc')->paginate(10);

        $latestEdits = History::orderBy('created_at', 'desc')->limit(5)->get();

        $latestUsers = User::orderBy('created_at', 'desc')->take(8)->get();

        $title = 'Dashboard - 705 Storage';

        return view('dashboard', compact(
            'totalProducts',
            'lowStockProducts',
            'totalLowStockProducts',
            'latestHistory',
            'totalNotEmployeeUsers',
            'totalInProgressTodos',
            'topProducts',
            'productCountsByCategory',
            'latestEdits',
            'latestUsers',
            'title'
        ));
    }
}
