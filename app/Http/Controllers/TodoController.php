<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Auth;

class TodoController extends Controller
{
    public function viewTodos()
    {
        $todos = Auth::user()->todos;

        $title = 'To-do - 705 Storage';
        return view('todos.view_todos', compact('todos', 'title'));
    }

    // tambah todo
    public function todoStore(Request $request)
    {
        $todo = new Todo();
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->completed = false;
        $todo->pinned = $request->has('pinned');
        $todo->user_id = Auth::id();
        $todo->save();

        return redirect()->route('to-dos.view')->with([
            'mixin-type' => 'success',
            'mixin-title' => 'To-do berhasil ditambahkan.',
        ]);
    }

    public function editTodo($id)
    {
        $todo = Todo::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $title = 'Edit To-do - 705 Storage';
        return view('todos.edit_todos', compact('todo', 'title'));
    }

    // update judul, deskripsi, dan pin todo
    public function updateTodo(Request $request, $id)
    {
        $todo = Todo::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $todo->title = $request->title;
        $todo->description = $request->description;
        $todo->pinned = $request->has('pinned');
        $todo->save();

        return redirect()->route('to-dos.view')->with([
            'mixin-type' => 'success',
            'mixin-title' => 'To-do berhasil diperbarui.',
        ]);
    }

    // tandai todo menjadi selesai
    public function markAsDone($id)
    {
        $todo = Todo::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $todo->completed = true;
        $todo->save();

        return redirect()->route('to-dos.view')->with([
            'mixin-type' => 'success',
            'mixin-title' => 'To-do ditandai selesai',
        ]);
    }

    // tandai todo menjadi belum selesai
    public function markAsUndone($id)
    {
        $todo = Todo::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $todo->completed = false;
        $todo->save();

        return redirect()->route('to-dos.view')->with([
            'mixin-type' => 'success',
            'mixin-title' => 'To-do ditandai belum selesai.',
        ]);
    }

    // delete todo
    public function deleteTodo($id)
    {
        $todo = Todo::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $todo->delete();

        return redirect()->route('to-dos.view')->with([
            'mixin-type' => 'success',
            'mixin-title' => 'To-do berhasil dihapus.',
        ]);
    }
}
