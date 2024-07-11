<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        $roles = Role::all();
        return view('users.index', compact('users', 'roles'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role_id' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);
        event(new Registered($user));
        return redirect()->route('users')
            ->with('success', 'Data berhasil disimpan.');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required',
            'role_id' => 'required',
        ]);

        $user->name = $request->input('name');
        $user->role_id = $request->input('role_id');
        $user->save();
        return redirect()->route('users')
            ->with('success', 'Data berhasil diubah.');
    }

    public function destroy(Request $request)
    {
        $data = User::find($request->id);
        $data->delete();
        return redirect()->route('users')
            ->with('success', 'Data berhasil dihapus.');
    }
}
