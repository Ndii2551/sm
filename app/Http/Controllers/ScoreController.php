<?php

namespace App\Http\Controllers;

use App\Models\Athlet;
use App\Models\Coach;
use App\Models\Score;
use App\Models\Submission;
use App\Models\Test;
use App\Models\TestType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ScoreController extends Controller
{
    public function index()
    {
        $data = Coach::all()->where('user_id', Auth::user()->id);
        foreach ($data as $coach) {
            $tests = Test::all()->where('coach_id', $coach->id)->where('status', 1);
        }
        return view('scores.index', compact('tests'));
    }
    public function details(Request $request)
    {
        $tests = Test::all()->where('id', $request->id);
        $test_id = $request->id;
        $athlet = $request->input('athlet');
        foreach ($tests as $item) {
            $person = Submission::all()->where('selection_id', $item->selection_id);
        }
        $scores = Score::all()->where('test_id', $test_id)->where('athlet_id', $athlet);
        $types = TestType::all();
        return view('scores.details', compact('tests', 'types', 'person', 'test_id', 'athlet', 'scores'));
    }
    public function store(Request $request)
    {
        $test_id = $request->test_id;
        $athlet_id = $request->athlet_id;
        $types = TestType::all();
        $data = [];
        $x = 0;
        foreach ($types as $item) {
            $x++;
            for ($i = 1; $i <= $item->x; $i++) {
                $key = $x . '_' . $i;
                $data[] = [
                    'test_id' => $test_id,
                    'nama' => $item->nama,
                    'tahap' => $i,
                    'athlet_id' => $athlet_id,
                    'nilai' => $request->input($key),
                ];
            }
        }
        Score::insert($data);
        return redirect()->back()
            ->with('success', 'Nilai berhasil diinput.');
    }
    public function update(Request $request)
    {
        $request->validate([
            'nilai' => 'required',
        ]);
        $data = Score::find($request->id);
        $data->nilai = $request->nilai;
        $data->update();
        return redirect()->back()
            ->with('success', 'Nilai berhasil diinput.');
    }
    public function stats()
    {
        $data = Coach::all()->where('user_id', Auth::user()->id);
        foreach ($data as $coach) {
            $tests = Test::all()->where('coach_id', $coach->id)->where('status', 1);
        }

        return view('stats.index', compact('tests'));
    }
    public function statdetails(Request $request)
    {
        $tests = Test::all()->where('id', $request->id);
        $test_id = $request->id;
        $athlet = $request->input('athlet');
        $type = $request->input('type');
        foreach ($tests as $item) {
            $person = Submission::all()->where('selection_id', $item->selection_id);
        }
        $scores = Score::all()->where('nama', $type)->where('athlet_id', $athlet);
        $types = TestType::all();
        $types1 = TestType::all()->first();
        return view('stats.details', compact('tests', 'types', 'types1', 'person', 'test_id', 'athlet', 'scores', 'type'));
    }
    public function mystats(Request $request)
    {
        $athlet = Athlet::all()->where('user_id', Auth::user()->id);
        foreach ($athlet as $data) {
            $types1 = TestType::all()->first();
            $type = $request->input('type');
            if ($type == '') {
                $scores = Score::all()->where('nama', $types1->nama)->where('athlet_id', $data->id);
            } else {
                $scores = Score::all()->where('nama', $type)->where('athlet_id', $data->id);
            }
        }
        $types = TestType::all();

        return view('mystats.index', compact('types', 'types1', 'scores', 'type'));
    }
}
