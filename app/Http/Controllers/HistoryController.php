<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\history;
class HistoryController extends Controller
{
    public function index()
    {
        $history = History::orderBy('created_at', 'desc')->simplePaginate(15);
        return view('history', ['history' => $history]);
    }
}
