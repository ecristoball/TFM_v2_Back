<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Funcionalidad1Controller;
use App\Http\Controllers\JsonFuncionalidadesKeyController;

// Todas las rutas de  API van aquí
Route::get('/funcionalidades1', [Funcionalidad1Controller::class, 'index']);

use App\Http\Controllers\JsonKeyController;
//Route::método ('/ruta endpoint',[tabla])
Route::get('/json_funcionalidades_keys', [JsonFuncionalidadesKeyController::class, 'index']);
Route::get('/json_funcionalidades_keys/defaultvalue/{keyName}', [JsonFuncionalidadesKeyController::class, 'getDefaultValue']);
Route::get('/json_funcionalidades_keys/imageurl/{keyName}', [JsonFuncionalidadesKeyController::class, 'getImageUrl']);
Route::get('/json_funcionalidades_keys/levelsbyfrontlevel/{frontlevel}', [JsonFuncionalidadesKeyController::class, 'getLevelsByFrontLevel']);
Route::get('/json_funcionalidades_keys/parent/{parent}', [JsonFuncionalidadesKeyController::class, 'getByParent']);
Route::get('/json_funcionalidades_keys/frontlevel/{frontlevel}', [JsonFuncionalidadesKeyController::class, 'getByFrontLevel']);
Route::get('/json_funcionalidades_keys/filter/{frontlevel}/{key_name}', [JsonFuncionalidadesKeyController::class, 'filterByFrontLevelAndKey']);
Route::get('/json_funcionalidades_keys/{frontlevel}/{frontparent}', [JsonFuncionalidadesKeyController::class, 'filterByFrontLevelAndFrontParent']);
Route::put('/json_funcionalidades_keys/update/{keyName}', [JsonFuncionalidadesKeyController::class, 'updateValueByKeyName']);
Route::delete('/json_funcionalidades_keys/deleteall', [JsonFuncionalidadesKeyController::class, 'deleteValues']);
Route::delete('/json_funcionalidades_keys/delete/{keyName}', [JsonFuncionalidadesKeyController::class, 'deleteValue']);
Route::put('/json_funcionalidades_keys/value',  [JsonFuncionalidadesKeyController::class, 'clearValue']);//login 
//Route::get('/json_funcionalidades_keys/defaultvalue/{keyName}', [JsonFuncionalidadesKeyController::class, 'getDefaultValue']);


use App\Http\Controllers\AuthController;

Route::post('/login', [AuthController::class, 'login']);

Route::get('/user/functionalities/{userId}/{parentKey}', [AuthController::class, 'getUserFunctionalities']);

