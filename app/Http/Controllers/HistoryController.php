<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\history;

class HistoryController extends Controller
{
    public function index()
    {
        $history = History::orderBy('created_at', 'desc')->Paginate(10);
        $title = 'History - 705 Storage';
        return view('history', ['history' => $history, 'title' => $title]);
    }
}
