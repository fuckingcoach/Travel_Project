@extends("front.layout")

@section("title")
首頁 - 台灣旅遊與美食指南
@endsection

@push("style")
<!-- Swiper 11 CSS -->
<link
  rel="stylesheet"
  href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

<link
  rel="stylesheet"
  href="{{ asset('css/front/home.css') }}?v={{ time() }}">

<link
  rel="stylesheet"
  href="{{ asset('css/front/news.css') }}">
@endpush

@section("content")

<!-- ======================================
     1. Hero 主視覺輪播
======================================= -->
<section class="hero-section" id="heroSection">

  <div class="hero-parallax-content" id="heroParallaxContent">
    <h1 class="hero-title">
      探索台灣 發現美麗新視界
    </h1>

    <p class="hero-subtitle">
      嚴選全台熱門景點、在地美食與秘境指南，展開您的下一趟難忘旅程
    </p>

    <a href="{{ url('/views') }}" class="hero-btn">
      <i class="fa fa-compass me-2"></i>
      探索熱門景點
    </a>
  </div>

  <div class="swiper heroSwiper">
    <div class="swiper-wrapper">

      <!-- 預設輪播圖片 -->
      <div
        class="swiper-slide"
        style="background-image: url('{{ asset('images/front/detail-hero.jpg') }}');">
        <div class="hero-overlay"></div>
      </div>

      <div
        class="swiper-slide"
        style="background-image: url('{{ asset('images/front/hero-banner.jpg') }}');">
        <div class="hero-overlay"></div>
      </div>

      <!-- 動態景點輪播圖片 -->
      @if(isset($recentViews) && $recentViews->isNotEmpty())
      @foreach($recentViews->take(4) as $slide)
      @if(
      $slide->imgs &&
      $slide->imgs->isNotEmpty() &&
      $slide->imgs->first()->imgSrc
      )
      <div
        class="swiper-slide"
        style="background-image: url('{{ asset('images/views/' . $slide->imgs->first()->imgSrc) }}');">
        <div class="hero-overlay"></div>
      </div>
      @endif
      @endforeach
      @endif

    </div>

    <div class="swiper-button-next d-none d-md-flex"></div>
    <div class="swiper-button-prev d-none d-md-flex"></div>
    <div class="swiper-pagination"></div>
  </div>

</section>


<!-- ======================================
     2. 品牌特色
======================================= -->
<section class="section section-alt">
  <div class="container">

    <div class="section-header reveal">
      <div class="section-eyebrow">
        Travel Your Way
      </div>

      <h2 class="section-title">
        用喜歡的方式<span>認識台灣</span>
      </h2>

      <div class="gold-line"></div>

      <p class="section-desc">
        不趕路、不打卡，從你的興趣出發，找到真正想停留的地方。
      </p>
    </div>

    <div class="features-grid">

      <div class="feature-card reveal">
        <div class="feature-icon">
          <i class="fa fa-utensils"></i>
        </div>

        <div class="feature-title">
          美食之旅
        </div>

        <p class="feature-desc">
          從傳統市場、街邊小吃到風土餐桌，循著味道讀懂每座城市的個性。
        </p>
      </div>

      <div
        class="feature-card reveal"
        style="transition-delay: 0.1s;">
        <div class="feature-icon">
          <i class="fa fa-landmark"></i>
        </div>

        <div class="feature-title">
          文化漫遊
        </div>

        <p class="feature-desc">
          走訪老街、古蹟與地方聚落，在建築、工藝與節慶裡遇見島嶼記憶。
        </p>
      </div>

      <div
        class="feature-card reveal"
        style="transition-delay: 0.2s;">
        <div class="feature-icon">
          <i class="fa fa-person-hiking"></i>
        </div>

        <div class="feature-title">
          山海戶外
        </div>

        <p class="feature-desc">
          登山、單車、潛水或沿海散步，依照季節與體力挑選剛剛好的冒險。
        </p>
      </div>

    </div>
  </div>
