@extends("front.layout")

@section("title")
{{ $detail->name }} - 旅遊景點指南
@endsection

@push("style")
<link rel="stylesheet" href="{{ asset('css/front/views_detail.css') }}">
<!-- 引入 Fancybox 5 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css" />

<style>
    /* 強制修正 Fancybox 控制按鈕與箭頭顯示 (防止被 Bootstrap 等 CSS 覆蓋) */
    .fancybox__container {
        --fancybox-color: #ffffff;
        --fancybox-bg: rgba(24, 24, 27, 0.92);
        z-index: 1050 !important; /* 確保高於 Bootstrap Navbar/Modal */
    }

    /* 左右切換箭頭顯示與大小修復 */
    .fancybox__container .carousel__button.is-prev,
    .fancybox__container .carousel__button.is-next {
        display: flex !important;
        opacity: 1 !important;
        background: rgba(0, 0, 0, 0.5) !important;
        border-radius: 50% !important;
        width: 48px !important;
        height: 48px !important;
        color: #ffffff !important;
    }
    
    .fancybox__container .carousel__button.is-prev:hover,
    .fancybox__container .carousel__button.is-next:hover {
        background: rgba(201, 168, 76, 0.8) !important; /* 懸停變金色 */
    }

    /* 右上角工具列與退出按鈕修復 */
    .fancybox__toolbar {
        --fancybox-color: #ffffff;
        opacity: 1 !important;
        padding: 8px !important;
    }

    .fancybox__toolbar .fancybox__button {
        color: #ffffff !important;
        opacity: 0.9 !important;
    }

    .fancybox__toolbar .fancybox__button:hover {
        opacity: 1 !important;
        color: #C9A84C !important;
    }

    /* 頁面下方小縮圖列表樣式 */
    .thumbnail-gallery .thumb-link img {
        width: 90px;
        height: 65px;
        object-fit: cover;
        cursor: pointer;
        transition: all 0.2s ease-in-out;
    }
    .thumbnail-gallery .thumb-link img:hover {
        transform: translateY(-2px);
        border-color: #C9A84C !important;
        box-shadow: 0 4px 8px rgba(201, 168, 76, 0.3);
    }

    /* 熱門景點側邊欄縮圖樣式 (4:6 比例) */
    .recent-item-img {
        width: 50px;
        aspect-ratio: 4 / 6;
        object-fit: cover;
        border-radius: 4px;
        flex-shrink: 0;
        transition: transform 0.2s ease;
    }
    .recent-item:hover .recent-item-img {
        transform: scale(1.05);
    }
    .recent-no-img {
        width: 50px;
        aspect-ratio: 4 / 6;
        background-color: #f3f4f6;
        color: #9ca3af;
        border-radius: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }
</style>
@endpush

@section("content")
<!-- 1. Hero 頂部區塊 (動態變數) -->
<div class="page-hero">
  <div class="container">
    <h1>{{ $detail->name }}</h1>
    <div class="bc">
      <a href="/">首頁</a>
      <i class="fa fa-chevron-right" style="font-size:10px"></i>
      <a href="/views">旅遊景點</a>
      <i class="fa fa-chevron-right" style="font-size:10px"></i>
      {{ $detail->types?->typeName ?? '景點資訊' }}
    </div>
  </div>
</div>

