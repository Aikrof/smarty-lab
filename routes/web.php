<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', [\App\Http\Controllers\Controller::class, 'top']);
Route::get('/newest', [\App\Http\Controllers\Controller::class, 'newest']);
Route::get('/newcomments', [\App\Http\Controllers\Controller::class, 'newcomments']);
Route::get('/ask', [\App\Http\Controllers\Controller::class, 'ask']);
Route::get('/show', [\App\Http\Controllers\Controller::class, 'show']);
Route::get('/jobs', [\App\Http\Controllers\Controller::class, 'jobs']);

Route::get('item', [\App\Http\Controllers\Controller::class, 'item']);

