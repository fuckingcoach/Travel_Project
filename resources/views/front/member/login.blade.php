@extends("front.layout")
@section("title", "會員登入")
@push("style")
<link rel="stylesheet" href="/css/front/index.css">
<style>
    .login-bg {
        min-height: 100vh;
        position: relative;

        background:
            linear-gradient(rgba(0, 0, 0, 0.35),
                rgba(0, 0, 0, 0.35)),
            url('/images/login.jpg');

        background-size: cover;
        background-position: center;

        display: flex;
        align-items: center;
    }

    /* .login-bg .container {
        display: flex;
        justify-content: center;
    } */


    /* 讓表單有透明玻璃感 */
    .bg-white.bg-opacity-90 {
        background-color: rgba(255, 255, 255, 0.9) !important;
    }
</style>
@endpush
@section("content")
<div class="login-bg">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card shadow-lg border-0 rounded-4 bg-white bg-opacity-90">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h2 class="fw-bold">會員登入</h2>
                            <p class="text-muted">歡迎回來，開始您的旅程</p>
                        </div>
                        <form action="/member/doLogin" method="post">
                            @if($errors->has("none"))
                            <div class="text-danger text-center">{{ $errors->first('none') }}</div>
                            @endif
                            <div class="mb-3 form-floating">
                                <input type="text" name="email" value="{{ old('email') }}" class="form-control form-control-lg" placeholder="">
                                <label class="form-label">帳號:</label>
                            </div>

                            <div class="mb-3 form-floating">
                                <input type="password" name="pwd" class="form-control form-control-lg" placeholder="請輸入密碼">
                                <label class="form-label">密碼:</label>
                            </div>

                            <div class="row g-2 align-items-center">
                                <div class="col-7">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="bi bi-shield-check"></i>
                                        </span>
                                        <input type="text" class="form-control" name="code" placeholder="請輸入認證碼">
                                    </div>
                                </div>

                                <div class="col-5 text-end">
                                    <img src="/captcha/flat" class="img-fluid border rounded" style="max-height:70px; cursor:pointer;" onclick="this.src='/captcha/flat?'+Math.random()">
                                </div>
                            </div>
                            @if($errors->has("code"))
                            <div class="text-danger text-start">{{ $errors->first('code') }}</div>
                            @endif

                            <div class="d-grid mt-4">
                                <button type="submit" class="btn btn-success btn-lg">登入</button>
                            </div>

                            <div class="d-flex justify-content-around mt-4">
                                <a href="#" class="text-decoration-none">忘記密碼？</a>
                                <a href="/member/register" class="text-decoration-none">還沒註冊?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection