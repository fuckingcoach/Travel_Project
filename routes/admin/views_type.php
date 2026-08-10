<?php

use App\Http\Controllers\Admin\AdminViewstypeController;
use Illuminate\Support\Facades\Route;

Route::group(["prefix" => "admin"], function () {

    Route::get("/viewstype/list", [AdminViewstypeController::class, "list"]);
});
