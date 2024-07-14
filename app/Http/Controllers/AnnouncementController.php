<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $datas = Announcement::all();
        return view('announcements.index', compact('datas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'file' => 'required|file',
        ]);
        $file = $request->file('file');
        $filename = now()->format('YmdHis') . $request->user_id . 'announcement.' . $file->getClientOriginalExtension();
        $destination_path = public_path('uploads/pengumuman');
        $file->move($destination_path, $filename);

        $data = new Announcement();
        $data->judul = $request->judul;
        $data->file = $filename;
        $data->save();
        return redirect()->route('announcements')
            ->with('success', 'Pengumuman berhasil publish.');
    }
    public function destroy(Request $request, Announcement $data)
    {
        $data = Announcement::find($request->id);
        $old_file_path = public_path('uploads/pengumuman/' . $data->file);
        if (file_exists($old_file_path)) {
            unlink($old_file_path); // delete the old file
        }
        $data->delete();
        return redirect()->route('announcements')
            ->with('success', 'Pengumuman berhasil dihapus.');
    }
}
