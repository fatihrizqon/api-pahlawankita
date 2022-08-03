<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        $results = Result::orderBy('score','desc')->get()->take(25);
        return response()->json([
            'success' => true,
            'data'    => $results
        ], 200);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'username' => ['required', 'max:50'],
            'score'    => ['required']
        ]);

        $user = Result::where('username', $attributes['username'])->first();
        if($user){
            $attributes['username'] = $user->username.rand(0, 99);
        }

        try{
            $result = Result::create($attributes);
            if($result){
                return response()->json([
                    'success' => true,
                    'data'    => $result,
                    'message' => 'Your score has been saved in our records.'
                ], 200);
            }else{
                return response()->json([
                    'success' => false,
                    'data'    => $result,
                    'message' => 'An error has been occured, failed to save your score.'
                ], 400);
            }
        }catch(\Exception $e){
            return response()->json(['success' => false, 'message' => $e], 403);
        }
    }
}
