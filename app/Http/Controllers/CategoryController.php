<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BasedEngine;

class CategoryController extends Controller
{
    public function show($id)
    {
        $engines = BasedEngine::orderBy('position')->get();
        $activeEngine = BasedEngine::find($id);

        return view('search', [
            'engines' => $engines,
            'activeEngine' => $activeEngine,
        ]);
    }
}
