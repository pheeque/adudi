<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\MascotResource;
use App\Mascot;
use Illuminate\Http\Request;

class MascotController extends Controller
{
    public function show($id)
    {
        return new MascotResource(Mascot::findOrFail($id));
    }

    public function update(Request $request, $id)
    {
        $mascot = Mascot::findOrFail($id);
        $mascot->update(request()->all());
        return new MascotResource($mascot);
    }
}
