<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\QuestionList;
use App\Http\Livewire\QuizCreate;
use App\Http\Livewire\QuizList;
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

Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('question', QuestionList::class)->name('question');
    Route::get('quiz', QuizList::class)->name('quiz');
});

require __DIR__ . '/auth.php';
