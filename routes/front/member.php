<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\MemberController as fm;  // frontmember 跟adminmember區隔開

Route::group(["prefix" => "member"], function () {
    Route::group(["middleware" => "memberlogin"], function () {
        Route::get("home", [fm::class, "home"]);
        Route::get("logout", [fm::class, "logout"]);
        Route::post("update", [fm::class, "update"]);
    });

    Route::group(["middleware" => "guest"], function () {
        Route::get("login", [fm::class, "login"]);
        Route::post("doLogin", [fm::class, "doLogin"]);
        Route::get("register", [fm::class, "register"]);
        Route::post("store", [fm::class, "store"]);
    });
});