</section>


<!-- ======================================
     3. 熱門推薦景點
======================================= -->
<section class="section featured-views-section">
  <div class="container">

    <div class="section-header reveal">
      <div class="section-eyebrow">
        Featured Destinations
      </div>

      <h2 class="section-title">
        熱門<span>推薦景點</span>
      </h2>

      <div class="gold-line"></div>
    </div>

    <div class="row g-4">

      @if(isset($recentViews) && $recentViews->isNotEmpty())

      @foreach($recentViews->take(4) as $view)
      <div class="col-12 col-md-6 col-lg-3">

        <article class="card view-card h-100 shadow-sm border-0 rounded-3 overflow-hidden">

          <div class="card-img-wrap">

            @if(
            $view->imgs &&
            $view->imgs->isNotEmpty() &&
            $view->imgs->first()->imgSrc
            )
            <img
              src="{{ asset('images/views/' . $view->imgs->first()->imgSrc) }}"
              class="card-img-top"
              alt="{{ $view->name }}"
              loading="lazy">
            @else
            <div class="no-img-box d-flex align-items-center justify-content-center">
              <i class="fa fa-image fa-2x text-muted"></i>
            </div>
            @endif

            <!-- 景點圖片 Hover 遮罩 -->
            <div class="card-img-overlay-custom">
              <a
                href="{{ url('/views/' . $view->id) }}"
                class="card-more-btn"
                aria-label="查看更多：{{ $view->name }}">
                查看更多
              </a>
            </div>

          </div>

          <div class="card-body d-flex flex-column">

            <div class="small text-muted mb-2">
              <span class="news-badge me-2">
                {{ $view->types?->typeName ?? '未分類' }}
              </span>

              @if($view->city || $view->town)
              <span>
                <i class="fa fa-map-marker-alt text-danger me-1"></i>
                {{ $view->city }}{{ $view->town }}
              </span>
              @endif
            </div>

            <h3 class="card-title h5 fw-bold">
              <a
                href="{{ url('/views/' . $view->id) }}"
                class="text-decoration-none text-dark hover-gold">
                {{ $view->name }}
              </a>
            </h3>

            <p class="card-text text-muted small flex-grow-1">
              {{
                    Str::limit(
                      strip_tags($view->content ?? ''),
                      80,
                      '...'
                    )
                  }}
            </p>

          </div>

        </article>
      </div>
      @endforeach

      @else

      <div class="col-12 text-center py-4 text-muted">
        <i class="fa fa-info-circle me-1"></i>
        目前暫無景點資料
      </div>

      @endif

    </div>

    <a href="{{ url('/views') }}" class="view-more-link">
      檢視全部
      <i class="fa fa-chevron-right ms-2"></i>
    </a>

  </div>
</section>


<!-- ======================================
     4. 在地美食指南
