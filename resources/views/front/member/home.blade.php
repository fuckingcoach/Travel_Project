@extends("front.layout")
@section("title", "會員中心")
@push("style")
<link rel="stylesheet" href="/css/front/index.css">
<link rel="stylesheet" href="/css/front/member/home.css">
@endpush
@section("content")
<div class="container py-4">
    <div class="row mb-4" id="member-info">
        <div class="col-lg-3 mb-4 mb-lg-0">
            <div class="member-profile">
                <div class="member-profile-body">
                    <img src=""
                        class="member-avatar" id="info_avatar">
                    <h5 class="member_name"></h5>
                    <p id="member_email"></p>
                </div>
            </div>
        </div>


        <div class="col-lg-9">
            <div class="member-banner">
                <h2>歡迎回來，<span class="member_name"></span></h2>
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
                        <button class="btn btn-secondary w-100 rounded-5 back_btn">返回</button>
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
                    <form id="form_edit" enctype="multipart/form-data">
                        <input type="hidden" name="edit_id" value="{{ $member->id }}">
                        @csrf
                        <div class="card-body p-4">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <input type="file" id="avatar" class="d-none" accept="image/*" name="edit_avatar">
                                    <label for="avatar">
                                        <img src=""
                                            class="member-edit-avatar" id="member_avatar">
                                    </label>
                                </div>
                                <div class="col-md-7 mb-3">
                                    <label class="col-4 fw-bold  form-label">會員名稱</label>
                                    <input type="text" class="form-control" name="edit_name" id="edit_name" required>
                                    <label class="col-4 fw-bold  form-label">生日</label>
                                    <input type="date" class="form-control" name="edit_birthday" id="edit_birthday">
                                </div>
                                <hr>
                                <div class="col-12 mb-3">
                                    <label class="col-4 fw-bold  form-label">電子信箱</label>
                                    <input type="text" class="form-control" name="edit_email" id="edit_email" value="" placeholder="請輸入會員名稱" required>
                                    <div class="valid-feedback">信箱符合規定</div>
                                    <div class="invalid-feedback">請輸入正確的信箱格式</div>
                                </div>
                                <hr>
                                <div class="col-12 mb-3">
                                    <label class="col-4 fw-bold  form-label">電話</label>
                                    <input type="text" class="form-control" name="edit_tel" id="edit_tel" value="" placeholder="請輸入會員名稱">
                                    <div class="valid-feedback">電話格式符合</div>
                                    <div class="invalid-feedback">請輸入正確的電話格式</div>
                                </div>
                                <hr>
                                <div class="col-12 mb-3">
                                    <label class="col-4 fw-bold  form-label">地址</label>
                                    <input type="text" class="form-control" name="edit_address" id="edit_address">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="bg-transparent p-4 d-flex justify-content-around">
                                <button type="submit" class="btn btn-success btn-lg w-30 rounded-5">儲存</button>
                                <button type="button" class="btn btn-secondary btn-lg w-30 rounded-5" id="back_btn">返回</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios@1.13.2/dist/axios.min.js"></script>
<script src="/js/jquery.js"></script>
<script>
    $(function() {
        loadMember();
        $("#avatar").on("change", function() {
            const file = this.files[0];
            console.log(file);

            if (file) {
                const url = URL.createObjectURL(file);
                console.log(url);
                $(".member-edit-avatar").attr("src", url);
            }
        });

        $("#profile_btn").on("click", function() {
            $("#name").text(member.memberName);
            $("#email").text(member.email);
            $("#tel").text(member.tel);
            $("#address").text(member.address);
            $("#birthday").text(member.birthday);
            $("#status").text(member.status);
            $("#member-menu").addClass('d-none');
            $("#member-profile").removeClass('d-none');
        });

        $("#edit_btn").on("click", function() {
            $("#edit_name").val(member.memberName);
            $("#edit_email").val(member.email);
            $("#edit_tel").val(member.tel);
            $("#edit_birthday").val(member.birthday);
            $("#edit_address").val(member.address);
            $("#edit_status").val(member.status);
            document.querySelector('.member-edit-avatar').src = '/images/member/' + member.avatar;
            $("#member-menu").addClass('d-none');
            $("#member-edit").removeClass('d-none');

        });

        $("#form_edit").on("submit", function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            axios
                .post('/api/member/update', formData)
                .then(function(response) {
                    console.log(response);
                    if (response.data.message == '成功修改!') {
                        Swal.fire({
                            title: response.data.message,
                            icon: "success",
                            showDenyButton: false,
                            showCancelButton: false,
                            confirmButtonText: "確定",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                $("#member-edit").addClass('d-none');
                                $("#member-menu").removeClass('d-none');
                                // 重新讀取會員資料，設定會員新圖片
                                loadMember();

                            }
                        });
                    } else {
                        Swal.fire({
                            title: "修改失敗!",
                            text: "請檢查資料格式",
                            icon: "error"
                        });
                    }
                })
                .catch(function(error) {
                    console.log(error);
                })
                .finally(function() {
                    // always executed
                });
        });

        $("#edit_email").on("input", function() {
            let email = $(this).val();
            let reg = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;

            if (!reg.test(email)) {
                $(this).removeClass("is-valid");
                $(this).addClass("is-invalid");
                flag_email = false;
            } else {
                $(this).removeClass("is-invalid");
                $(this).addClass("is-valid");
                flag_email = true;
            }
        });

        $("#edit_tel").on("input", function() {
            let tel = $("#tel").val();
            let reg = /^[0-9-]*[0-9][0-9-]*$/;
            if (tel === "" || !reg.test(tel)) {
                $(this).removeClass("is-valid");
                $(this).addClass("is-invalid");
                flag_tel = false;
            } else {
                $(this).removeClass("is-invalid");
                $(this).addClass("is-valid");
                flag_tel = true;
            }
        });


        $(document).on("click", "#back_btn", function() {
            if (this.id == "back_btn") {
                $(".member-page").addClass('d-none');
                $("#member-menu").removeClass('d-none');
            }
        });

        $(document).on("click", "#save_btn",function(){

        });
    });

    function loadMember() {
        axios
            .get('/api/member/profile')
            .then(function(response) {
                // window   :   javascript全域變數
                console.log(response.data);
                window.member = response.data;
                updateInfo(member.memberName, member.email, member.avatar);

            })
            .catch(function(error) {
                console.log(error);
            })
            .finally(function() {
                // always executed
            });
    }

    function updateInfo(name, email, avatar) {
        $(".member_name").text(name);
        $("#member_email").text(email);
        $("#info_avatar").attr(
            "src",
            "/images/member/" + avatar + "?t=" + Date.now()
        );
    }
</script>
@endsection