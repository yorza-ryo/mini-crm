<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\PackSizeController;

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


Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');

Route::resource('company', CompanyController::class)->except(['update']);
Route::post('company/{company}', [CompanyController::class, 'update'])->name('company.update');
Route::resource('employee', EmployeeController::class);
Route::resource('packsize', PackSizeController::class);
Route::get('countpack', [PackSizeController::class, 'count'])->name('packsize.count');
Route::get('lang/change', [LangController::class, 'change'])->name('change.lang');