======================================= -->
<section class="section featured-foods-section">
  <div class="container">

    <div class="section-header reveal">
      <div class="section-eyebrow">
        Local Food Guide
      </div>

      <h2 class="section-title">
        在地<span>美食指南</span>
      </h2>

      <div class="gold-line"></div>
    </div>

    <div class="row g-4">

      @if(!empty($foods))

      @foreach(array_slice($foods, 0, 4) as $food)
      @php
      $foodID = $food['ID'] ?? null;
      $foodName = $food['Name'] ?? '精選美食';
      @endphp

      <div class="col-12 col-md-6 col-lg-3">

        <article class="card view-card h-100 shadow-sm border-0 rounded-3 overflow-hidden">

          <div class="card-img-wrap">

            @if(!empty($food['PicURL']))
            <img
              src="{{ $food['PicURL'] }}"
              class="card-img-top"
              alt="{{ $foodName }}"
              loading="lazy">
            @else
            <div class="no-img-box d-flex align-items-center justify-content-center">
              <i class="fa fa-utensils fa-2x text-muted"></i>
            </div>
            @endif

            <!-- 美食圖片 Hover 遮罩 -->
            <div class="card-img-overlay-custom">
              @if($foodID)
              <a
                href="{{ url('/travelfood/' . $food['id']) }}"
                class="card-more-btn"
                aria-label="查看更多：{{ $foodName }}">
                查看更多
              </a>
              @else
              <span class="card-more-btn">
                暫無詳情
              </span>
              @endif
            </div>

          </div>

          <div class="card-body d-flex flex-column">

            <div class="small text-muted mb-2">
              <span class="news-badge me-2">
                在地美食
              </span>

              @if(!empty($food['City']) || !empty($food['Town']))
              <span>
                <i class="fa fa-map-marker-alt text-danger me-1"></i>
                {{ $food['City'] ?? '' }}{{ $food['Town'] ?? '' }}
              </span>
              @endif
            </div>

            <h3 class="card-title h5 fw-bold">
              @if($foodID)
              <a
                href="{{ route('travelfood.detail', ['ID' => $foodID]) }}"
                class="text-decoration-none text-dark hover-gold">
                {{ $foodName }}
              </a>
              @else
              <span class="text-dark">
                {{ $foodName }}
              </span>
              @endif
            </h3>

            <p class="card-text text-muted small flex-grow-1">
              {{
                    Str::limit(
                      strip_tags(
                        $food['HostWords']
                        ?? $food['FoodFeature']
                        ?? '暫無詳細介紹'
                      ),
                      80,
                      '...'
                    )
                  }}
            </p>

          </div>

        </article>
      </div>
      @endforeach

      @else

      <div class="col-12 text-center py-4 text-muted">
        <i class="fa fa-info-circle me-1"></i>
        目前暫無美食開放資料資訊
      </div>

      @endif

    </div>

    <a href="{{ url('/travelfood') }}" class="view-more-link">
      檢視全部
      <i class="fa fa-chevron-right ms-2"></i>
    </a>

  </div>
</section>

@endsection


@push("script")
<!-- Swiper 11 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    /*
     * Hero 輪播
     */
    new Swiper(".heroSwiper", {
      loop: true,
      effect: "fade",

      fadeEffect: {
        crossFade: true
      },

      speed: 1200,

      autoplay: {
        delay: 4500,
        disableOnInteraction: false
      },

      pagination: {
        el: ".heroSwiper .swiper-pagination",
        clickable: true
      },

      navigation: {
        nextEl: ".heroSwiper .swiper-button-next",
        prevEl: ".heroSwiper .swiper-button-prev"
      }
    });

    /*
     * Hero 視差效果
     */
    const parallaxContent = document.getElementById(
      "heroParallaxContent"
    );

    const heroSection = document.getElementById(
      "heroSection"
    );

    const reduceMotion = window.matchMedia(
      "(prefers-reduced-motion: reduce)"
    ).matches;

    if (
      !parallaxContent ||
      !heroSection ||
      reduceMotion
    ) {
      return;
    }

    let ticking = false;

    window.addEventListener(
      "scroll",
      function() {
        if (ticking) {
          return;
        }

        ticking = true;

        window.requestAnimationFrame(function() {
          const heroRect =
            heroSection.getBoundingClientRect();

          if (
            heroRect.bottom >= 0 &&
            heroRect.top <= window.innerHeight
          ) {
            const scrollDistance = Math.max(
              0,
              -heroRect.top
            );

            const heroHeight =
              heroSection.offsetHeight;

            const translateY =
              scrollDistance * 0.35;

            const opacity = Math.max(
              0,
              1 -
              scrollDistance /
              (heroHeight * 0.75)
            );

            parallaxContent.style.transform =
              `translate(-50%, calc(-50% + ${translateY}px))`;

            parallaxContent.style.opacity =
              opacity;
          }

          ticking = false;
        });
      }, {
        passive: true
      }
    );
  });
</script>
@endpush