<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        if (!empty($search)) {
            $user = User::where('users.nama', 'like', '%' . $search . '%')
                ->paginate(5)->fragment('user');
        } else {
            $user = User::paginate(5)->fragment('user');
        }
        return view('user.index', compact(['user', 'search']), [
            'page_title' => 'Data user'
        ]);
    }
    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'email' => $request->email,
            'nrp' => $request->nrp,
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
        $user->update($request->except('_token', 'submit'));
        return redirect()->route('user.index')->with('update', 'Berhasil!');
    }
    public function destroy($id_user)
    {
        $user = User::find($id_user);
        $user->delete();
        return redirect()->route('user.index')->with('delete', 'Berhasil!');
    }
}
