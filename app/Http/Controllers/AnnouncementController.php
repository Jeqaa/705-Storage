<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class AnnouncementController extends Controller
{
    public function index()
    {
        $announcements = Announcement::orderBy('show', 'desc')->paginate(10);
        $title = 'Announcements - 705 Storage';
        return view('announcement.view', ['announcements' => $announcements, 'title' => $title]); // Update view path
    }

    public function create()
    {
        return view('announcement.create'); // Update view path
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $data = $request->all();
        $data['show'] = $request->has('show') ? $request->show : false;

        if ($data['show']) {
            Announcement::where('show', true)->update(['show' => false]);
        }

        Announcement::create($data);

        return redirect()->route('announcement.view')->with('success', 'Announcement created successfully');
    }

    public function show($id)
    {
        $announcement = Announcement::findOrFail($id);
        $title = 'Announcements - 705 Storage';
        return view('announcement.show', ['announcement' => $announcement, 'title' => $title]); // Update view path
    }

    public function edit($id)
    {
        $announcement = Announcement::findOrFail($id);
        $title = 'Announcements - 705 Storage';
        return view('announcement.edit', ['announcement' => $announcement, 'title' => $title]); // Update view path
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $announcement = Announcement::findOrFail($id);
        $data = $request->all();
        $data['show'] = $request->has('show') ? $request->show : false;

        if ($data['show']) {
            Announcement::where('show', true)->update(['show' => false]);
        }

        $announcement->update($data);

        return redirect()->route('announcement.view')->with('success', 'Announcement updated successfully');
    }

    public function delete($id)
    {
        $announcement = Announcement::findOrFail($id);
        $announcement->delete();

        return redirect()->route('announcement.view')->with('success', 'Announcement deleted successfully');
    }

    public function toggleShow($id)
    {
        $announcement = Announcement::findOrFail($id);

        if ($announcement->show) {
            // If the announcement is already true, toggle it off (false)
            $announcement->update(['show' => false]);
            $message = 'Announcement deselected successfully';
        } else {
            // If the announcement is false, toggle it on (true)
            Announcement::where('show', true)->update(['show' => false]);
            $announcement->update(['show' => true]);
            $message = 'Announcement selected successfully';
        }

        return redirect()->route('announcement.view')->with('success', $message);
    }
}
