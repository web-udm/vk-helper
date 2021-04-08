<?php

use App\Http\Controllers\VkTokenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CheckerController;

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

//с главной перенаправляем сразу на домашнюю у чекера
Route::redirect('/', '/checker/home');

Route::get('/get-vk-token', [VkTokenController::class, 'getToken'])->name('get-vk-token');

Route::get('/set-vk-token', [VkTokenController::class, 'setToken'])->name('set-vk-token');

Route::prefix('checker')->group(function () {
    Route::get('/home', [CheckerController::class, 'home'])->name('checker-home');
    Route::post('/result', [CheckerController::class, 'results'])->name('checker-results');
});