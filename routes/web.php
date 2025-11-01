<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProcessController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/run-process',[ProcessController::class, 'runExample']);
Route::get('/run-async',[ProcessController::class, 'runSingleAsync']);
Route::get('/run-multiAsync',[ProcessController::class, 'runMultipleAsync']);
Route::get('/index',[ProcessController::class,'index']);
Route::get('/collection',[ProcessController::class,'collection']);
