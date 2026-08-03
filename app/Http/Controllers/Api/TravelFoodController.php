<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Throwable;

class TravelFoodController extends Controller
{
    /**
     * 取得全部清洗後的美食資料。
     *
     * GET /api/travelfoods
     */
    public function index(): JsonResponse
    {
        try {
            $foods = $this->getCleanFoods();

            return response()->json([
                'status' => true,
                'count' => $foods->count(),
                'data' => $foods,
            ]);
        } catch (Throwable $error) {
            report($error);

            return response()->json([
                'status' => false,
                'message' => '美食資料暫時無法取得',
                'data' => [],
            ], 503);
        }
    }

    /**
     * 取得指定整數 ID 的美食資料。
     *
     * GET /api/travelfoods/{id}
     */
    public function show(int $id): JsonResponse
    {
        try {
            $food = $this->getCleanFoods()->firstWhere('id', $id);

            if (!$food) {
                return response()->json([
                    'status' => false,
                    'message' => '找不到指定的美食資料',
                ], 404);
            }

            return response()->json([
                'status' => true,
                'data' => $food,
            ]);
        } catch (Throwable $error) {
            report($error);

            return response()->json([
                'status' => false,
                'message' => '美食資料暫時無法取得',
            ], 503);
        }
    }

    /**
     * 從農業部 API 取得資料並進行清洗。
     */
    private function getCleanFoods()
    {
        /*
         * 快取一小時，避免每次呼叫自己的 API，
         * 都重新請求農業部 API。
         */
        return Cache::remember(
            'travel_foods_clean_data',
            now()->addHour(),
            function () {
                $response = Http::connectTimeout(5)
                    ->timeout(15)
                    ->retry(2, 300)
                    ->get(
                        'https://data.moa.gov.tw/Service/OpenData/ODwsv/ODwsvTravelFood.aspx',
                        [
                            'IsTransData' => 1,
                            'UnitId' => 193,
                        ]
                    );

                $response->throw();

                $result = $response->json() ?? [];

                /*
                 * 相容以下兩種 API 格式：
                 *
                 * 1. [ {...}, {...} ]
                 * 2. { "Data": [ {...}, {...} ] }
                 */
                $source = isset($result['Data']) && is_array($result['Data'])
                    ? $result['Data']
                    : $result;

                return collect($source)
                    ->filter(fn($item) => is_array($item))
                    ->values()
                    ->map(function (array $item, int $index) {
                        return [
                            // 第一筆從 1 開始
                            'id' => $index + 1,

                            'Name' => $this->cleanText(
                                $item['Name'] ?? ''
                            ),

                            'Address' => $this->cleanText(
                                $item['Address'] ?? ''
                            ),

                            'Tel' => $this->cleanText(
                                $item['Tel'] ?? ''
                            ),

                            'Url' => $this->cleanText(
                                $item['Url']
                                    ?? $item['URL']
                                    ?? ''
                            ),

                            'Email' => $this->cleanText(
                                $item['Email'] ?? ''
                            ),

                            'FoodFeature' => $this->cleanText(
                                $item['FoodFeature']
                                    ?? $item['HostWords']
                                    ?? ''
                            ),

                            'City' => $this->cleanText(
                                $item['City'] ?? ''
                            ),

                            'Town' => $this->cleanText(
                                $item['Town'] ?? ''
                            ),

                            'PicURL' => $this->cleanText(
                                $item['PicURL'] ?? ''
                            ),
                        ];
                    });
            }
        );
    }

    /**
     * 清除 HTML、換行與多餘空白。
     */
    private function cleanText(mixed $value): string
    {
        if (!is_scalar($value)) {
            return '';
        }

        $value = strip_tags((string) $value);

        // 將連續空白、換行、Tab 整理成一個空白
        $value = preg_replace('/\s+/u', ' ', $value);

        return trim($value ?? '');
    }
}
