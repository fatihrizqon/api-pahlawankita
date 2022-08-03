<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index()
    {
        return response()->json([
            'success' => true,
            'data'    => Hero::get()
        ], 200);
    }

    public function show($id)
    {
        return response()->json([
            'success' => true,
            'data'    => Hero::find($id)
        ], 200);
    }
}
