<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\History;
use App\Models\User;
use App\Models\Todo;
use App\Models\Announcement;

class DashboardController extends Controller
{
    public function view()
    {
        $totalProducts = Produk::count();
        $lowStockProducts = Produk::where('jumlah_barang', '<', 8)->get();
        $totalLowStockProducts = $lowStockProducts->count();
        $latestHistory = History::orderBy('created_at', 'desc')->first();
        $totalInProgressTodos = Todo::where('completed', 'false')->get()->count();
        $totalNotEmployeeUsers = User::with('roles')->get()->filter(
            fn ($user) => $user->roles->where('name', 'user')->toArray()
        )->count();
        $showedAnnouncement = Announcement::where('show', true)->first();


        return view('dashboard', compact(
            'totalProducts',
            'lowStockProducts',
            'totalLowStockProducts',
            'latestHistory',
            'totalNotEmployeeUsers',
            'totalInProgressTodos',
            'showedAnnouncement'
        ));
    }
}
