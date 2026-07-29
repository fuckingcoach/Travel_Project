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
                    <button class="btn btn-outline-success" id="edit_btn">前往修改</button>
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

    <div id="member-profile" class="card d-none member-page">
        <div class="row my-5 justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4">
                    <h2 class="display-6 fw-bold result-title">📋 會員資料</h2>
                </div>
                <div class="card shadow-sm rounded-4">
                    <div class="card-body p-4">
                        <div class="row mb-3">
                            <div class="col-4 fw-bold">會員名稱</div>
                            <div class="col-8" id="name"></div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-4 fw-bold">電子信箱</div>
                            <div class="col-8" id="email"></div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-4 fw-bold">電話</div>
                            <div class="col-8" id="tel"></div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-4 fw-bold">生日</div>
                            <div class="col-8" id="birthday"></div>
                        </div>
                        <hr>
                        <div class="row mb-3">
                            <div class="col-4 fw-bold">地址</div>
                            <div class="col-8" id="address"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-4 fw-bold">會員狀態</div>
                            <div class="col-8" id="status"></div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0 p-4">
                        <button class="btn btn-secondary w-100 rounded-5" id="back_btn">返回</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="member-edit" class="card d-none member-page">
        <div class="row my-5 justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4">
                    <h2 class="display-6 fw-bold result-title">📝 會員修改</h2>
                </div>
                <div class="card shadow-sm rounded-4">
                    <form action="">
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <input type="file" id="avatar" class="d-none" accept="image/*">
                                    <label for="avatar">
                                        <img src="/images/default_avatar.png"
                                            class="member-edit-avatar">
                                    </label>
                                    <!-- <img src="/images/default_avatar.png" class="member-avatar"> -->
                                </div>
                                <div class="col-md-7 mb-3">
                                    <label class="col-4 fw-bold  form-label">會員名稱</label>
                                    <input type="text" class="form-control" name="edit_name" id="edit_name">
                                    <label class="col-4 fw-bold  form-label">生日</label>
                                    <input type="date" class="form-control" name="edit_birthday" id="edit_birthday">
                                </div>
                                <hr>
                                <div class="col-12 mb-3">
                                    <label class="col-4 fw-bold  form-label">電子信箱</label>
                                    <input type="text" class="form-control" name="edit_email" id="edit_email" value="" placeholder="請輸入會員名稱">
                                </div>
                                <hr>
                                <div class="col-12 mb-3">
                                    <label class="col-4 fw-bold  form-label">電話</label>
                                    <input type="text" class="form-control" name="edit_tel" id="edit_tel" value="" placeholder="請輸入會員名稱">
                                </div>
                                <hr>
                                <div class="col-12 mb-3">
                                    <label class="col-4 fw-bold  form-label">地址</label>
                                    <input type="text" class="form-control" name="edit_address" id="edit_address" value="" placeholder="請輸入會員名稱">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="bg-transparent p-4 d-flex justify-content-around">
                                <button type="button" class="btn btn-success w-30 rounded-5" id="save_btn">儲存</button>
                                <button type="button" class="btn btn-secondary w-30 rounded-5" id="back_btn">返回</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios@1.13.2/dist/axios.min.js"></script>
<script>
    $(function() {
        $("#avatar").on("change", function() {
            const file = this.files[0];
            console.log(file);
        });

        $("#profile_btn").on("click", function() {
            axios
                .get('/api/member/profile')
                .then(function(response) {
                    console.log(response);
                    $("#name").text(response.data.memberName);
                    $("#email").text(response.data.email);
                    $("#tel").text(response.data.tel);
                    $("#address").text(response.data.address);
                    $("#birthday").text(response.data.birthday);
                    $("#status").text(response.data.status);
                    $("#member-menu").addClass('d-none');
                    $("#member-profile").removeClass('d-none');
                })
                .catch(function(error) {
                    console.log(error);
                })
                .finally(function() {
                    // always executed
                });
        });

        $("#edit_btn").on("click", function() {
            axios
                .get('/api/member/profile')
                .then(function(response) {
                    console.log(response);
                    $("#edit_name").val(response.data.memberName);
                    $("#edit_email").val(response.data.email);
                    $("#edit_tel").val(response.data.tel);
                    $("#edit_birthday").val(response.data.birthday);
                    $("#edit_address").val(response.data.address);
                    $("#edit_status").val(response.data.status);
                    $("#member-menu").addClass('d-none');
                    $("#member-edit").removeClass('d-none');
                })
                .catch(function(error) {
                    console.log(error);
                })
                .finally(function() {
                    // always executed
                });
        });


        $(document).on("click", "#back_btn", function() {
            $(".member-page").addClass('d-none');
            $("#member-menu").removeClass('d-none');
        });
    });
</script>
@endsection