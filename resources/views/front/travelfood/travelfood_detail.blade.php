@extends("front.layout")

@php
// 新 API 使用整數 id；同時相容路由參數 {id} 與舊的 {ID}。
$foodId = (int) (
$id
?? request()->route('id')
?? request()->route('ID')
?? 0
);

// 相容 API 完整回應與直接傳入 data 陣列兩種方式。
$foodSource = isset($foods['data']) && is_array($foods['data'])
? $foods['data']
: ($foods ?? []);

$allFoods = collect($foodSource)
->filter(fn ($item) => is_array($item))
->values();

// 如果路由已傳入單筆 $food 就直接使用，否則從 $foods 尋找。
$singleFood = isset($food['data']) && is_array($food['data'])
? $food['data']
: ($food ?? null);

$detailData = $singleFood ?? $allFoods->first(function ($item) use ($foodId) {
return (int) ($item['id'] ?? 0) === $foodId;
});

abort_if(empty($detailData), 404, '找不到指定的美食資料');

$detail = (object) $detailData;

// 供上一則、下一則及側邊欄使用。
$allFoodsCol = $allFoods
->map(fn ($item) => (object) $item)
->values();

$currentIndex = $allFoodsCol->search(function ($item) use ($foodId) {
return (int) ($item->id ?? 0) === $foodId;
});

$prevFood = $currentIndex !== false && $currentIndex > 0
? $allFoodsCol->get($currentIndex - 1)
: null;

