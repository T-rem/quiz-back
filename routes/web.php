<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api'], function () {
    Route::group(['prefix' => 'v1'], function () {
        Route::post('auth', 'AuthController@auth');

        //Старт квиза для ученика
        Route::get('start/{id}', 'QuizController@startQuiz');

        //Завершение квиза от ученика
        Route::post('finish', 'QuizController@finishQuiz');

        //Получение одного квиза с описанием
        Route::get('getQuiz', 'QuizController@getQuiz');

        //Получение одного квиза с описанием
        Route::get('get/{id}/quiz', 'QuizController@getQuizById');

        //Получение списка квизов
        Route::get('getQuizList', 'QuizController@getQuizList');

        //Получение списка открытых квизов квизов
        Route::get('get/active', 'QuizController@getActiveQuizList');


        //Создание квиза ++++++++++++++++++++++++
        Route::post('postQuiz', 'QuizController@postQuiz');

        //Закрытие квиза от преподавателя
        Route::post('close','QuizController@closeQuiz');


        //Получение ответов группы
        Route::get('getAnswers','QuizController@getAnswers');

        //Старт квиза от преподавателя с ответами
        Route::get('answers', 'QuizController@answers');
        //Ответ на 1 вопрос от ученика
        Route::post('answer', 'QuizController@answerQuiz');
    });
});

