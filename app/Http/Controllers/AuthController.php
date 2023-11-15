<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Penyelenggara;
use App\Models\Pengunjung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    function login(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        if ($admin && Hash::check($request->input('password'), $admin->password)) {
            $data = [
                'id' => $admin->id,
                'nama' => $admin->nama,
                'email' => $admin->email,
                'contact' => $admin->contact,
                'role_id' => $admin->role_id
            ];

            $token = $this->generateToken($data);

            return response()->json([
                'message' => 'Login success',
                'success' => true,
                'data' => $data,
                'token' => $token
            ], 200);
        }

        $penyelenggara = Penyelenggara::where('email', $request->email)->first();

        if ($penyelenggara && Hash::check($request->input('password'), $penyelenggara->password)) {
            $data = [
                'id' => $penyelenggara->id,
                'nama_penyelenggara' => $penyelenggara->nama_penyelenggara,
                'email' => $penyelenggara->email,
                'contact_penyelenggara' => $penyelenggara->contact_penyelenggara,
                'role_id' => $penyelenggara->role_id

            ];

            $token = $this->generateToken($data);

            return response()->json([
                'message' => 'Login success',
                'success' => true,
                'data' => $data,
                'token' => $token
            ], 200);
        }

        $pengunjung = Pengunjung::where('email', $request->email)->first();

        if ($pengunjung && Hash::check($request->input('password'), $pengunjung->password)) {
            $data = [
                'id' => $pengunjung->id,
                'nama_pengunjung' => $pengunjung->nama_pengunjung,
                'email' => $pengunjung->email,
                'contact_pengunjung' => $pengunjung->contact_pengunjung,
                'role_id' => $pengunjung->role_id
            ];

            $token = $this->generateToken($data);

            return response()->json([
                'message' => 'Login success',
                'success' => true,
                'data' => $data,
                'token' => $token
            ], 200);
        }

        return response()->json([
            'message' => 'Invalid credentials',
            'success' => false
        ], 400);
    }


    function registerPengunjung(Request $request)
    {
        $data = $request->all();
        $validate = Validator::make($data, [
            'nama_pengunjung' => 'required',
            'email' => 'required|email',
            'username_pengunjung' => 'required',
            'password' => 'required',
            'contact_pengunjung' => 'required'
        ]);

        if ($validate->fails()) {
            return $this->status($validate->getMessageBag()->first(), false);
        }

        $data['password'] = Hash::make($request->password);
        $data['role_id'] = 3;
        $create = Pengunjung::create($data);
        if ($create) {
            return $this->status('Register Success', true, $data);
        }
        return $this->status('Register Failed', false);
    }
}
