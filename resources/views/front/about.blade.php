@extends("front.layout")

@section("title")
修改紀錄
@endsection

@push("style")
<style>
.change-log {
    padding: 24px 0;
}

.change-log .log-item {
    margin-bottom: 24px;
    padding-bottom: 16px;
    border-bottom: 1px solid #E5E7EB;
}

.change-log h1 {
    margin-bottom: 10px;
    color: #1B2E5E;
    font-size: 18px;
    font-weight: 700;
}

.change-log p {
    margin-bottom: 6px;
    color: #222222;
    font-size: 14px;
    font-weight: 500;
    line-height: 1.7;
}
</style>
@endpush

@section("content")
<div class="row change-log">
    <div class="col-12 log-item ms-3">
        <h1>7/28</h1>
        <p>修正 views 為卡片，獨立出 views.css</p>
        <p>/views-0 表格</p>
        <p>/views-1 卡片</p>
        <p>/views?region=中部&type=2 最新版，<br>列表頁支援透過 URL query parameters 帶入篩選條件</p>
    </div>

    <div class="col-12 log-item ms-3">
        <h1>7/29</h1>
        <p>完成/views/{id}</p>
        <p>修正 header，獨立出 header.css</p>
        <p>首頁初稿</p>
    </div>

    <div class="col-12 log-item ms-3">
        <h1>8/3</h1>
        <p>完成/travelfood/{id}</p>
        <p>寫api/travelfood</p>
        <p>在travelfood_detail.blade中呼叫api</p>
        <p>用jQuery的ajax</p>
    </div>

    <div class="col-12 log-item ms-3">
        <h1>8/3</h1>
        <p>完成/travelfood</p>
        <p>route取opendata和id:index+1</p>
        <p>用vuejs渲染表格、分區篩選、分頁</p>
    </div>
</div>
@endsection