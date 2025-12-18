<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SensorData;
use Illuminate\Http\Request;

class SensorDataController extends Controller
{
    // READ ALL
    public function index()
    {
        return response()->json([
            'success' => true,
            'data' => SensorData::with('alat')->latest()->get()
        ]);
    }

    // CREATE (DATA IOT)
    public function store(Request $request)
    {
        $request->validate([
            'alat_id' => 'required|exists:alat_elektromedis,id',
            'nilai_sensor' => 'required|numeric',
            'satuan' => 'required'
        ]);

        $sensor = SensorData::create([
            'alat_id' => $request->alat_id,
            'nilai_sensor' => $request->nilai_sensor,
            'satuan' => $request->satuan,
            'waktu_kirim' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data sensor berhasil dikirim',
            'data' => $sensor
        ], 201);
    }

    // READ BY ID
    public function show($id)
    {
        $sensor = SensorData::with('alat')->find($id);

        if (!$sensor) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $sensor
        ]);
    }

    // UPDATE
    public function update(Request $request, $id)
    {
        $sensor = SensorData::find($id);

        if (!$sensor) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $sensor->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $sensor
        ]);
    }

    // DELETE
    public function destroy($id)
    {
        $sensor = SensorData::find($id);

        if (!$sensor) {
            return response()->json([
                'success' => false,
                'message' => 'Data tidak ditemukan'
            ], 404);
        }

        $sensor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
