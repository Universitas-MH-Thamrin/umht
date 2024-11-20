<?php

namespace App\Http\Controllers;

use App\DataTables\PpkDataTable;
use App\DataTables\UserDataTable;
use App\Helpers\MyHelper;
use App\Models\Bidang;
use App\Models\TenagaAhli;
use App\Models\User;
use App\Models\UserBank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable)
    {
        if (Auth::user()->role != 'admin') {
            return abort(403, "Akses Dilarang");
        }
        return $dataTable->render('user.index', [
            'title' => 'List User',
            'datatable' => true
        ]);
    }

    public function create()
    {
        if (Auth::user()->role != 'admin') {
            return abort(403, "Akses Dilarang");
        }
        $data = [
            'title' => 'Tambah User',
            'bidangs' => MyHelper::getBidang()
        ];
        return view('user.create', $data);
    }

    public function store(Request $request)
    {
        if (Auth::user()->role != 'admin') {
            return abort(403, "Akses Dilarang");
        }
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'unique:users,email'],
            'password' => ['required'],
            'role' => ['required']
        ]);

        try {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = $request->role;

            $user->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal membuat user: ' . $e->getMessage());
        }

        return redirect()->route('dashboard.user.index')->with('success', 'Berhasil membuat user.');
    }

    public function edit($id)
    {
        if (Auth::user()->role != 'admin') {
            return abort(403, "Akses Dilarang");
        }
        $user = User::findOrFail($id);

        $data = [
            'data' => $user,
            'title' => 'Edit User',
            'bidangs' => MyHelper::getBidang()
        ];

        return view('user.edit', $data);
    }

    public function update(Request $request, $id)
    {
        if (Auth::user()->role != 'admin') {
            return abort(403, "Akses Dilarang");
        }
        $user = User::findOrFail($id);
        $request->validate([
            'name' => ['required'],
            'email' => ['nullable', 'unique:users,email,' . $id],
            'password' => ['nullable'],
        ]);

        try {
            $user->name = $request->name;
            $user->email = $request->email;
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }
            $user->role = $request->role;
            $user->save();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal mengupdate user: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil mengupdate user.');
    }

    public function destroy($id)
    {
        if (Auth::user()->role != 'admin') {
            return abort(403, "Akses Dilarang");
        }
        $user = User::findOrFail($id);
        try {
            $user->delete();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Berhasil menghapus data user.');
    }

    public function profile()
    {
        $user = Auth::user();
        $data = [
            'title' => 'Profile Anda',
            'data' => $user,
        ];

        return view('user.profile', $data);
    }

    public function profile_update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $request->validate([
            'name' => ['required'],
            'email' => ['nullable', 'unique:users,email,' . $user->id],
            'password' => ['nullable'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        return redirect()->back()->with('success', 'Berhasil mengupdate profile');
    }
}
