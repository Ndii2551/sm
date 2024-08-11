<?php

namespace App\Http\Controllers;

use App\Models\TestType;
use Illuminate\Http\Request;

class TestTypeController extends Controller
{
    public function index()
    {
        $types = TestType::all();
        return view('testtypes.index', compact('types'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'x' => 'required',
        ]);
        $data = new TestType();
        $data->nama = $request->nama;
        $data->x = $request->x;
        $data->save();
        return redirect()->route('testtypes')
            ->with('success', 'Data berhasil disimpan.');
    }
    public function update(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'x' => 'required',
        ]);
        $data = TestType::find($request->id);
        $data->nama = $request->nama;
        $data->x = $request->x;
        $data->update();
        return redirect()->route('testtypes')
            ->with('success', 'Data berhasil diubah.');
    }
    public function destroy(Request $request)
    {
        $data = TestType::find($request->id);
        $data->delete();
        return redirect()->route('testtypes')
            ->with('success', 'Data berhasil dihapus.');
    }
}
