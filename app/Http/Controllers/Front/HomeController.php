<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Views;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function tfv()
    {
        $heroImages = collect(File::files(public_path('images/views')))
            ->filter(fn ($file) => in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'webp'], true))
            ->sortBy(fn ($file) => $file->getFilename(), SORT_NATURAL | SORT_FLAG_CASE)
            ->take(20)
            ->map(fn ($file) => 'images/views/' . $file->getFilename())
            ->values();

        //travelfood
        $response = Http::get(
            'https://data.moa.gov.tw/Service/OpenData/ODwsv/ODwsvTravelFood.aspx'
        );

        $foods = collect($response->json() ?? [])
            ->values()
            ->map(function ($food, $index) {
                $food['id'] = $index + 1;
                return $food;
            })
            ->take(6);

        // 查詢景點資料
        $recentViews = Views::with(['imgs', 'types'])
            ->latest()
            ->take(6)
            ->get();
        return view("front.home", compact("foods", "recentViews", "heroImages"));
    }
}
