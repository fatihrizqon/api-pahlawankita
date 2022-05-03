<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use App\Models\Result;
use Illuminate\Http\Request;
use Validator;

class QuizController extends Controller
{
    public function index()
    {
        $answer  = Hero::all()->random(1);
        $options = Hero::all()->random(3);
        $options = $options->merge($answer)->sort()->values()->all();
        if($options){
            return response()->json([
                'success' => true,
                'answer'  => $answer,
                'options' => $options
            ], 200);
        }
        return response()->json([
            'success' => false,
            'message' => 'Failed to get the question.'
        ], 400);
    }

    public function results()
    {
        $results = Result::where('score', '>=', 0)->orderBy('score', 'desc')->take(50)->get();

        if($results){
          return response()->json([
              'success' => true,
              'message' => 'Quiz results has been loaded.',
              'data'    => $results,
          ], 200);
        }else{ 
          return response()->json([
              'success' => true,
              'message' => 'Unable to load the results.'
          ], 200);
        }
    }
   
    public function save(Request $request)
    { 
        // dd($request);
        $validator = Validator::make($request->all(),[
            'username'  => ['required','string'],
            'score'     => ['required','string'] 
        ]);
      
        if($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json([
                'success'   => false,
                'message'   => $error
            ], 403);
        } 

        try {
            $username = $request->username;
            $score    = $request->score;

            $check_username = Result::where('username',$username)->first();
            if($check_username){
                $random   = rand(0, 9);
                $username = $username.$random;
                $result = new Result;
                $result->username = $username;
                $result->score = $score;
                if($result->save()){
                    return response()->json([
                        'success' => true,
                        'message' => $username." your score is ".$score." and has been saved.",
                        'data'    => $result
                    ], 200);
                }
                return response()->json([
                    'success' => false,
                    'message' => "Failed to save the result."
                ], 400);

              }else{
                $result = new Result;
                $result->username = $username;
                $result->score = $score;
                if($result->save()){
                    return response()->json([
                        'success' => true,
                        'message' => $username." your score is ".$score." and has been saved.",
                        'data'    => $result
                    ], 200);
                }
                return response()->json([
                    'success' => false,
                    'message' => "Failed to save the result."
                ], 400);
              }
        } catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 403);
        }
    }
}
