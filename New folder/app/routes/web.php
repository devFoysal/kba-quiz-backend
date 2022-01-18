<?php

// Backend

// Route::group(['middleware' => 'checkuserempty'], function(){

use Illuminate\Support\Facades\Auth;

Route::get('/', 'AuthController@login');
    
    Route::post('/check', 'AuthController@checkValidUser');
// });

Auth::routes();

Route::group(['prefix' => 'management', 'middleware' => 'isauthuser'], function(){
    Route::get('dashboard', 'Backend\DashboardController@index');

    Route::prefix('quiz')->group(function () {
        Route::get('list', 'Backend\QuizController@index')->name('quiz.list');
        Route::get('add', 'Backend\QuizController@postForm');
        Route::post('add', 'Backend\QuizController@add');
        Route::get('{id}/edit', 'Backend\QuizController@edit');
        Route::post('update', 'Backend\QuizController@update');
        Route::get('delete/{id}', 'Backend\QuizController@delete');
    });

    Route::prefix('question')->group(function () {
        Route::get('list', 'Backend\QuestionController@index');
        Route::get('add', 'Backend\QuestionController@postForm');
        Route::post('add', 'Backend\QuestionController@add');
        Route::get('{id}/edit', 'Backend\QuestionController@edit');
        Route::post('update', 'Backend\QuestionController@update');
        Route::get('delete/{id}', 'Backend\QuestionController@delete');
        Route::get('answer/delete/{id}', 'Backend\QuestionController@answerDelete');
    });
   
    Route::get('logout', 'AuthController@logout');
  

});