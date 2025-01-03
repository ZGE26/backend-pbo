<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use Illuminate\Http\Request;

class GuruController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->query('nip')) {
            return response()->json(Guru::where('nip', request()->query('nip'))->first());
        }

        if (request()->query('id_sekolah')) {
            return response()->json(Guru::where('id_sekolah', request()->query('id_sekolah'))->get());
        }

        return Guru::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'id_mapel' => 'required|integer',
            'id_sekolah' => 'required|integer',
            'gender' => 'required|string|max:255',
        ]);

        $guru = Guru::create($request->all());
        return response()->json($guru, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Guru::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $nip)
{
    // Validasi input data

    $validatedData = $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
    ]);
    
    // Cari data Guru berdasarkan NIP
    $guru = Guru::where('nip', $nip)->first();
    
    if (!$guru) {
        return response()->json(['message' => 'Data not found'], 404);
    }

    // Update data berdasarkan field yang telah divalidasi
    $guru->update([
        'nama' => $validatedData['nama'],
        'alamat' => $validatedData['alamat'],
    ]);

    return response()->json([
        'message' => 'Data updated successfully',
        'data' => $guru
    ], 200);
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nip)
    {
        $tu = Guru::find($nip);
        if (!$tu) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        $tu->delete();
        return response()->json(null, 204);
    }


    public function Login(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
        ]);

        $guru = Guru::where('nama', $request->nama)
        ->where('nip', $request->nip)
        ->first();

        if ($guru) {
            return response()->json(['message' => 'Login berhasil', 'data' => $guru], 200);
        } else {
            return response()->json(['message' => 'Nama atau NIP salah'], 401);
        }
    }
}