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
    return view('pages.index');
});

Auth::routes([
    'reset' => false
  ]);


Route::group(['middleware' => 'auth'], function()
{

Route::get('/dashboard', 'DashboardController@index');
Route::resource('/classes', 'ClassesController');
Route::resource('/students', 'StudentsController');

//exams routes
//Route::resource('exams', 'ExamsController');
Route::get('/exams/{id}', 'ExamsController@index')->name('exams.index');
Route::post('/exams/store', 'ExamsController@store')->name('exams.store');
Route::post('/exams/update/{id}', 'ExamsController@update')->name('exams.update');
Route::get('/select_class', function () {
  return view('exams.chooseClass');
});

//results routes
Route::get('/results/{id}', 'ResultsController@index')->name('results.index');
Route::post('/results/store', 'ResultsController@store')->name('results.store');
Route::get('/results/edit/{id}', 'ResultsController@edit')->name('results.edit');
Route::post('/results/update/{id}', 'ResultsController@update')->name('results.update');
Route::delete('/results/destroy/{id}', 'ResultsController@destroy')->name('results.destroy');
    
});