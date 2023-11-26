<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Auth;

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
    return redirect('home');
})->middleware('auth');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name ('home');







//administrator
Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {

    Route::group(['prefix' => 'student'], function() {
       
    Route::get('/add', [StudentController::class, 'student_add'])->name('student.add');
       

    });

});



//teacher or user
Route::group(['prefix' => 'teacher', 'middleware' => ['auth']], function () {

    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance');;
    Route::get('/list', [StudentController::class, 'studentlist'])->name('student.list');
    Route::get('/{id}/edit', [StudentController::class, 'editStudent'])->name('editStudent');
    Route::post('/remove', [StudentController::class, 'x_removeStudentByID'])->name('x_removeStudentByID');
});






//Admin-User
Route::group(['prefix' => 'profile', 'middleware' => ['auth']], function () {

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');;
});


