<?php

use App\Http\Controllers\ImgController;
use App\Http\Controllers\ViewsTypeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// 1. 取得文章列表 (GET http://localhost/api/posts)
Route::get('/viewstype', [ViewsTypeController::class, 'index']);

// 2. 新增文章 (POST http://localhost/api/posts)
Route::post('/viewstype', [ViewsTypeController::class, 'store']);

// 3. 取得單篇文章 (GET http://localhost/api/posts/1)
Route::get('/viewstype/{id}', [ViewsTypeController::class, 'show']);

// 4. 更新文章 (PUT http://localhost/api/posts/1)
Route::put('/viewstype/{id}', [ViewsTypeController::class, 'update']);

// 5. 刪除文章 (DELETE http://localhost/api/posts/1)
Route::delete('/viewstype/{id}', [ViewsTypeController::class, 'destroy']);
