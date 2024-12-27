<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nilai;
use App\Models\Mapel;

class NilaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */

     // Model Nilai
public function mapel()
{
    return $this->belongsTo(Mapel::class, 'id_mapel');
}


    public function index()
{

    if (request()->query('average')) {
        // Hitung jumlah mapel dari controller lain (atau model terkait)
        $totalMapel = Mapel::count();
    
        // Ambil data nilai dan hitung rata-rata
        $nilai = Nilai::select('id_member')
            ->selectRaw("SUM(nilai) / {$totalMapel} as rata_rata") // Total nilai dibagi jumlah mapel
            ->groupBy('id_member')
            ->orderByDesc('rata_rata')
            ->get();
    
        // Menambahkan ranking berdasarkan urutan rata-rata
        $nilai->transform(function ($item, $index) {
            $item->ranking = $index + 1;
            return $item;
        });
    
        return response()->json($nilai);
    }
    

    // Jika kedua parameter id_member dan id_mapel diberikan
    if (request()->query('id_member') && request()->query('id_mapel')) {
        return response()->json(
            Nilai::where('id_member', request()->query('id_member'))
                ->where('id_mapel', request()->query('id_mapel'))
                ->first()
        );
    }

    // Jika hanya id_mapel yang diberikan
    if (request()->query('id_mapel')) {
        return response()->json(
            Nilai::where('id_mapel', request()->query('id_mapel'))->get()
        );
    }

    // Jika hanya id_member yang diberikan
    if (request()->query('id_member')) {
        return response()->json(
            Nilai::where('id_member', request()->query('id_member'))->get()
        );
    }

    // Jika tidak ada parameter yang diberikan, tampilkan semua nilai
    return Nilai::all();
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
            'id_member' => 'required|string|max:255',
            'id_mapel' => 'required|integer',
            'nilai' => 'required|numeric',
        ]);

        $nilai = Nilai::create($request->all());
        return response()->json($nilai, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Nilai::findOrFail($id);
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
    public function update(Request $request, $id_member, $id_mapel)
    {
        // Validasi input
        $validatedData = $request->validate([
            'nilai' => ["required", "integer"],
        ]);
    
        // Cari data berdasarkan id_mapel dan id_member
        $nilai = Nilai::where('id_mapel', $id_mapel)
                      ->where('id_member', $id_member)
                      ->first();
    
        // Jika data tidak ditemukan
        if (!$nilai) {
            return response()->json(['message' => 'Data not found'], 404);
        }
    
        // Update data
        $nilai->update($validatedData);
    
        return response()->json([
            'message' => 'Data updated successfully',
            'data' => $nilai
        ], 200);
    }
    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id_member)
    {
        $nilai = Nilai::where('id_member', $id_member)->first();
        if (!$nilai) {
            return response()->json(['message' => 'Data not found'], 404);
        }
        $nilai->delete();
        return response()->json(['message' => 'Data deleted successfully'], 200);
    }
}