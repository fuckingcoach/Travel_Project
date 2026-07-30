<?php

use App\Http\Controllers\front\MemberController as frontmember;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "member", "middleware" => ["web", "memberlogin"]], function () {
    Route::get("profile", [frontmember::class, "getFrontMember"]);
    Route::post("update", [frontmember::class, "update"]);
});
