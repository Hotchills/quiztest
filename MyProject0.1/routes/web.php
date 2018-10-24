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

Route::get('/admin', function () {
    return view('admin');
});

Route::post('/CreateQuiz', ['uses'=> 'QuizController@store','as'=>'quiz.store' ]);
Route::post('/AddAnswersToQuestion', ['uses'=> 'AnswerController@store','as'=>'addanswers.store' ]);
Route::post('/CreateQuestion', ['uses'=> 'QuestionController@store','as'=>'question.store' ]);
Route::post('/AddUserAnswer', ['uses'=> 'UserAnswerController@store','as'=>'useranswer.store' ]);
//Route::post('/AddAnswer', ['uses'=> 'AnswerController@store','as'=>'answer.store' ]);
Route::post('/addajaxanswer' , 'UseranswerController@addajaxanswer');


Auth::routes();


Route::get('{question}/AddAnswersToQuestion', 'AnswerController@index')->name('addanswerstoquestion');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/CreateQuiz', 'QuizController@index')->name('CreateQuiz');
Route::get('/{main}/CreateQuestion', 'QuestionController@index')->name('CreateQuestion');
Route::get('/{main}','QuizController@startquiz');
Route::get('/{main}/{user}','QuizController@Checkquizresult')->name('Checkquizresult');


Route::get('{question}/AddAnswersToQuestion', 'AnswerController@index')->name('addanswerstoquestion');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/CreateQuiz', 'QuizController@index')->name('CreateQuiz');
Route::get('/{main}/CreateQuestion', 'QuestionController@index')->name('CreateQuestion');
Route::get('/{main}','QuizController@startquiz');


Route::put('/AddCorrectAnswersToQuestion/{id}', 'QuestionController@update')->name('correctanswer.update');
Route::put('/Useranswer/{id}', 'UserAnswerController@update')->name('useranswer.update');

Route::delete('/AddAnswersToQuestion/{id}', 'AnswerController@destroy')->name('delanswer.delete');