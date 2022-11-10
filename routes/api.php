<?php

use App\Http\Controllers\Api\ApiUrlContentController;
use App\Http\Controllers\Api\FileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('/url-content', ApiUrlContentController::class)->only('index', 'store');
Route::get('/download-content', [FileController::class, 'downloadContent'])->name('download-content');