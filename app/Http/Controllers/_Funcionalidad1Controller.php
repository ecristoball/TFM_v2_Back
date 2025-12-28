<?php

namespace App\Http\Controllers;

use App\Models\Funcionalidad1;  //  Importa el modelo
use Illuminate\Http\Request;

class Funcionalidad1Controller extends Controller
{
    /**
     * Muestra todas las funcionalidades
     */
    public function index()
    {
        // Devuelve todos los registros de la tabla funcionalidades1 como JSON
        return response()->json(Funcionalidad1::all());
    }
}
