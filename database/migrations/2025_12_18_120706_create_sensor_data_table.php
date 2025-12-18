<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sensor_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alat_id')
                ->constrained('alat_elektromedis')
                ->onDelete('cascade');

            $table->float('nilai_sensor');
            $table->string('satuan', 20);
            $table->dateTime('waktu_kirim');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sensor_data');
    }
};
