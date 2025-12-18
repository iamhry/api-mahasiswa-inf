<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AlatElektromedis;
use Illuminate\Http\Request;

class AlatElektromedisController extends Controller
{
    // READ ALL
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => AlatElektromedis::all()
        ]);
    }

    // CREATE
    public function store(Request $request)
    {
        $request->validate([
            'kode_alat' => 'required|unique:alat_elektromedis',
            'nama_alat' => 'required',
            'jenis_alat' => 'required',
            'lokasi' => 'required',
            'status' => 'required|in:aktif,nonaktif'
        ]);

        $alat = AlatElektromedis::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Alat berhasil ditambahkan',
            'data' => $alat
        ], 201);
    }

    // READ BY ID + RELASI
    public function show($id)
    {
        $alat = AlatElektromedis::with('sensorData')->find($id);

        if (!$alat) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $alat
        ]);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $alat = AlatElektromedis::find($id);

        if (!$alat) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $alat->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $alat
        ]);
    }

    // DELETE
    public function destroy($id)
    {
        $alat = AlatElektromedis::find($id);

        if (!$alat) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $alat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
