<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AppController, HeroController, QuizController, ResultController};

Route::get('/', [AppController::class, 'index']);

Route::group(['middleware' => 'cors'], function(){
    Route::get('/heroes', [HeroController::class, 'index']);
    Route::get('/heroes/{id}', [HeroController::class, 'show']);
    Route::get('/quiz', [QuizController::class, 'index']);
    Route::get('/result', [ResultController::class, 'index']);
    Route::post('/result', [ResultController::class, 'store']);
});
 
