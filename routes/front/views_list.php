<?php

use App\Http\Controllers\ViewsController;
use Illuminate\Support\Facades\Route;

// 最新消息
Route::group(["prefix" => "views"], function () {
    // 最新消息列表
    Route::get("/", [ViewsController::class, "list"]);
    // 最新消息詳細資料
    Route::get("detail/{id}", [ViewsController::class, "detail"]);
});
