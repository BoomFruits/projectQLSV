<?php

use App\Http\Controllers\StudentController;
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
Route::resource('students', StudentController::class);
Route::get('students/show/{StudentID}',[StudentController::class,'show'])->name('students.show');
Route::get('students/edit/{StudentID}',[StudentController::class,'edit'])->name('students.edit');
Route::put('students/update/{StudentID}',[StudentController::class,'update'])->name('students.update');
Route::delete('students/delete/{StudentID}',[StudentController::class,'destroy'])->name('students.destroy');
// Route::get('students/show/{StudentID}',[StudentController::class,'show'])->name('students.show');

