<?php

use App\Http\Controllers\SalatTimeController;
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
Route::get('/test-env', function () {
    return env('SLACK_WEBHOOK_URL');
});
Route::group(['prefix'=>'salat-time','as'=>'salat-time.'], function(){
    Route::get('/', [SalatTimeController::class, 'index'])->name('index');
    Route::get('/create', [SalatTimeController::class, 'create'])->name('create');
    Route::post('/store', [SalatTimeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [SalatTimeController::class, 'edit'])->name('edit');
    Route::post('/update/{id}', [SalatTimeController::class, 'update'])->name('update');
    Route::get('/delete/{id}', [SalatTimeController::class, 'destroy'])->name('delete');
});

