<?php

 
$router->get('/', 'AppController@index');

$router->group(['prefix' => 'api'], function() use ($router){
    $router->get('/heroes', 'HeroController@index');
    // $router->post('/hero/create', 'HeroController@create'); 
    // $router->get('/hero/view/{id}', 'HeroController@view');
    // $router->put('/hero/update/{id}', 'HeroController@update');
    // $router->delete('/hero/delete/{id}', 'HeroController@delete');

    $router->get('/quiz', 'QuizController@index'); // generate question and answers.
    $router->get('/quiz/results', 'QuizController@results'); // retrieve results
    $router->post('/quiz/save', 'QuizController@save'); // save the result
});