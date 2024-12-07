<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\AnswerController;


Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect()->route('question.index');
    });

    Route::get('/dashboard', function () {
        return redirect()->route('question.index');
    })->name('dashboard');

    Route::resources([
        'question' => QuestionController::class,
        'answer' => AnswerController::class,
    ]);


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
