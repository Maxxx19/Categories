<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SaveDataController;
use App\Http\Controllers\DownloadDataController;
use App\Http\Livewire\Films;

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
Route::get('/home', function () {
    return view('home');
});
Route::get('createData', [DownloadDataController::class, 'create'])->name('create.data');
Route::get('storeData', [SaveDataController::class, 'store'])->name('store.data');
Route::get('films', [Films::class, 'render'])->name('films.render');
Route::get('films/{film_id}', [Films::class, 'show'])->name('films.show');
