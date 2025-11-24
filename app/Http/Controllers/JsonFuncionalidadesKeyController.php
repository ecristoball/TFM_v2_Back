<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JsonFuncionalidadesKey;
use Illuminate\Support\Facades\DB;

class JsonFuncionalidadesKeyController extends Controller
{
    //
    public function index()
    {
        return response()->json(JsonFuncionalidadesKey::all());
    }

    // (Opcional) Obtener las claves hijas de una clave concreta
    public function getByParent($parent)
    {
        return response()->json(JsonFuncionalidadesKey::where('parent_key', $parent)->get());
    }

    //devuelve por nivel de front
    public function getByFrontLevel($frontlevel)
    {
        $keys = \App\Models\JsonFuncionalidadesKey::where('frontlevel', $frontlevel)->get();
        return response()->json($keys);
    }


    public function filterByFrontLevelAndKey($frontlevel, $key_name)
    {
        $items = DB::table('json_funcionalidades_keys')
            ->where('frontlevel', $frontlevel)
            ->where('key_name', $key_name)
            ->get();

        return response()->json($items);
    }

    public function filterByFrontLevelAndFrontParent($frontlevel, $frontparent)
    {
        $items = DB::table('json_funcionalidades_keys')
            ->where('frontlevel', $frontlevel)
            ->where('frontparent', $frontparent)
            ->get();

        return response()->json($items);
    }
    //para generar el json, extrae todos los niveles, incluyendo los no vacios o los required
    public function getLevelsByFrontLevel($frontlevel)
    {
        $items = DB::table('json_funcionalidades_keys')
            ->select('level1','level2','level3','level4','level5','level6','level7','level8','value','required','key_name')
            ->where('frontlevel', $frontlevel)
            ->whereNotNull('value')        // 🔹 descarta valores NULL
            ->where('value', '<>', '')    // 🔹 descarta strings vacíos
            ->orwhere('required',true)
            ->get();

    
        return response()->json($items);
    }
 
   
public function updateValueByKeyName(Request $request, $keyName)
{
    // Validar que venga el valor en la petición
    $request->validate([
        'value' => 'required'
    ]);
    $value = $request->value;
    // Si el valor viene como array con una sola clave (por ej. {"active":true}),
    // extraemos solo el valor interno (true)
    if (is_array($value) && count($value) === 1) {
        $value = array_values($value)[0];
    }

    // Actualizar la fila con el valor en formato JSON correcto
    $updated = DB::table('json_funcionalidades_keys')
        ->where('key_name', $keyName)
        ->update([
            'value' => json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES),
            'updated_at' => now()
        ]);

        if ($updated) {
            return response()->json(['message' => 'Valor actualizado correctamente']);
        } else {
            return response()->json(['message' => 'No se encontró la fila'], 404);
        }
}





    public function deleteValues(){
        $updated = DB::table('json_funcionalidades_keys')
         ->update([
            'value' => NULL,
            'updated_at' => now()
        ]);
    }


public function oldupdateValueByKeyName(Request $request, $keyName)
{
    $request->validate([
        'value' => 'required'
    ]);

    $value = $request->value;

    // Guardamos el valor como JSON correcto dependiendo del tipo
    // Strings, números, booleanos se serializan correctamente
    $jsonValue = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

    $updated = DB::table('json_funcionalidades_keys')
        ->where('key_name', $keyName)
        ->update([
            'value' => $jsonValue,
            'updated_at' => now()
        ]);

    if ($updated) {
        return response()->json(['message' => 'Valor actualizado correctamente']);
    } else {
        return response()->json(['message' => 'No se encontró la fila'], 404);
    }
}

}


