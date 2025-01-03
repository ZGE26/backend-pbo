<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TU;

class TUController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->query('nip')) {
            return response()->json(TU::where('nip', request()->query('nip'))->first());
        }

        if (request()->query('id_sekolah')) {
            return response()->json(TU::where('id_sekolah', request()->query('id_sekolah'))->get());
        }
        return TU::all();
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
            'id_sekolah' => 'required|integer',
            'gender' => 'required|string|max:255',
        ]);
        
        $tu = TU::create($request->all());
        return response()->json($tu, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return TU::findOrFail($id);
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
    
    // Cari data Tata Usaha berdasarkan NIP
    $tu = TU::where('nip', $nip)->first();
    
    if (!$tu) {
        return response()->json(['message' => 'Data not found'], 404);
    }

    // Update data berdasarkan field yang telah divalidasi
    $tu->update([
        'nama' => $validatedData['nama'],
        'alamat' => $validatedData['alamat'],
    ]);

    return response()->json([
        'message' => 'Data updated successfully',
        'data' => $tu
    ], 200);
}


    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nip)
    {
        $tu = TU::find($nip);
        if (!$tu) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        $tu->delete();
        return response()->json(null, 204);
    }

}