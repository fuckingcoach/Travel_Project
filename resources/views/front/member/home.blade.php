@extends("front.layout")
@section("title", "會員中心")
@push("style")
<link rel="stylesheet" href="/css/front/index.css">
<link rel="stylesheet" href="/css/front/member/home.css">
@endpush
@section("content")
<div class="container py-4">
    <div class="row mb-4">

        <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="member-profile">
                <div class="member-profile-body">
                    <img src="/images/default_avatar.png"
                        class="member-avatar">
                    <h5>{{ $member->memberName }}</h5>
                    <p>{{ $member->email }}</p>
                </div>
            </div>
        </div>


        <div class="col-lg-9">
            <div class="member-banner">
                <h2>
                    歡迎回來，{{ $member->memberName }}
                </h2>
                <p>
                    管理您的會員資料、收藏景點與帳號安全。
                </p>
            </div>
        </div>
    </div>

    <div class="row g-4" id="member-menu">
        <div class="col-md-6">
            <div class="card member-card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-person-circle fs-1 text-primary"></i>
                    <h5 class="mt-3">會員資料</h5>
                    <p class="text-muted">查看您的基本資料、Email、加入日期等資訊。</p>
                    <button class="btn btn-outline-primary" id="profile_btn">查看資料</button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card member-card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-heart-fill fs-1 text-danger"></i>
                    <h5 class="mt-3">收藏景點</h5>
                    <p class="text-muted">管理您收藏的景點與旅遊行程。</p>
                    <button class="btn btn-outline-danger">查看收藏</button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card member-card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-pencil-square fs-1 text-success"></i>
                    <h5 class="mt-3">修改會員資料</h5>
                    <p class="text-muted">更新姓名、電話等個人資訊。</p>
                    <button class="btn btn-outline-success">前往修改</button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card member-card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-shield-lock fs-1 text-warning"></i>
                    <h5 class="mt-3">修改密碼</h5>
                    <p class="text-muted">定期更新密碼，提升帳號安全性。</p>
                    <button class="btn btn-outline-warning">修改密碼</button>
                </div>
            </div>
        </div>

    </div>

    <div class="row" id="member-content">

    </div>
</div>

<script>
    $(function() {
        $("#profile_btn").on("click", function() {
            $("#member-menu").addClass('d-none');

            let html = `<div>
                        <button class="btn btn-secondary" id ="back_btn">返回</button>
                        </div>`;
            $("#member-content").html(html);
        });

        $("#member-content").on("click", "#back_btn", function() {
            $("#member-menu").removeClass('d-none');
            $("#member-content").empty();
        });
    });
</script>
@endsection