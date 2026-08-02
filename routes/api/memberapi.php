<?php

use App\Http\Controllers\Api\ApiMemberController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "member"], function () {
    Route::group(["middleware" => "auth:sanctum"], function () {
        Route::get("profile", [ApiMemberController::class, "getFrontMember"]);
        Route::post("update", [ApiMemberController::class, "update"]);
        Route::get("checkEmail", [ApiMemberController::class, "checkEmail"]);
        // Route::get("checkPwd", [ApiMemberController::class, "checkPwd"]);
        Route::post("updatePwd", [ApiMemberController::class, "updatePwd"]);
    });
});
