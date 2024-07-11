<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = Coach::all();
        return view('coaches.index', compact('coaches'));
    }
    public function coachdata()
    {
        $datas = Coach::all()->where('user_id', Auth::user()->id);
        return view('coachdata.index', compact('datas'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'nama' => 'required',
            'pasfoto' => 'required|file',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'no_nik' => 'required',
            'no_kk' => 'required',
            'f_ktp' => 'required|file',
            'f_kk' => 'required|file',
        ]);
        $file1 = $request->file('pasfoto');
        $filename1 = now()->format('YmdHis') . $request->user_id . 'pasfoto.' . $file1->getClientOriginalExtension();
        $file2 = $request->file('f_ktp');
        $filename2 = now()->format('YmdHis') . $request->user_id . 'ktp.' . $file2->getClientOriginalExtension();
        $file3 = $request->file('f_kk');
        $filename3 = now()->format('YmdHis') . $request->user_id . 'kk.' . $file3->getClientOriginalExtension();
        $destination_path = public_path('uploads/dokumen_pelatih');

        $file1->move($destination_path, $filename1);
        $file2->move($destination_path, $filename2);
        $file3->move($destination_path, $filename3);

        $data = new Coach();
        $data->user_id = $request->user_id;
        $data->nama = $request->nama;
        $data->pasfoto = $filename1;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->no_nik = $request->no_nik;
        $data->no_kk = $request->no_kk;
        $data->f_ktp = $filename2;
        $data->f_kk = $filename3;
        $data->status = 1;
        $data->save();
        return redirect()->route('coachdata')
            ->with('success', 'Data berhasil disimpan.');
    }

    public function update(Request $request, Coach $data)
    {
        $request->validate([
            'nama' => 'required',
            'pasfoto' => 'nullable|file',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'no_nik' => 'required',
            'no_kk' => 'required',
            'f_ktp' => 'nullable|file',
            'f_kk' => 'nullable|file',
        ]);
        $destination_path = public_path('uploads/dokumen_pelatih');
        $data = Coach::find($request->id);
        $data->nama = $request->nama;
        if ($request->hasFile('pasfoto')) {
            $file1 = $request->file('pasfoto');
            $filename1 = now()->format('YmdHis') . $data->user_id . 'pasfoto.' . $file1->getClientOriginalExtension();

            // Delete the old file
            $old_file_path1 = public_path('uploads/dokumen_pelatih/' . $data->pasfoto);
            if (file_exists($old_file_path1)) {
                unlink($old_file_path1); // delete the old file
            }

            $file1->move($destination_path, $filename1);
            $data->pasfoto = $filename1;
        }
        $data->tempat_lahir = $request->tempat_lahir;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->no_nik = $request->no_nik;
        $data->no_kk = $request->no_kk;
        if ($request->hasFile('f_ktp')) {
            $file2 = $request->file('f_ktp');
            $filename2 = now()->format('YmdHis') . $data->user_id . 'f_ktp.' . $file2->getClientOriginalExtension();

            // Delete the old file
            $old_file_path2 = public_path('uploads/dokumen_pelatih/' . $data->f_ktp);
            if (file_exists($old_file_path2)) {
                unlink($old_file_path2); // delete the old file
            }

            $file2->move($destination_path, $filename2);
            $data->f_ktp = $filename2;
        }
        if ($request->hasFile('f_kk')) {
            $file3 = $request->file('f_kk');
            $filename3 = now()->format('YmdHis') . $data->user_id . 'f_kk.' . $file3->getClientOriginalExtension();

            // Delete the old file
            $old_file_path3 = public_path('uploads/dokumen_pelatih/' . $data->f_kk);
            if (file_exists($old_file_path3)) {
                unlink($old_file_path3); // delete the old file
            }

            $file3->move($destination_path, $filename3);
            $data->f_kk = $filename3;
        }
        $data->update();
        return redirect()->route('coachdata')
            ->with('success', 'Data berhasil diubah.');
    }
    public function status(Request $request, Coach $data)
    {
        $request->validate([
            'status' => 'required',
        ]);
        $data = Coach::find($request->id);
        $data->status = $request->status;
        $data->update();
        return redirect()->route('coaches')
            ->with('success', 'Status pelatih berhasil diubah.');
    }
}
