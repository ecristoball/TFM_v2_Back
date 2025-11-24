<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Funcionalidad1Controller;
use App\Http\Controllers\JsonFuncionalidadesKeyController;

// Todas las rutas de tu API van aquí
Route::get('/funcionalidades1', [Funcionalidad1Controller::class, 'index']);

use App\Http\Controllers\JsonKeyController;

Route::get('/json_funcionalidades_keys', [JsonFuncionalidadesKeyController::class, 'index']);
Route::get('/json_funcionalidades_keys/levelsbyfrontlevel/{frontlevel}', [JsonFuncionalidadesKeyController::class, 'getLevelsByFrontLevel']);
Route::get('/json_funcionalidades_keys/parent/{parent}', [JsonFuncionalidadesKeyController::class, 'getByParent']);
Route::get('/json_funcionalidades_keys/frontlevel/{frontlevel}', [JsonFuncionalidadesKeyController::class, 'getByFrontLevel']);
Route::get('/json_funcionalidades_keys/filter/{frontlevel}/{key_name}', [JsonFuncionalidadesKeyController::class, 'filterByFrontLevelAndKey']);
Route::get('/json_funcionalidades_keys/{frontlevel}/{frontparent}', [JsonFuncionalidadesKeyController::class, 'filterByFrontLevelAndFrontParent']);
Route::put('/json_funcionalidades_keys/update/{keyName}', [JsonFuncionalidadesKeyController::class, 'updateValueByKeyName']);
Route::delete('/json_funcionalidades_keys/values', [JsonFuncionalidadesKeyController::class, 'deleteValues']);
