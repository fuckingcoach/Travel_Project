<?php

use App\Http\Controllers\ViewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

include 'api/views.php';
include 'api/views_types.php';
include 'api/imgs.php';
