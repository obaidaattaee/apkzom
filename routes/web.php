<?php

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

use App\Http\Controllers\Admin\AdminBaseController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OSTypeController;
use App\Http\Controllers\Admin\OSVersionController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Site\SiteController;

Route::prefix(LaravelLocalization::setLocale())->group(function () {

    Route::get('/', [SiteController::class, 'index']);

    Auth::routes();

    Route::get('/home', 'HomeController@index')->name('home');
    Route::prefix('admin')->namespace('Admin')->middleware(['auth', 'role:admin'])->group(function () {

        Route::get('users/json', [UserController::class, 'users'])->name('users.json');
        Route::get('roles/json', [UserController::class, 'roles'])->name('roles');
        Route::get('category/json', [CategoryController::class, 'categories'])->name('category');
        Route::get('tags/json', [TagController::class, 'tags'])->name('tags');
        Route::get('os_versions/json', [OSVersionController::class, 'versions'])->name('os_versions');
        Route::get('os-types/search', [OSTypeController::class, 'search'])->name('os_types.search');

        Route::get('/', [AdminBaseController::class, 'index']);
        Route::resource('users', 'UserController');
        Route::resource('categories', 'CategoryController');
        Route::resource('tags', 'TagController');
        Route::resource('os-types', 'OSTypeController');
        Route::resource('sliders', 'SliderController');
        Route::resource('versions', 'OSVersionController');
        Route::resource('apps', 'AppController');
    });
});
