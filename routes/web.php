<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/faq', [App\Http\Controllers\FAQController::class, 'show'])->name('faq');
Route::get('/statistiky', [App\Http\Controllers\StatistikyController::class, 'show'])->name('statistiky');
Route::group(['middleware' => ['auth']], function () {
    Route::resource('uzivatelia', \App\Http\Controllers\UzivateliaController::class);
    Route::get('uzivatelia/{uzivatel}/delete', ['as' => 'uzivatelia.delete', 'uses'=> '\App\Http\Controllers\UzivateliaController@destroy']);

    Route::get('/simulator', [App\Http\Controllers\SimulatorController::class, 'show'])->name('simulator');
    Route::post('/simulator', [App\Http\Controllers\SimulatorController::class, 'pridaj']);
    Route::get('/simulator/refresh', [App\Http\Controllers\SimulatorController::class, 'refresh']);
    Route::post('/simulator/uprav', [App\Http\Controllers\SimulatorController::class, 'uprav']);
    Route::post('/simulator/odstran', [App\Http\Controllers\SimulatorController::class, 'odstran']);

    Route::get('/quiz', [App\Http\Controllers\QuizController::class, 'show'])->name('quiz');
    Route::post('/quiz/vyhodnot', [App\Http\Controllers\QuizController::class, 'vyhodnot']);
    Route::get('/quiz/otazky', [App\Http\Controllers\QuizController::class, 'otazky'])->name('quiz.otazky');
    Route::post('/quiz/otazky/pridat', [App\Http\Controllers\QuizController::class, 'pridat'])->name('quiz.pridat');
    Route::post('/quiz/otazky/odstranit', [App\Http\Controllers\QuizController::class, 'odstranit'])->name('quiz.odstranit');

    Route::get('/rebricek', [App\Http\Controllers\RebricekController::class, 'show'])->name('quiz.rebricek');
});

