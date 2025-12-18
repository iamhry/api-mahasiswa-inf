<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorData extends Model
{
    protected $fillable = [
        'alat_id','nilai_sensor','satuan','waktu_kirim'
    ];

    public function alat()
    {
        return $this->belongsTo(AlatElektromedis::class, 'alat_id');
    }
}
