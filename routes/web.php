<?php

use Illuminate\Support\Facades\Route;
include "admin/index.php";

Route::get('/', function () {
    return view('welcome');
});
