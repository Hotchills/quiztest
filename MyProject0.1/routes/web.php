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
//extra 
Route::get('/ThisIsJustALink/{question_id}','PlayController@index');
Route::get('/ThisIsJustALinkForResults/{question_id}','PlayController@resultsplay');
Route::post('/SavePlay',['uses' => 'PlayController@saveplay','as'=>'play.save' ]);


Route::post('/AssignedQuiz', ['uses'=> 'AssignedQuizController@store','as'=>'assignedquiz.store' ]);
Route::post('/CreateQuiz', ['uses'=> 'QuizController@store','as'=>'quiz.store' ]);
Route::post('/CreateGuestUser', ['uses'=> 'GuestUserController@store','as'=>'guestuser.store' ]);
Route::post('/AddAnswersToQuestion', ['uses'=> 'AnswerController@store','as'=>'addanswers.store' ]);
Route::post('/CreateQuestion', ['uses'=> 'QuestionController@store','as'=>'question.store' ]);
Route::post('/AddUserAnswer', ['uses'=> 'UserAnswerController@store','as'=>'useranswer.store' ]);
Route::post('/addajaxanswer' , 'UserAnswerController@addajaxanswer');
Route::post('/LoginUser', ['uses'=> 'AssignedQuizController@show','as'=>'loginguestuser.show' ]);
Route::post('/{code}/FinishTest', ['uses'=> 'AssignedQuizController@finishtest','as'=>'finishtest.update' ]);
Route::post('/UpdateTime', 'AssignedQuizController@updatetime');

Auth::routes();


Route::get('/','HomeController@rootpage');
Route::get('/admin','HomeController@adminpage');
Route::get('grade/{code}','QuizController@checkquizresult')->name('Checkquizresult');
Route::get('{question}/AddAnswersToQuestion', 'AnswerController@index')->name('addanswerstoquestion');
Route::get('/edit/{main}','QuizController@geteditquiz');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/LoginUser', 'AssignedQuizController@index')->name('LoginUser');
Route::get('/CreateQuiz', 'QuizController@index')->name('CreateQuiz');
Route::get('/CreateGuestUser', 'GuestUserController@index')->name('CreateGuestUser');
Route::get('/ListUser', 'GuestUserController@showusers')->name('ListGuestUser');
Route::get('/{main}/CreateQuestion', 'QuestionController@index')->name('CreateQuestion');
Route::get('/{code}/FinishTest', 'AssignedQuizController@finishtest');
Route::get('/{main}','QuizController@geteditquiz');
Route::get('/{code}/{main}/StartTestPage','QuizController@starttestpage')->name('StartTestPage');
Route::get('/{code}/{main}','QuizController@startquiz');
Route::get('{question}/AddAnswersToQuestion', 'AnswerController@index')->name('addanswerstoquestion');


//update 
Route::put('/AddCorrectAnswersToQuestion/{id}', 'CorrectAnswersController@store')->name('correctanswer.store');
Route::put('/Useranswer/{id}', 'UserAnswerController@update')->name('useranswer.update');
Route::put('/UpdateQuestion', 'QuestionController@update')->name('question.update');
Route::put('/UpdateAnswer', 'AnswerController@update')->name('answer.update');

//delete
Route::delete('/DelAnswersToQuestion/{id}', 'AnswerController@destroy')->name('delanswer.delete');
Route::delete('/DelCorrectAnswersToQuestion/{id}', 'CorrectAnswersController@destroy')->name('delcorrectanswer.delete');
Route::delete('/delquestion/{id}', 'QuestionController@destroy')->name('delquestion.delete');
Route::delete('/delquiz/{id}', 'QuizController@destroy')->name('delquiz.delete');


