<?php

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

// Main Page

Route::get('/', function () {
    return view('welcome');
});

// Button Main Page For Going to // QUESTION:

Route::get('/Hiring', function () {
    return view('Hiring');
});

// NetworkQuestionary

Route::get('/NetworkQuestionary', function () {
    return view('NetworkQuestionary');
});

Route::get('/networkResponse', function () {
    return view('networkResponse');
});


Route::post('/CreateQuiz', ['uses'=> 'QuizController@store','as'=>'quiz.store' ]);
Route::post('/CreateQuestion', ['uses'=> 'QuestionController@store','as'=>'question.store' ]);
Route::post('/AddUserAnswer', ['uses'=> 'UserAnswerController@store','as'=>'useranswer.store' ]);



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/CreateQuiz', 'QuizController@index')->name('CreateQuiz');
Route::get('/{main}/CreateQuestion', 'QuestionController@index')->name('CreateQuestion');
Route::get('/{main}', 'QuizController@startquiz');