$nextFood = $currentIndex !== false && $currentIndex < $allFoodsCol->count() - 1
    ? $allFoodsCol->get($currentIndex + 1)
    : null;

    // 地區分類及熱門美食。
    $cityList = $allFoodsCol
    ->filter(fn ($item) => !empty($item->City))
    ->unique('City')
    ->take(5);

    $recentFoods = $allFoodsCol
    ->filter(fn ($item) => !empty($item->id))
    ->take(5);
    @endphp

    @section("title")
    {{ $detail->Name ?? '在地美食' }} - 台灣旅遊與美食指南
    @endsection

    @push("style")
    <link rel="stylesheet" href="{{ asset('css/front/views_detail.css') }}?v={{ time() }}">
    <!-- Fancybox 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css">
    @endpush

    @section("content")
    <!-- 1. Hero 頂部區塊 (動態變數) -->
    <div class="page-hero">
        <div class="container">
            <h1>{{ $detail->Name ?? '在地美食' }}</h1>
            <div class="bc">
                <a href="/">首頁</a>
                <i class="fa fa-chevron-right" style="font-size:10px"></i>
                <a href="/travelfood">在地美食</a>
                <i class="fa fa-chevron-right" style="font-size:10px"></i>
                {{ $detail->City ?? '美食資訊' }}
            </div>
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="layout-2col">

                <div>
                    <!-- 文章/景點主要卡片 -->
                    <div class="article-card">

                        <!-- 美食圖片 -->
                        @if (!empty($detail->PicURL))
                        <div class="views-gallery mb-4">

                            <div class="main-cover-box mb-3">
                                <a href="{{ $detail->PicURL }}"
                                    data-fancybox="gallery"
                                    data-thumb="{{ $detail->PicURL }}"
                                    data-caption="{{ $detail->Name ?? '在地美食' }}">
                                    <img src="{{ $detail->PicURL }}"
                                        class="article-cover rounded shadow-sm w-100"
                                        alt="{{ $detail->Name ?? '在地美食' }}"
                                        loading="lazy"
                                        style="max-height: 450px; object-fit: cover;">
                                </a>
                            </div>
                        </div>
                        @else
                        <div class="article-cover d-flex align-items-center justify-content-center bg-light rounded mb-4" style="height: 250px;">
                            <i class="fa fa-utensils fa-3x text-secondary"></i>
                        </div>
                        @endif

                        <!-- 文章內容區 -->
                        <div class="article-body">
                            <h2 class="article-title fw-bold my-3" style="color: var(--brand);">
                                {{ $detail->Name ?? '在地美食' }}
                            </h2>

                            <!-- 地址與電話 -->
                            <div class="d-flex align-items-center flex-wrap gap-3 text-muted small mb-3">
                                @if(!empty($detail->Address))
                                <div>
                                    <i class="fa fa-map-marker-alt text-danger me-1"></i>
                                    {{ $detail->Address }}
                                </div>
                                @endif

                                @if(!empty($detail->Tel))
                                <div>
                                    <i class="fa fa-phone text-primary me-1"></i>
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $detail->Tel) }}" class="text-decoration-none">
                                        {{ $detail->Tel }}
                                    </a>
                                </div>
                                @endif

                                @if(!empty($detail->Email))
                                <div>
                                    <i class="fa fa-envelope text-primary me-1"></i>
                                    <a href="mailto:{{ $detail->Email }}" class="text-decoration-none">
                                        {{ $detail->Email }}
                                    </a>
                                </div>
                                @endif

                                @if(!empty($detail->Url))
                                <div>
                                    <i class="fa fa-globe text-primary me-1"></i>
                                    <a href="{{ $detail->Url }}" target="_blank" rel="noopener noreferrer">
                                        官方網站
                                    </a>
                                </div>
                                @endif
                            </div>

                            <!-- 美食介紹 -->
                            <div class="article-content mt-3">
                                {!! nl2br(e($detail->FoodFeature ?? '目前暫無詳細介紹')) !!}
                            </div>
                        </div>

                        <!-- 分類標籤 -->
                        <div class="article-meta mb-2 mt-4 pt-3 border-top">
                            <span class="news-badge">{{ $detail->City ?? '未分類' }}</span>
                        </div>

                        <!-- 上一則 / 下一則 -->
                        <div class="article-nav d-flex justify-content-between align-items-center pt-3">
                            @if($prevFood && !empty($prevFood->id))
                            <a href="{{ url('/travelfood/' . $prevFood->id) }}" class="btn-nav-prev text-decoration-none">
                                <i class="fa fa-chevron-left me-1"></i> 上一則：{{ $prevFood->Name ?? '上一則' }}
                            </a>
                            @else
                            <span></span>
                            @endif

                            @if($nextFood && !empty($nextFood->id))
                            <a href="{{ url('/travelfood/' . $nextFood->id) }}" class="btn-nav-next text-decoration-none text-end">
                                下一則：{{ $nextFood->Name ?? '下一則' }} <i class="fa fa-chevron-right ms-1"></i>
                            </a>
                            @else
                            <span></span>
                            @endif
                        </div>
                    </div>

                    <!-- 返回按鈕 -->
                    <a href="/travelfood" class="back-btn mt-3 mb-3 d-inline-block text-decoration-none">
                        <i class="fa fa-arrow-left me-1"></i> 返回列表
                    </a>
                </div>

                {{-- 側邊欄 Sidebar --}}
                <div>
                    <div class="sidebar-card mb-4">
                        <div class="sidebar-title fw-bold mb-2"><i class="fa fa-list me-1"></i> 地區分類</div>
                        @foreach($cityList as $data)
                        <div class="cat-list-item py-1">
                            <a href="{{ url('/travelfood') }}?city={{ urlencode($data->City) }}" class="text-decoration-none">
                                {{ $data->City }}
                            </a>
                        </div>
                        @endforeach
                    </div>

                    <div class="sidebar-card">
                        <div class="sidebar-title fw-bold mb-3"><i class="fa fa-fire text-danger me-1"></i> 熱門美食</div>
                        @foreach($recentFoods as $itemObj)
                        <div class="recent-item d-flex align-items-center mb-3">

                            <!-- 美食縮圖 -->
                            <a href="{{ url('/travelfood/' . $itemObj->id) }}" class="me-3 text-decoration-none">
                                @if(!empty($itemObj->PicURL))
                                <img src="{{ $itemObj->PicURL }}"
                                    alt="{{ $itemObj->Name ?? '' }}"
                                    class="recent-item-img border shadow-sm"
                                    style="width: 60px; height: 60px; object-fit: cover;">
                                @else
                                <div class="recent-no-img border d-flex align-items-center justify-content-center bg-light" style="width: 60px; height: 60px;">
                                    <i class="fa fa-image text-secondary"></i>
                                </div>
                                @endif
                            </a>

                            <!-- 景點名稱與資訊 -->
                            <div class="recent-body">
                                <div class="rt mb-1">
                                    <a href="{{ url('/travelfood/' . $itemObj->id) }}" class="text-decoration-none text-dark fw-bold hover-gold">
                                        {{ $itemObj->Name ?? '' }}
                                    </a>
                                </div>
                                @if(!empty($itemObj->City))
                                <div class="small text-muted" style="font-size: 12px;">
                                    <i class="fa fa-map-marker-alt me-1 text-danger"></i>{{ $itemObj->City }}
                                </div>
                                @endif
                            </div>

                        </div>
                        @endforeach
                    </div>
                </div>

            </div>
        </div>
    </div>
    @endsection

    @push("script")
    <!-- 引入 Fancybox 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Fancybox.bind("[data-fancybox='gallery']", {
                Navigation: true,
                Thumbs: {
                    type: "classic",
                    autoStart: true,
                },
                Toolbar: {
                    display: {
                        left: ["infobar"],
                        middle: [
                            "zoomIn",
                            "zoomOut",
                            "toggle1to1",
                            "rotateCCW",
                            "rotateCW",
                            "flipX",
                            "flipY",
                        ],
                        right: ["slideshow", "thumbs", "close"],
                    },
                },
                infinite: true,
                backdropClick: "close",
            });
        });
    </script>
    @endpush