<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Personaje;
//use App\Traits\StorePersonajeTrait;
class personajeController extends Controller
{
    public function StorePersonaje(Request $request)
    {
    $personaje = new Personaje();
    $personaje->name = $request->input('name');
    $personaje->save();
    
    return response()->json($personaje, 201);
    }

    public function getAllPersonajes(){
        $personajes = Personaje::all();

        return response()->json($personajes);
    }
}
