<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $data = User::findOrFail(auth()->user()->id);

        return view('akun.index', ['data' => $data]);
    }

    public function edit($id)
    {
        $data = User::findOrFail($id);

        return view('akun.edit', ['data' => $data]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'new_password' => 'nullable|string|min:6|same:new_password_confirmation',
            'new_password_confirmation' => 'nullable|string|same:new_password',
        ], [
            'name.required' => 'Nama wajib diisi!',
            'email.required' => 'Email wajib diisi!',
            'email.email' => 'Email harus berformat email!',
            'email.unique' => 'Email sudah terdaftar, silahkan gunakan email lain!',
            'new_password.same' => 'Password harus sama dengan Konfirmasi Password!',
            'new_password.min' => 'Password harus minimal :min karakter!',
            'new_password_confirmation.same' => 'Konfirmasi Password harus sama dengan Password Baru!',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->new_password ? bcrypt($request->new_password) : $user->password,
        ];

        $user->update($data);
        sweetalert()->success('Data akunmu berhasil diupdate!');

        return redirect('/akun');
    }
}
