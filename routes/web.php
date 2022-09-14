<?php

use App\Http\Livewire\Dashboard;
use App\Http\Livewire\QuestionList;
use App\Http\Livewire\QuizList;
use App\Http\Livewire\SkillAssessments;
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

Route::group([
    'prefix' => 'admin',
    'as' => 'admin.',
    'middleware' => [
        'auth', 'verified'
    ]
], function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('question', QuestionList::class)->name('question');
    Route::get('quiz-list', QuizList::class)->name('quiz');
});


Route::group(['middleware' => ['auth', 'verified']], function () {
    Route::get('dashboard', Dashboard::class)->name('dashboard');
    Route::get('skill-assessments/{slug}', SkillAssessments::class)->name('assessments');
});

require __DIR__ . '/auth.php';
