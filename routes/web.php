<?php

use App\Http\Controllers\UrlContentController;
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

Route::get('/url-content', [UrlContentController::class, 'read'])->name('url-content');
Route::get('/download-content', [UrlContentController::class, 'downloadContent'])->name('download-content');
Route::post('/queue-url', [UrlContentController::class, 'store'])->name('queue-url');


