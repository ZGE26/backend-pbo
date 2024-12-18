<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guru;
use App\Models\Siswa;
use App\Models\TU;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'password' => 'required|string',
        ]);

        $nama = $request->input('nama');
        $password = $request->input('password'); // Bisa NISN atau NIP

        // Cek di tabel Siswa
        $siswa = Siswa::where('nama', $nama)->where('nisn', $password)->first();
        if ($siswa) {
            return response()->json([
                'message' => 'Login berhasil',
                'role' => 'Siswa',
                'data' => $siswa
            ], 200);
        }

        // Cek di tabel Guru
        $guru = Guru::where('nama', $nama)->where('nip', $password)->first();
        if ($guru) {
            return response()->json([
                'message' => 'Login berhasil',
                'role' => 'Guru',
                'data' => $guru
            ], 200);
        }

        // Cek di tabel TU
        $tu = TU::where('nama', $nama)->where('nip', $password)->first();
        if ($tu) {
            return response()->json([
                'message' => 'Login berhasil',
                'role' => 'TU',
                'data' => $tu
            ], 200);
        }

        // Jika tidak ditemukan
        return response()->json([
            'message' => 'Login gagal, nama atau password salah'
        ], 401);
    }

    public function logout(Request $request)
    {
        return response()->json([
            'message' => 'Logout berhasil'
        ], 200);
    }
}