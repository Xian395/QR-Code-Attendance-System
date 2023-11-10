<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\GoogleController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/googleAutocomplete', [GoogleController::class, 'index'])->name('googleAutocomplete');;

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name ('home');

    Route::group(['prefix' => 'student'], function() {
        Route::get('/list', [StudentController::class, 'studentlist'])->name('student.list');
        Route::get('/add', [StudentController::class, 'student_add'])->name('student.add');
        Route::get('/{id}/edit', [StudentController::class, 'editStudent'])->name('editStudent');

        
        Route::post('/remove', [StudentController::class, 'x_removeStudentByID'])->name('x_removeStudentByID');
    });

});