<div class="section">
  <div class="container">
    <div class="layout-2col">

      <div>
        <!-- 返回按鈕 -->
        <a href="/views" class="back-btn mb-3 d-inline-block text-decoration-none">
          <i class="fa fa-arrow-left me-1"></i> 返回列表
        </a>

        <!-- 文章/景點主要卡片 -->
        <div class="article-card">
          <div class="article-meta mb-2">
            <span class="news-badge">{{ $detail->types?->typeName ?? '未分類' }}</span>
          </div>

          <!-- 🖼️ 相簿展示區 -->
          @if (!empty($detail->imgs) && $detail->imgs->isNotEmpty())
            <div class="views-gallery mb-4">
              
              <!-- (1) 主展示大圖：固定綁定第 1 張圖片 -->
              <div class="main-cover-box mb-3">
                <a href="/images/views/{{ $detail->imgs->first()->imgSrc }}" 
                   data-fancybox="gallery" 
                   data-thumb="/images/views/S/{{ $detail->imgs->first()->imgSrc }}"
                   data-caption="{{ $detail->name }} - 圖 1">
                  <img src="/images/views/{{ $detail->imgs->first()->imgSrc }}" 
                       class="article-cover rounded shadow-sm w-100" 
                       alt="{{ $detail->name }}"
                       style="max-height: 450px; object-fit: cover;">
                </a>
              </div>

              <!-- (2) 下方小相簿列表：跳過第 1 張 (skip(1))，只印第 2 張之後的圖片 -->
              @if($detail->imgs->count() > 1)
                <div class="d-flex gap-2 flex-wrap thumbnail-gallery">
                  @foreach($detail->imgs->skip(1) as $index => $img)
                    <a href="/images/views/{{ $img->imgSrc }}" 
                       data-fancybox="gallery" 
                       data-thumb="/images/views/S/{{ $img->imgSrc }}"
                       data-caption="{{ $detail->name }} - 圖 {{ $index + 2 }}"
                       class="thumb-link">
                      <img src="/images/views/S/{{ $img->imgSrc }}" 
                           class="rounded border img-fluid" 
                           alt="縮圖 {{ $index + 2 }}">
                    </a>
                  @endforeach
                </div>
              @endif

            </div>
          @else
            <!-- 無圖片時的預設展示框 -->
            <div class="article-cover d-flex align-items-center justify-content-center bg-light rounded mb-4" style="height: 250px;">
              <i class="fa fa-newspaper fa-3x text-secondary"></i>
            </div>
          @endif

          <!-- 文章內容 -->
          <div class="article-body">
            <h2 class="article-title fw-bold my-3">{{ $detail->name }}</h2>
            <div class="article-content">
              {!! $detail->content !!}
            </div>
          </div>

          <!-- 上一則 / 下一則 -->
          <div class="article-nav d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
            @if($prevViews)
              <a href="/views/{{ $prevViews->id }}" class="btn-nav-prev text-decoration-none">
                <i class="fa fa-chevron-left me-1"></i> 上一則：{{ $prevViews->name }}
              </a>
            @else
              <span></span>
            @endif

            @if($nextViews)
              <a href="/views/{{ $nextViews->id }}" class="btn-nav-next text-decoration-none text-end">
                下一則：{{ $nextViews->name }} <i class="fa fa-chevron-right ms-1"></i>
              </a>
            @else
              <span></span>
            @endif
          </div>
        </div>

      </div>

      {{-- 側邊欄 Sidebar --}}
      <div>
        <div class="sidebar-card mb-4">
          <div class="sidebar-title fw-bold mb-2"><i class="fa fa-list me-1"></i> 景點分類</div>
          @foreach($list as $data)
            <div class="cat-list-item py-1">
              <a href="/views?type={{ $data->id }}" class="text-decoration-none">{{ $data->typeName }}</a>
            </div>
          @endforeach
        </div>

        <div class="sidebar-card">
          <div class="sidebar-title fw-bold mb-3"><i class="fa fa-fire text-danger me-1"></i> 熱門景點</div>
          @foreach($recentViews as $item)
            <div class="recent-item d-flex align-items-center mb-3">
              
              <!-- 景點縮圖 (取第一張照片，檔名位在 /images/views/S/) -->
              <a href="/views/{{ $item->id }}" class="me-3 text-decoration-none">
                @if(!empty($item->imgs) && $item->imgs->isNotEmpty() && $item->imgs->first()->imgSrc)
                  <img src="/images/views/S/{{ $item->imgs->first()->imgSrc }}" 
                       alt="{{ $item->name }}" 
                       class="recent-item-img border shadow-sm">
                @else
                  <div class="recent-no-img border">
                    <i class="fa fa-image"></i>
                  </div>
                @endif
              </a>

              <!-- 景點名稱與資訊 -->
              <div class="recent-body">
                <div class="rt mb-1">
                  <a href="/views/{{ $item->id }}" class="text-decoration-none text-dark fw-bold hover-gold">
                    {{ $item->name }}
                  </a>
                </div>
                @if($item->city || $item->town)
                  <div class="small text-muted" style="font-size: 12px;">
                    <i class="fa fa-map-marker-alt me-1 text-danger"></i>{{ $item->city }}{{ $item->town }}
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
      // 1. 強制顯示左右切換箭頭 (Navigation)
      Navigation: true,

      // 2. 開啟下方縮圖導覽列 (Thumbs)
      Thumbs: {
        type: "classic", // 縮圖樣式：'classic' 或 'modern'
        autoStart: true, // 點開時預設開啟縮圖列
      },

      // 3. 右上角工具列 (包含關閉/退出按鈕)
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
          right: ["slideshow", "thumbs", "close"], // close 即為右上角「X」退出按鈕
        },
      },

      // 4. 無限循環切換 (最後一張可以切回第一張)
      infinite: true,

      // 5. 允許點擊背景空白處直接退出 Lightbox
      backdropClick: "close",
    });
  });
</script>
@endpush