@extends('admin.layout')
@section('title','景點管理')
@section('content')
<style>
    table {
        table-layout: fixed;
        width: 100%;
    }

    .scroll-y {
        max-height: 120px;
        /* 設定你希望的最大高度 */
        overflow-y: auto;
        /* 內容超出高度時顯示垂直滾動條 */
        word-break: break-all;
        /* 避免連續英文/數字撐破容器 */
    }

    .table td img {
        max-width: 100%;
        /* 寬度不超過表格欄位 */
        max-height: 100px;
        /* 限制最大高度，避免把表格列 (tr) 撐得太高 */
        width: auto;
        height: auto;
        object-fit: contain;
        /* 確保圖片維持原本比例 */
        border-radius: 4px;
        /* (可選) 加上微圓角更美觀 */
    }
</style>
<div class="app-content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="display-5  fw-900 text-center">景點管理</div>
            </div>
            <div class="row mt-3 d-flex justify-content-center align-items-center">
                <div class="col-2 text-center">
                    <a href="add" class="btn btn-success">新增</a>
                </div>
                <div class="col-2 text-center">
                    <a href="#" class="btn btn-danger" onclick="doDelete('form1')">刪除</a>
                </div>
            </div>
            <div class="card-body">
                <form action="delete" method="post" name="form1" id="form1">
                    @csrf
                    <table class="table bolder border-dark">
                        <tr class="table table-info">
                            <td class="col-1 text-center border border-dark">
                                <input type="checkbox" id="all" class="form-check-input border border-dark">
                            </td>
                            <td class="col-1 text-center border border-dark">景點名稱</td>
                            <td class="col-1 text-center border border-dark">景點類別</td>
                            <td class="col-1 text-center border border-dark">地址</td>
                            <td class="col-2 text-center border border-dark">簡介</td>
                            <td class="col-2 text-center border border-dark">內容</td>
                            <td class="col-1 text-center border border-dark">電話</td>
                            <td class="col-1 text-center border border-dark">圖片</td>
                            <td class="col-1 text-center border border-dark">瀏覽數</td>
                            <td class="col-1 text-center border border-dark">修改/刪除</td>
                        </tr>
                        <tbody id="list">
                            @include("admin.views.getList")
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="card-footer d-flex justify-content-center mt-3">
            </div>
            <div class="p-1 mt-1">
                {{ $views->links() }}
            </div>
        </div>
    </div>
</div>
<script>
    doDelete(formId)
    {
        Swal.fire({
            title: "確定刪除?",
            icon: "question",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "確定",
            denyButtonText: "取消"
        }).then((result) => {
            if (result.isConfirmed) {
                document.forms[formId].submit();
            }
        });
    };
</script>
@endsection