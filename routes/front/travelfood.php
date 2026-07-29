<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/travelfood', function () {
    // 由後端抓取 API 資料（避開 CORS）
    $response = Http::get('https://data.moa.gov.tw/Service/OpenData/ODwsv/ODwsvTravelFood.aspx?IsTransData=1&UnitId=193');
    $foods = $response->json() ?? [];

    return view('front.travelfood.travelfood', compact('foods'));
});
