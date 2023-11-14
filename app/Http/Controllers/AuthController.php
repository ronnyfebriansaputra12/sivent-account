<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function loginAdmin(Request $request)
    {
        $admin = Admin::where('email', $request->email)->first();

        if ($admin) {
            $data = [
                'id' => $admin->id,
                'nama' => $admin->nama,
                'email' => $admin->email,
                'password' => $admin->password,
                'contact' => $admin->contact,
                'role_id' => $admin->role_id
            ];

            if (Hash::check($request->input('password'), $admin->password)) {
                $token = $this->generateToken($data);

                return response()->json([
                    'message' => 'login success',
                    'success' => true,
                    'data' => $data,
                    'token' => $token
                ], 200);
            }

            return response()->json([
                'message' => 'Password doesnt match',
                'success' => false
            ], 400);
        }
        return response()->json([
            'message' => 'Email doesnt exist',
            'success' => false
        ], 400);
    }
}
