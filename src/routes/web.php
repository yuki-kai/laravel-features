<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VideoController;


// 一覧画面
Route::get('/', [UserController::class, 'index'])->name('user.index');
Route::get('/edit/user/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::post('/update/user/{id}', [UserController::class, 'update'])->name('user.update');
Route::post('/delete/user/{id}', [UserController::class, 'delete'])->name('user.delete');


// サムネイル自動生成
Route::get('/video', [VideoController::class, 'index'])->name('video.index');
Route::get('/video/create', [VideoController::class, 'create'])->name('video.create');
Route::post('/video/store', [VideoController::class, 'store'])->name('video.store');

