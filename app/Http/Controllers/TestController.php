<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'selection_id' => 'required',
            'coach_id' => 'required',
        ]);
        $data = new Test();
        $data->selection_id = $request->selection_id;
        $data->coach_id = $request->coach_id;
        $data->status = 1;
        $data->save();
        return redirect()->back()
            ->with('success', 'Pengaturan tes berhasil disimpan.');
    }
    public function update(Request $request)
    {
        $request->validate([
            'coach_id' => 'required',
            'status' => 'required',
        ]);
        $data = Test::find($request->id);
        $data->coach_id = $request->coach_id;
        $data->status = $request->status;
        $data->update();
        return redirect()->back()
            ->with('success', 'Pengaturan tes berhasil disimpan.');
    }
}
