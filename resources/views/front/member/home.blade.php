@extends("front.layout")
@section("title", "xxx系統")
@push("style")
<link rel="stylesheet" href="/css/front/index.css">
@endpush
@section("content")
<div class="container py-4">
    <div class="row">
        <div class="col-lg-3 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <img src="https://placehold.co/100x100" class="rounded-circle mb-3" alt="avatar">
                    <h5 class="mb-1">王小明</h5>
                    <p class="text-muted mb-0">example@gmail.com</p>
                </div>
            </div>
        </div>

        <div class="col-lg-9">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-person-circle fs-1 text-primary"></i>
                            <h5 class="mt-3">會員資料</h5>
                            <p class="text-muted">
                                查看您的基本資料、Email、加入日期等資訊。
                            </p>
                            <button class="btn btn-outline-primary">
                                查看資料
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-heart-fill fs-1 text-danger"></i>
                            <h5 class="mt-3">收藏景點</h5>
                            <p class="text-muted">
                                管理您收藏的景點與旅遊行程。
                            </p>
                            <button class="btn btn-outline-danger">
                                查看收藏
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-pencil-square fs-1 text-success"></i>
                            <h5 class="mt-3">修改會員資料</h5>
                            <p class="text-muted">
                                更新姓名、電話、地址等個人資訊。
                            </p>
                            <button class="btn btn-outline-success">
                                前往修改
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card h-100 shadow-sm">
                        <div class="card-body text-center">
                            <i class="bi bi-shield-lock fs-1 text-warning"></i>
                            <h5 class="mt-3">修改密碼</h5>
                            <p class="text-muted">
                                定期更新密碼，提升帳號安全性。
                            </p>
                            <button class="btn btn-outline-warning">
                                修改密碼
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection