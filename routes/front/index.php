<?php

use App\Http\Controllers\ViewsController;
use App\Models\Img;
use App\Models\Views;
use App\Models\ViewsType;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

include "member.php";

// Route::get("/", [IndexController::class, "index"]);
// Route::get('/travelfood', function () {
//     return view('front.travelfood.travelfood');
// });

Route::get('/travelfood', function () {
    // 由後端抓取 API 資料（避開 CORS）
    $response = Http::get('https://data.moa.gov.tw/Service/OpenData/ODwsv/ODwsvTravelFood.aspx?IsTransData=1&UnitId=193');
    $foods = $response->json() ?? [];

    return view('front.travelfood.travelfood', compact('foods'));
});

Route::get('/views', function () {
    // 直接走 Eloquent ORM，速度最快且不會有轉字串代價
    $views = Views::latest()->get();
    $viewstype = ViewsType::latest()->get();
    $img = Img::latest()->get();

    return view('front.views.views', compact('views', 'viewstype', 'img'));
});
