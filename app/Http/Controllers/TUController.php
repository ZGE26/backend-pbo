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
    public function update(Request $request, string $id)
    {
        $tu = TU::findOrFail($id);
        $tu->update($request->all());
        return response()->json($tu, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tu = TU::findOrFail($id);
        $tu->delete();
        return response()->json(null, 204);
    }
}
