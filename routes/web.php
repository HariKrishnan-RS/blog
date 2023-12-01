<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use \App\Http\Middleware\RedirectIfNotAuthenticated;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

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

Route::get('/test.page', function () {
    return view('test');
})->name('test.page');



Route::get('blogPage',[PageController::class,'MainPage'])->name('blog.page');
// Route::get('blogPage/read/{id}',[PageController::class,'ReadPage'])->name('read.page');
Route::get('blogPage/read/{id}', [PageController::class, 'readPage'])
->name('read.page')
->middleware(RedirectIfNotAuthenticated::class);


Route::get('/login', [LoginController::class,'showLoginForm'])->name('login.page');
Route::post('/login', [LoginController::class,'login']);

Route::get('/register', [RegisterController::class,'showRegistrationForm'])->name('register.page');
Route::post('/register', [RegisterController::class,'register'])->name('register.submit');
           
Route::post('/blogPage', [LoginController::class,'logout'])->name('logout.user');

// Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');