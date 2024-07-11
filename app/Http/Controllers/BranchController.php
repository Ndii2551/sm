<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BranchController extends Controller
{
    public function index()
    {
        $branches = Branch::all();
        return view('branches.index', compact('branches'));
    }
    public function branchdata()
    {
        $datas = Branch::all()->where('user_id', Auth::user()->id);
        return view('branchdata.index', compact('datas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'nama' => 'required',
            'cabang' => 'required',
            'no_sk' => 'required',
        ]);
        $data = new Branch();
        $data->user_id = $request->user_id;
        $data->nama = $request->nama;
        $data->cabang = $request->cabang;
        $data->no_sk = $request->no_sk;
        $data->status = 1;
        $data->save();
        return redirect()->route('branchdata')
            ->with('success', 'Data berhasil disimpan.');
    }

    public function update(Request $request, Branch $data)
    {
        $request->validate([
            'cabang' => 'required',
            'no_sk' => 'required',
            'status' => 'required',
        ]);
        $data = Branch::find($request->id);
        $data->cabang = $request->input('cabang');
        $data->no_sk = $request->input('no_sk');
        $data->status = $request->input('status');
        $data->update();
        if (Auth::user()->role_id == 1) {
            return redirect()->route('branches')
                ->with('success', 'Data berhasil diubah.');
        } elseif (Auth::user()->role_id == 2) {
            return redirect()->route('branchdata')
                ->with('success', 'Data berhasil diubah.');
        }
    }
}
