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


Route::post('/AssignedQuiz', ['uses'=> 'AssignedQuizController@store','as'=>'assignedquiz.store' ]);


Route::post('/CreateQuiz', ['uses'=> 'QuizController@store','as'=>'quiz.store' ]);
Route::post('/CreateGuestUser', ['uses'=> 'GuestUserController@store','as'=>'guestuser.store' ]);
Route::post('/AddAnswersToQuestion', ['uses'=> 'AnswerController@store','as'=>'addanswers.store' ]);
Route::post('/CreateQuestion', ['uses'=> 'QuestionController@store','as'=>'question.store' ]);
Route::post('/AddUserAnswer', ['uses'=> 'UserAnswerController@store','as'=>'useranswer.store' ]);
//Route::post('/AddAnswer', ['uses'=> 'AnswerController@store','as'=>'answer.store' ]);
Route::post('/addajaxanswer' , 'UserAnswerController@addajaxanswer');
Route::post('/LoginUser', ['uses'=> 'AssignedQuizController@show','as'=>'loginguestuser.show' ]);

Auth::routes();


Route::get('{question}/AddAnswersToQuestion', 'AnswerController@index')->name('addanswerstoquestion');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/LoginUser', 'AssignedQuizController@index')->name('LoginUser');
Route::get('/CreateQuiz', 'QuizController@index')->name('CreateQuiz');
Route::get('/CreateGuestUser', 'GuestUserController@index')->name('CreateGuestUser');
Route::get('/ListUser', 'GuestUserController@showusers')->name('ListGuestUser');
Route::get('/{main}/CreateQuestion', 'QuestionController@index')->name('CreateQuestion');
Route::get('/{main}','QuizController@startquiz');
Route::get('/edit/{main}','QuizController@geteditquiz');
Route::get('/{main}/{user}','QuizController@Checkquizresult')->name('Checkquizresult');


Route::get('{question}/AddAnswersToQuestion', 'AnswerController@index')->name('addanswerstoquestion');

Route::put('/AddCorrectAnswersToQuestion/{id}', 'QuestionController@update')->name('correctanswer.update');
Route::put('/Useranswer/{id}', 'UserAnswerController@update')->name('useranswer.update');

Route::delete('/AddAnswersToQuestion/{id}', 'AnswerController@destroy')->name('delanswer.delete');
Route::delete('/delquestion/{id}', 'QuestionController@destroy')->name('delquestion.delete');
Route::delete('/delquiz/{id}', 'QuizController@destroy')->name('delquiz.delete');
