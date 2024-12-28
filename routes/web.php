<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;

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
    return view('welcome');
});

Route::get('home', [HomeController::class, 'index'])->name('home');

Route::get('profile', ProfileController::class)->name('profile');

Route::resource('employees', EmployeeController::class);

Route::get('getEmployees', [EmployeeController::class, 'getData'])->name('employees.getData');



Route::get('exportExcel', [EmployeeController::class, 'exportExcel'])->name('employees.exportExcel');


Route::get('exportPdf', [EmployeeController::class, 'exportPdf'])->name('employees.exportPdf');


