<?php

namespace App\Traits;

use App\Models\Personaje;

trait StorePersonajeTrait
{
    public function StorePersonajeLogic($request)
    {
        $personaje = new Personaje();
        $personaje->name = $request->input('name');
        $personaje->save();
        return $personaje;
    }
}