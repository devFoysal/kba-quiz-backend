<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => ['api'],
], function () {
    Route::prefix('participant')->group(function () {
        Route::post('create/', 'API\Participant\ParticipantController@createParticipant');
        Route::post('login', 'API\Participant\AuthController@login');
    });
});
    
Route::group([
    'middleware' => ['api', 'jwt.verify'],
], function () {

    Route::prefix('quiz')->group(function () {
        Route::get('all', 'API\Quiz\QuizController@getQuizzes');
    });

    Route::prefix('participant')->group(function () {
        Route::get('all', 'API\Participant\ParticipantController@getParticipants');
        Route::get('/{participantId}', 'API\Participant\ParticipantController@getParticipant')->where('participantId', '[0-9]+');
    });
    
    Route::prefix('participant')->group(function () {
        Route::get('logout', 'API\Participant\AuthController@logout');
    });

    Route::prefix('participate')->group(function () {
        Route::post('create', 'API\Participate\ParticipateController@create');
    });
});

