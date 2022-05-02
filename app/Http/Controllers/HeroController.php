<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class HeroController extends Controller
{
    public function index()
    {
        $heroes = Hero::get();
        if($heroes){
            return response()->json([
                'success' => true,
                'message' => 'All Heroes has been loaded.',
                'data'    => $heroes
            ], 200);
        } 
        return response()->json([
            'success' => false,
            'message' => 'Unable to load the data.'
        ], 404);
    }

    public function create(Request $request)
    {
        try{
            $hero = new Hero();
            $hero->name          = $request->name;
            $hero->origin        = $request->origin;
            $hero->date_of_birth = $request->date_of_birth;
            $hero->date_of_death = $request->date_of_death;
            $hero->description   = $request->description;
            if($hero->save()){
                return response()->json([
                    'success' => true,
                    'message' => 'New Hero has been added.',
                    'data'    => $hero
                ], 200);
            }
        } catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 403);
        }
    }
    
    public function view($id)
    {
        $hero = Hero::find($id);
        if($hero){
            return response()->json([
                'success' => true,
                'message' => 'Selected Hero has been loaded.',
                'data'    => $hero
            ], 200);
        } 

        return response()->json([
            'success' => false,
            'data'    => ''
        ], 404);

    }
    
    public function update(Request $request, $id)
    {
        $hero = Hero::find($id);
        if(!$hero){
            return response()->json([
                'success' => false,
                'message' => 'Hero not found.'
            ], 403);
        }

        try{
            $hero->name          = $request->name;
            $hero->origin        = $request->origin;
            $hero->date_of_birth = $request->date_of_birth;
            $hero->date_of_death = $request->date_of_death;
            $hero->description   = $request->description;
            if($hero->save()){
                return response()->json([
                    'success' => true,
                    'message' => 'Selected Hero has been updated.',
                    'data'    => $hero
                ], 200);
            }
        } catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 403);
        }

    }

    public function delete($id)
    {
        try{
            $hero = Hero::find($id);
            if($hero->delete()){
                return response()->json([
                    'success' => true,
                    'message' => "Selected data has been deleted."
                ], 200);
            }
        } catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => $e
            ], 403);
        }
    }
}
