<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
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
    return redirect()->route('login');
});

Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function(){
    Route::get('/login',[AuthController::class, 'loginView'])->middleware('notAuth')->name('login');
    Route::post('/login',[AuthController::class, 'login'])->middleware('notAuth')->name('login.post');
    Route::get('/logout',[AuthController::class, 'logout'])->middleware('isAuth')->name('logout');
});

Route::get('/home', [HomeController::class, 'index'])->middleware('isAuth')->name('home');

Route::group(['prefix' => 'car', 'middleware' => ['isAuth']], function(){
    Route::get('/',[CarController::class, 'index'])->name('car');
    Route::post('/',[CarController::class, 'create'])->name('car.create');
    Route::put('/{id}',[CarController::class, 'update'])->name('car.update');
    Route::delete('/{id}',[CarController::class, 'delete'])->name('car.delete');
});

Route::group(['prefix' => 'buyer', 'middleware' => ['isAuth']], function(){
    Route::get('/',[BuyerController::class, 'index'])->name('buyer');
    Route::post('/',[BuyerController::class, 'create'])->name('buyer.create');
});

Route::group(['prefix' => 'data', 'middleware' => ['isAuth']], function(){
    Route::get('/car', [CarController::class, 'dataCar'])->name('car.data');
    Route::get('/buyer', [BuyerController::class, 'dataBuyer'])->name('buyer.data');
});

Route::group(['prefix' => 'report', 'middleware' => ['isAuth']], function(){
    Route::get('/',[ReportController::class, 'index'])->name('report');
});




