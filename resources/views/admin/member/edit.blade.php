@extends('admin.layout')
@section('title','會員修改')
@section('content')
<div class="app-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="display-5 fw-bold text-center">修改會員</div>
            </div>
            <div class="card-body">
                <form action="/admin/member/update" method="post">
                    <input type="hidden" name="id" value="{{ $member->id }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">會員名稱</label>
                        <input type="text" name="memberName" class="form-control" value="{{ old('memberName',$member->memberName) }}" placeholder="請輸入會員名稱">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">電子信箱</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email',$member->email) }}" placeholder="請輸入電子信箱">
                        @if ($errors->has("emailexist"))
                        <div class="text-danger">{{ $errors->first('emailexist') }}</div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label class="form-label">電話</label>
                        <input type="text" name="tel" class="form-control" value="{{ old('tel',$member->tel) }}" placeholder="請輸入電話">
                    </div>

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="bi bi-check-lg"></i>儲存</button>
                        <a href="/admin/member/list" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i>返回</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection