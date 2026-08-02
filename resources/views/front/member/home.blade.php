@extends("front.layout")
@section("title", "會員中心")
@push("style")
<link rel="stylesheet" href="/css/front/index.css">
<link rel="stylesheet" href="/css/front/member/home.css">
<link rel="stylesheet" href="/css/front/member/changePwd.css">
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
                    <button class="btn btn-outline-warning" id="pwd_btn">修改密碼</button>
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
                    <div class="card-footer bg-transparent border-0 p-4 ">
                        <button class="btn btn-secondary w-100 rounded-5 back_btn d-flex justify-content-center align-items-center">返回</button>
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
                        <input type="hidden" name="edit_id" id="edit_id">
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
                                <div class="col-10 mb-3 d-flex align-items-end gap-2">
                                    <div class=" flex-grow-1">
                                        <label class="fw-bold  form-label">電子信箱</label>
                                        <small id="email-msg" class="text-danger">
                                            信箱未通過檢查
                                        </small>
                                        <input type="text" class="form-control" name="edit_email" id="edit_email" value="" placeholder="請輸入會員名稱" required>
                                    </div>
                                    <button type="button" class="btn btn-success" id="emailcheck">檢查信箱</button>
                                </div>
                                <hr>
                                <div class="col-8 mb-3">
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
                                <button type="submit" class="btn btn-success btn-lg w-30 rounded-5" id="saveedit_btn">儲存</button>
                                <button type="button" class="btn btn-secondary btn-lg w-30 rounded-5 back_btn">返回</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="member-pwd" class="d-none card member-page">
        <div class="row my-5 justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4">
                    <h2 class="display-6 fw-bold result-title">
                        <i class="fa fa-shield-alt" style="color:var(--gold)"></i>
                        修改密碼
                    </h2>
                </div>
                <div class="card shadow-sm rounded-4">
                    <form id="form_pwd">
                        @csrf
                        <div class="card-body p-4">
                            <div class="form-group mb-4">
                                <label class="form-label fw-bold" for="oldpwd">
                                    目前密碼 <span style="color:var(--danger)">*</span>
                                </label>
                                <div class="icon-wrap">
                                    <i class="fa fa-lock icon"></i>
                                    <input type="password" id="oldpwd" name="oldpwd" class="form-control" placeholder="請輸入目前密碼" required>
                                    <span class="pw-toggle" onclick="togglePw('oldpwd',this)">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label fw-bold" for="newpwd">
                                    新密碼 <span style="color:var(--danger)">*</span>
                                </label>
                                <div class="icon-wrap">
                                    <i class="fa fa-key icon"></i>
                                    <input type="password" id="newpwd" name="newpwd" class="form-control" placeholder="至少 8 個字元" required oninput="checkStrength(this.value)">
                                    <span class="pw-toggle" onclick="togglePw('newpwd',this)">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                                <div class="pw-strength mt-2">
                                    <div class="pw-strength-bar" id="pw-bar"></div>
                                </div>
                                <p class="field-hint" id="pw-hint">請輸入至少 8 個字元，包含英文與數字</p>
                            </div>

                            <div class="form-group mb-4">
                                <label class="form-label fw-bold" for="newpwd_confirmation">
                                    確認新密碼 <span style="color:var(--danger)">*</span>
                                </label>
                                <div class="icon-wrap">
                                    <i class="fa fa-key icon"></i>
                                    <input type="password" id="newpwd_confirmation" name="newpwd_confirmation" class="form-control" placeholder="再次輸入新密碼" required>
                                    <span class="pw-toggle" onclick="togglePw('newpwd_confirmation',this)">
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                                <p class="field-hint" id="match-hint"></p>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="bg-transparent p-4 d-flex justify-content-around">
                                <button type="submit" class="btn btn-warning btn-lg w-30 rounded-5" id="savepwd_btn">
                                    <i class="fa fa-save"></i> 確認修改
                                </button>
                                <button type="button" class="btn btn-secondary btn-lg w-30 rounded-5 back_btn">
                                    <i class="fa fa-times"></i> 返回
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let flag_tel = false;
    let flag_pwd = false;
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
            // 設定修改頁面的會員資料
            $("#edit_name").val(member.memberName);
            $("#edit_email").val(member.email);
            $("#edit_tel").val(member.tel);
            $("#edit_birthday").val(member.birthday);
            $("#edit_address").val(member.address);
            $("#edit_status").val(member.status);
            document.querySelector('.member-edit-avatar').src = '/images/member/' + member.avatar;

            // 預先設定儲存修改按鈕為disabled，除非檢查過email
            $("#saveedit_btn").prop('disabled', true);

            // 先觸發一次電話格式判斷
            $("#edit_tel").trigger('input');
            $("#email-msg").removeClass("text-success");
            $("#email-msg").addClass('text-danger');
            $("#member-menu").addClass('d-none');
            $("#member-edit").removeClass('d-none');

        });

        $("#form_edit").on("submit", async function(e) {
            e.preventDefault();
            if (!flag_tel) {
                alert("電話格式不符");
                return false;
            }
            let formData = new FormData(this);

            try {
                let response = await axios.post('/api/member/update', formData);
                console.log(response);

                if (response.data.message == '成功修改!') {

                    // 先載入會員中心首頁
                    await loadMember();
                    $("#member-edit").addClass('d-none');
                    $("#member-menu").removeClass('d-none');
                    await Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        confirmButtonText: "確定",
                    });
                } else {
                    Swal.fire({
                        title: "修改失敗!",
                        text: "請檢查資料格式",
                        icon: "error"
                    });
                }
            } catch (error) {
                console.log(error);
                Swal.file({
                    title: "修改失敗",
                    text: "系統錯誤",
                    icon: "error"
                });
            }
        });

        $("#emailcheck").on("click", function() {
            let email = $("#edit_email").val().trim();
            let reg = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
            const btn = $(this);
            btn.prop('disabled', true);
            if (!reg.test(email)) {
                $("#email-msg").removeClass("text-success")
                    .addClass('text-danger')
                    .text("請輸入正確的信箱格式");
                $("#saveedit_btn").prop('disabled', true);
                btn.prop('disabled', false);

            } else {
                let id = sessionStorage.getItem('memberId');
                axios
                    .get('/api/member/checkEmail', {
                        params: {
                            email: email
                        }
                    })
                    .then(function(response) {
                        console.log(response.data)
                        if (response.data.exist) {
                            $("#email-msg").removeClass("text-success")
                                .addClass('text-danger')
                                .text("信箱已使用，請重新輸入!");
                            $("#saveedit_btn").prop('disabled', true);
                        } else {
                            $("#email-msg").removeClass("text-danger")
                                .addClass('text-success')
                                .text("信箱通過檢查");
                            $("#saveedit_btn").prop('disabled', false);
                        }
                    })
                    .catch(function(error) {
                        console.error("檢查信箱失敗：", error);
                        $("#email-msg").removeClass("text-success")
                            .addClass("text-danger")
                            .text("系統連線異常，請稍後再試");
                        $("#saveedit_btn").prop('disabled', true);
                    })
                    .finally(function() {
                        // always executed
                        btn.prop('disabled', false);
                    });
            }
        });

        $("#edit_tel").on("input", function() {
            let tel = $("#edit_tel").val();
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

        $("#pwd_btn").on("click", function() {
            flag_pwd_length = false;
            flag_pwd_confirm = false;
            $("#member-pwd").removeClass('d-none');
            $("#member-menu").addClass('d-none');
        });

        $("#form_pwd").on("submit", async function(e) {
            e.preventDefault();

            if (!flag_pwd) {
                alert("請檢查密碼是否相符")
                return false;
            }

            let formData = new FormData(this);

            try {
                let response = await axios.post('/api/member/updatePwd', formData);
                console.log(response);

                if (response.data.success) {
                    await loadMember();
                    $("#member-pwd").addClass('d-none');
                    $("#member-menu").removeClass('d-none');
                    Swal.fire({
                        title: response.data.message,
                        icon: "success",
                        confirmButtonText: "確定",
                    });
                }
            } catch (error) {
                console.log(error);
                if (error.response) {
                    Swal.fire({
                        title: error.response.data.message,
                        icon: "error"
                    });
                }else{
                    Swal.fire({
                        title: "系統錯誤",
                        text: "請稍後再試",
                        icon: "error"
                    });
                }
            }
        });


        $(".back_btn").on("click", function() {
            $(".member-page").addClass('d-none');
            $("#member-menu").removeClass('d-none');
        });
    });

    async function loadMember() {
        try {
            let response = await axios.get('/api/member/profile');
            console.log(response.data);

            // window   :   javascript全域變數
            window.member = response.data;
            updateInfo(member.memberName, member.email, member.avatar);
        } catch (error) {
            console.log(error);
        }
    }

    function updateInfo(name, email, avatar) {
        $(".member_name").text(name);
        $("#member_email").text(email);

        let img = "/images/member/" + avatar;

        if ($("#info_avatar").attr("src") !== img) {
            $("#info_avatar").attr("src", img);
        }
    }

    function togglePw(id, btn) {
        const el = document.getElementById(id);
        const icon = btn.querySelector('i');
        if (el.type === 'password') {
            el.type = 'text';
            icon.className = 'fa fa-eye-slash';
        } else {
            el.type = 'password';
            icon.className = 'fa fa-eye';
        }
    }

    function checkStrength(v) {
        const bar = document.getElementById('pw-bar');
        const hint = document.getElementById('pw-hint');
        let s = 0;
        flag_pwd = false;
        if (v.length >= 8) s++;
        if (/[0-9]/.test(v)) s++;
        if (/[A-Za-z]/.test(v)) s++;
        if (/[^A-Za-z0-9]/.test(v)) s++;
        const colors = ['#ef4444', '#f97316', '#eab308', '#22c55e'];
        const labels = ['過短', '弱', '普通', '強'];
        const idx = Math.max(0, s - 1);
        bar.style.width = (s * 25) + '%';
        bar.style.background = colors[idx];
        hint.textContent = '密碼強度：' + labels[idx];
    }
    document.getElementById('newpwd_confirmation').addEventListener('keyup', function() {
        const hint = document.getElementById('match-hint');
        if (this.value && this.value !== document.getElementById('newpwd').value) {
            hint.style.color = '#dc2626';
            hint.textContent = '⚠ 兩次密碼不一致';
            flag_pwd = false;
        } else if (this.value) {
            hint.style.color = '#16a34a';
            hint.textContent = '✓ 密碼一致';
            flag_pwd = true;
        } else {
            hint.textContent = '';
        }
    });

    function handleSubmit(e) {
        e.preventDefault();
        document.getElementById('success-msg').style.display = 'flex';
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>
@endsection