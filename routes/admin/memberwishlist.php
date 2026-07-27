<?php

use App\Http\Controllers\MemberWishlistController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "admin"], function () {
    Route::group(["prefix" => "collection"], function () {
        Route::get("list", [MemberWishlistController::class, "list"]);
        // Route::get("list/{id}",[MemberWishlistController::class, "listid"]);
        Route::post("add", [MemberWishlistController::class, "add"]);
        Route::post("delete", [MemberWishlistController::class, "delete"]);
    });
});
