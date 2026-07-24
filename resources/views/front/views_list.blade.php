@extends("front.layout")
@section("title","景點清單")
@push("style")
<link rel="stylesheet" href="/css/front/news.css">
@endpush
@section("content")
<div class="page-hero">
    <div class="container">
        <h1><i class="fa fa-newspaper" style="color:var(--gold);margin-right:10px"></i>最新消息</h1>
        <div class="bc">
            <a href="/">首頁</a>
            <i class="fa fa-chevron-right" style="font-size:10px"></i>
            最新消息
        </div>
    </div>
</div>

<!-- News List -->
<div class="section">
    <div class="container">
        <!-- Category Filter -->
        <div class="cat-tabs">
            <button class="cat-tab active" onclick="filterCat(this,'all')">全部</button>
            @if (!empty($types))
            @foreach($types as $data)
            <button class="cat-tab" onclick="filterCat(this,'cat{{ $data->id }}')">{{ $data->typeName }}</button>
            @endforeach
            @endif
        </div>

        <!-- News List -->
        @if (!empty($list))
        @foreach($list as $data)
        <div class="news-grid" id="news-list">
            {{-- data-cat="cat{{ $data->typeId }}": 類別篩選 --}}
            <div class="news-item" data-cat="cat{{ $data->typeId }}">
                <div class="news-date">
                    <!-- 日期 -->
                    <div class="day">{{ $data->show_day }}</div>
                    <!-- 年/月-->
                    <div class="month">{{ $data->show_month }}</div>
                </div>
                <div class="news-thumb-placeholder">
                    @if (!empty($data->photo))
                    <!--圖檔-->
                    <img src="/images/news/S/{{ $data->photo }}">
                    @else
                    <!--預設圖示-->
                    <i class="fa fa-newspaper"></i>
                    @endif
                </div>
                <div class="news-body">
                    <!--類別名稱-->
                    <span class="news-badge">{{ $data->types->typeName }}</span>
                    <!--標題-->
                    <div class="news-title"><a href="/news/detail/{{ $data->id }}">{{ $data->title }}</a></div>
                    <!-- 內容超過50個字元時,用...-->
                    <p class="news-excerpt">{!! Str::limit($data->content, 50) !!}</p>
                </div>
            </div>
        </div>
        @endforeach
        @endif

        <!-- Pagination -->

        <div class="pagination">
            <span class="disabled"><i class="fa fa-chevron-left" style="font-size:11px"></i></span>
            <span class="active">1</span>
            <a href="#">2</a>
            <a href="#">3</a>
            <a href="#">4</a>
            <span>…</span>
            <a href="#">8</a>
            <a href="#"><i class="fa fa-chevron-right" style="font-size:11px"></i></a>
        </div>

    </div>
</div>
<script>
    function filterCat(btn, cat) {
        document.querySelectorAll('.cat-tab').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');
        document.querySelectorAll('.news-item').forEach(item => {
            item.style.display = (cat === 'all' || item.dataset.cat === cat) ? 'flex' : 'none';
        });
    }
</script>
@endsection