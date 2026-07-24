<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('front.views_list');
});

include 'front/views_list.php';
