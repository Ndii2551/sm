<?php

namespace App\Http\Controllers;

use App\Models\Athlet;
use App\Models\Branch;
use App\Models\Coach;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AthletController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 1) {
            $athletes = Athlet::all()->whereIn('status', [3, 4]);
            return view('athletes.index', compact('athletes'));
        } elseif (Auth::user()->role_id == 2) {
            $data = Branch::all()->where('user_id', Auth::user()->id);
            foreach ($data as $branch) {
                $athletes = Athlet::all()->where('branch_id', $branch->id)->whereIn('status', [3, 4]);
            }
            return view('branchathletes.index', compact('athletes'));
        }
    }
    public function status(Request $request, Athlet $data)
    {
        $request->validate([
            'status' => 'required',
        ]);
        $data = Athlet::find($request->id);
        $data->status = $request->status;
        $data->update();
        if (Auth::user()->role_id == 1) {
            return redirect()->route('athletes')
                ->with('success', 'Status atlet berhasil diubah.');
        } elseif (Auth::user()->role_id == 2) {
            return redirect()->route('branchathletes')
                ->with('success', 'Status atlet berhasil diubah.');
        }
    }
    public function athletesunvalidate()
    {
        $athletes = Athlet::all()->where('status', 2);
        return view('athletesunvalidate.index', compact('athletes'));
    }
    public function unvalidate()
    {
        $data = Branch::all()->where('user_id', Auth::user()->id);
        foreach ($data as $branch) {
            $athletes = Athlet::all()->where('branch_id', $branch->id)->where('status', 1);
            return view('unvalidate.index', compact('athletes'));
        }
    }
    public function valid(Request $request, Athlet $data, User $user)
    {
        if (Auth::user()->role_id == 1) {
            $data = Athlet::find($request->id);
            $data->status = 3;
            $data->update();
            $user = User::find($data->user_id);
            $user->role_id = 4;
            $user->update();
            return redirect()->route('athletesunvalidate')
                ->with('success', 'Validasi berhasil.');
        } elseif (Auth::user()->role_id == 2) {
            $data = Athlet::find($request->id);
            $data->status = 2;
            $data->update();
            return redirect()->route('unvalidate')
                ->with('success', 'Validasi berhasil.');
        }
    }
    public function invalid(Request $request, Athlet $data)
    {
        $data = Athlet::find($request->id);
        $file_path1 = public_path('uploads/dokumen_atlet/' . $data->pasfoto);
        if (file_exists($file_path1)) {
            unlink($file_path1); // delete the file
        }
        $file_path2 = public_path('uploads/dokumen_atlet/' . $data->f_akta);
        if (file_exists($file_path2)) {
            unlink($file_path2); // delete the file
        }
        $file_path3 = public_path('uploads/dokumen_atlet/' . $data->f_kk);
        if (file_exists($file_path3)) {
            unlink($file_path3); // delete the file
        }
        $data->delete();
        if (Auth::user()->role_id == 1) {

            return redirect()->route('athletesunvalidate')
                ->with('success', 'Data berhasil dihapus.');
        } elseif (Auth::user()->role_id == 2) {

            return redirect()->route('unvalidate')
                ->with('success', 'Data berhasil dihapus.');
        }
    }
    public function dashboard()
    {
        $datas = Athlet::all()->where('user_id', Auth::user()->id);
        $branches = Branch::all();
        $branchesc = Branch::all()->where('status', 1)->count();
        $coachesc = Coach::all()->where('status', 1)->count();
        $athletesc = Athlet::all()->where('status', 3)->count();
        if (Auth::user()->role_id == 5) {
            return view('dashboard', compact('datas', 'branches'));
        } else {
            return view('dashboard', compact('branchesc', 'coachesc', 'athletesc'));
        }
    }
    public function athletdata()
    {
        $datas = Athlet::all()->where('user_id', Auth::user()->id);
        $branches = Branch::all();
        return view('athletdata.index', compact('datas', 'branches'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'branch_id' => 'required',
            'nama' => 'required',
            'pasfoto' => 'required|file',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'no_nik' => 'required',
            'no_kk' => 'required',
            'f_akta' => 'required|file',
            'f_kk' => 'required|file',
        ]);
        $file1 = $request->file('pasfoto');
        $filename1 = now()->format('YmdHis') . $request->user_id . 'pasfoto.' . $file1->getClientOriginalExtension();
        $file2 = $request->file('f_akta');
        $filename2 = now()->format('YmdHis') . $request->user_id . 'f_akta.' . $file2->getClientOriginalExtension();
        $file3 = $request->file('f_kk');
        $filename3 = now()->format('YmdHis') . $request->user_id . 'f_kk.' . $file3->getClientOriginalExtension();
        $destination_path = public_path('uploads/dokumen_atlet');

        $file1->move($destination_path, $filename1);
        $file2->move($destination_path, $filename2);
        $file3->move($destination_path, $filename3);

        $data = new Athlet();
        $data->user_id = $request->user_id;
        $data->branch_id = $request->branch_id;
        $data->nama = $request->nama;
        $data->pasfoto = $filename1;
        $data->tempat_lahir = $request->tempat_lahir;
        $data->tgl_lahir = $request->tgl_lahir;
        $data->jenis_kelamin = $request->jenis_kelamin;
        $data->alamat = $request->alamat;
        $data->no_hp = $request->no_hp;
        $data->no_nik = $request->no_nik;
        $data->no_kk = $request->no_kk;
        $data->f_akta = $filename2;
        $data->f_kk = $filename3;
        $data->status = 1;
        $data->save();
        return redirect()->route('dashboard')
            ->with('success', 'Data berhasil disimpan.');
    }

    public function update(Request $request, Athlet $data)
    {
        $request->validate([
            'branch_id' => 'required',
            'nama' => 'required',
            'pasfoto' => 'nullable|file',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'no_hp' => 'required',
            'no_nik' => 'required',
            'no_kk' => 'required',
            'f_akta' => 'nullable|file',
            'f_kk' => 'nullable|file',
        ]);
        $destination_path = public_path('uploads/dokumen_atlet');
        $data = Athlet::find($request->id);
        $data->branch_id = $request->branch_id;
        $data->nama = $request->nama;
        if ($request->hasFile('pasfoto')) {
            $file1 = $request->file('pasfoto');
            $filename1 = now()->format('YmdHis') . $data->user_id . 'pasfoto.' . $file1->getClientOriginalExtension();

            // Delete the old file
            $old_file_path1 = public_path('uploads/dokumen_atlet/' . $data->pasfoto);
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
        if ($request->hasFile('f_akta')) {
            $file2 = $request->file('f_akta');
            $filename2 = now()->format('YmdHis') . $data->user_id . 'f_akta.' . $file2->getClientOriginalExtension();

            // Delete the old file
            $old_file_path2 = public_path('uploads/dokumen_atlet/' . $data->f_akta);
            if (file_exists($old_file_path2)) {
                unlink($old_file_path2); // delete the old file
            }

            $file2->move($destination_path, $filename2);
            $data->f_akta = $filename2;
        }
        if ($request->hasFile('f_kk')) {
            $file3 = $request->file('f_kk');
            $filename3 = now()->format('YmdHis') . $data->user_id . 'f_kk.' . $file3->getClientOriginalExtension();

            // Delete the old file
            $old_file_path3 = public_path('uploads/dokumen_atlet/' . $data->f_kk);
            if (file_exists($old_file_path3)) {
                unlink($old_file_path3); // delete the old file
            }

            $file3->move($destination_path, $filename3);
            $data->f_kk = $filename3;
        }
        $data->update();
        return redirect()->route('dashboard')
            ->with('success', 'Data berhasil diubah.');
    }
}
