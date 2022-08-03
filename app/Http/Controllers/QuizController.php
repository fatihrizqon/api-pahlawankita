<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $options  = Hero::all()->random(4);
        $question = $options->random(1);
        $data     = [
          'question' => $question,
          'options'  => $options, 
        ];
        
        return response()->json([
            'success' => true,
            'data'    => $data
        ], 200);
    }
}
