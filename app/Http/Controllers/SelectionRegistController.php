<?php

namespace App\Http\Controllers;

use App\Models\Athlet;
use App\Models\Branch;
use App\Models\Coach;
use App\Models\SelectionRegist;
use App\Models\Submission;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SelectionRegistController extends Controller
{
    public function index()
    {
        $selections = SelectionRegist::all();
        return view('selections.index', compact('selections'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);
        $data = new SelectionRegist();
        $data->nama = $request->nama;
        $data->status = 1;
        $data->save();
        return redirect()->route('selections')
            ->with('success', 'Data berhasil disimpan.');
    }
    public function destroy(Request $request)
    {
        $data = SelectionRegist::find($request->id);
        $data->delete();
        return redirect()->route('selections')
            ->with('success', 'Data berhasil dihapus.');
    }
    public function details(Request $request)
    {
        $submissions = Submission::all()->where('selection_id', $request->id);
        $selection_id = $request->id;
        $selections = SelectionRegist::find($request->id);
        $status = $selections->status;
        $tests = Test::all()->where('selection_id', $request->id);
        if ($tests->count() != 0) {
            foreach ($tests as $test) {
                $test_id = $test->id;
                $coach_id = $test->coach_id;
                $statusp = $test->status;
            }
        }
        $coaches = Coach::all();
        return view('selections.details', compact('submissions', 'selection_id', 'status', 'tests', 'coaches', 'test_id', 'coach_id', 'statusp'));
    }
    public function close(Request $request)
    {
        $data = SelectionRegist::find($request->id);
        $data->status = 2;
        $data->update();
        return redirect()->back()
            ->with('success', 'Pengajuan ditutup.');
    }
    public function submissions(Request $request)
    {
        $selections = SelectionRegist::all()->where('status', 1);
        return view('submissions.index', compact('selections'));
    }
    public function submissionsdetails(Request $request)
    {
        $data = Branch::all()->where('user_id', Auth::user()->id);
        foreach ($data as $branch) {
            $submissions = Submission::all()->where('selection_id', $request->id)->where('branch_id', $branch->id);
            $submittedAthletes = Submission::where('selection_id', $request->id)->where('branch_id', $branch->id)->pluck('athlet_id');
            $athletes = Athlet::where('branch_id', $branch->id)->where('status', 3)->whereNotIn('id', $submittedAthletes)->get();
        }
        $selection_id = $request->id;
        return view('submissions.details', compact('submissions', 'athletes', 'selection_id'));
    }
    public function add(Request $request)
    {
        $request->validate([
            'selection_id' => 'required',
            'athlet_id' => 'required',
        ]);
        $branch = Branch::all()->where('user_id', Auth::user()->id)->first();
        $submissionsCount = Submission::where('selection_id', $request->selection_id)
            ->where('branch_id', $branch->id)
            ->count();

        if ($submissionsCount >= 10) {
            return redirect()->back()
                ->with('error', 'Maksimal 10 atlet telah diajukan.');
        }

        $data = new Submission();
        $data->selection_id = $request->selection_id;
        $data->athlet_id = $request->athlet_id;
        $data->branch_id = $branch->id;
        $data->save();
        return redirect()->back()
            ->with('success', 'Atlet berhasil diajukan.');
    }
    public function del(Request $request)
    {
        $data = Submission::find($request->id);
        $data->delete();
        return redirect()->back()
            ->with('success', 'Pengajuan dibatalkan.');
    }
}
