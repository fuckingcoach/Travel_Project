<?php

use App\Http\Controllers\MemberController;
use App\Http\Middleware\CheckAdmin;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "manager","prefix" => "admin/member"], function(){
    Route::get("list", [MemberController::class, "list"]);
    Route::get("create", [MemberController::class, "create"]);
    Route::post("store", [MemberController::class, "store"]);
    Route::get("edit/{id}", [MemberController::class, "edit"]);
    Route::post("update", [MemberController::class, "update"]);
    Route::post("delete", [MemberController::class, "delete"]);

}); 