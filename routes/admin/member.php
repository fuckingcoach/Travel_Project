<?php

use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "admin"], function () {
    Route::group(["prefix" => "member"], function () {
        Route::get("list", [MemberController::class, "list"]);
        // Route::get("list/{id}", [MemberController::class, "listid"]);
        Route::get("create", [MemberController::class, "create"]);
        Route::post("store", [MemberController::class, "store"]);
        Route::get("edit/{id}", [MemberController::class, "edit"]);
        Route::post("update", [MemberController::class, "update"]);
        Route::post("delete", [MemberController::class, "delete"]);
    });
});
