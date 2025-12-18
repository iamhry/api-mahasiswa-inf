<?php


use App\Http\Controllers\Api\MahasiswaController;
use App\Http\Controllers\Api\AlatElektromedisController;
use App\Http\Controllers\Api\SensorDataController;

Route::apiResource('alat', AlatElektromedisController::class);
Route::apiResource('sensor', SensorDataController::class);
Route::apiResource('mahasiswa', MahasiswaController::class);
