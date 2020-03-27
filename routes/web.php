<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->group(['prefix'=>'api/v1'], function() use($router){
    Route::group(['prefix' => 'category'], function () use($router) {
        Route::get('/{id}', 'CategoriesController@show');
        Route::post('/', 'CategoriesController@store');        
        Route::put('/{id}', 'CategoriesController@update');
    });
    
    Route::group(['prefix' => 'tag'], function () use($router) {
        Route::get('/{id}', 'TagsController@show');
        Route::post('/', 'TagsController@store');        
        Route::put('/{id}', 'TagsController@update');
    });
    
    Route::group(['prefix' => 'distro'], function () use($router) {
        Route::get('/', 'DistrosController@index');
        Route::get('/{id}', 'DistrosController@show');
        Route::post('/', 'DistrosController@store');        
        Route::delete('/{id}', 'DistrosController@destroy');
        Route::put('/{id}', 'DistrosController@update');
    });

    Route::group(['prefix' => 'image'], function () use($router) {
        Route::get('/', 'ImagesController@index');
        Route::get('/{id}', 'ImagesController@show');
        Route::post('/', 'ImagesController@store');        
        Route::delete('/{id}', 'ImagesController@destroy');
        Route::put('/{id}', 'ImagesController@update');
    });

});
