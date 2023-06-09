<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Unique;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (!empty($search)) {
            $user = User::where('users.nama', 'like', '%' . $search . '%')
                ->latest()->paginate(10)->fragment('user');
        } else {
            $user = User::latest()->paginate(10)->fragment('user');
        }
        return view('user.index', compact(['user', 'search']), [
            'page_title' => 'Data user'
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users'
        ]);

        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'nrp' => $request->nrp,
            'pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ];

        User::create($data);
        return redirect()->route('user.index')->with('success', 'Berhasil!');
    }
    public function update($id_user, Request $request)
    {
        $user = User::find($id_user);
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'nrp' => $request->nrp,
            'pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ];
        $user->update($data);
        return redirect()->route('user.index')->with('update', 'Berhasil!');
    }
    public function destroy($id_user)
    {
        $user = User::find($id_user);
        $user->delete();
        return redirect()->route('user.index')->with('delete', 'Berhasil!');
    }
    public function profil()
    {
        $userId = Auth::id();
        $user = User::find($userId);
        return view(
            'user.profil',
            compact(['user']),
            [
                'page_title' => 'Profil'
            ]
        );
    }
    public function updateprofil($id_user, Request $request)
    {
        $user = User::find($id_user);
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'nrp' => $request->nrp,
            'pangkat' => $request->pangkat,
            'jabatan' => $request->jabatan,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ];
        $user->update($data);
        return back()->with('update', 'Berhasil!');
    }
}
