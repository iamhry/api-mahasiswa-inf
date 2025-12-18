<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlatElektromedis extends Model
{
    protected $fillable = [
        'kode_alat','nama_alat','jenis_alat','lokasi','status'
    ];

    public function sensorData()
    {
        return $this->hasMany(SensorData::class, 'alat_id');
    }
}

