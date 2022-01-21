<?php

use Illuminate\Support\Facades\Route;

use \App\Http\Controllers\Auth\AdminLoginController;
use App\Http\Controllers\Auth\ModeratorLoginController;
use App\Http\Controllers\Auth\ProductLoginController;
use App\Models\Moderator;
use Illuminate\Support\Facades\Auth;

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

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('admin/login', [AdminLoginController::class, 'showLoginForm']);
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('admin.login');


Route::group(['prefix' => 'admin', 'middleware' => 'assign.guard:admin,admin/login'], function () {
    Route::get('dashboard', function () {
        return view('admin.dashboard');
    });
});

Route::get('moderator/login', [ModeratorLoginController::class, 'showLoginForm']);
Route::post('moderator/login', [ModeratorLoginController::class, 'login'])->name('moderator.login');


Route::group(['prefix' => 'moderator', 'middleware' => 'assign.guard:moderator,moderator/login'],  function () {

    Route::get('dashboard', function () {
        return view('moderator.dashboard');
    });
});


Route::get('product/login', [ProductLoginController::class, 'showLoginForm']);

Route::post('product/login', [ProductLoginController::class, 'login'])->name('product.login');



Route::group(['prefix' => 'product', 'middleware' => 'product.guard:product,product/login'], function () {

    Route::get('dashboard', function () {
        return view('product.dashboard');
    });
});