@extends('admin.layout')
@section('title', '會員管理')
@section('content')

<div class="card">
    <div class="card-header position-relative text-center">
        <h1 class="display-5 fw-bold mb-0">會員管理</h1> <a href="#" class="btn btn-danger position-absolute top-50 end-0 translate-middle-y me-3" onclick="doDelete('form1')">刪除</a>
    </div>

    <div class="card-body">
        <form action="delete" method="post" name="form1" id="form1">
            @csrf
            <div class="table-responsive">
                <table class="table table-bordered border-dark text-center align-middle mb-0">
                    <thead>
                        <tr class="table-info">
                            <th class="col-1">
                                <input type="checkbox" id="all" class="form-check-input border-dark">
                            </th>
                            <th class="col-1">id</th>
                            <th class="col-2">會員名稱</th>
                            <th class="col-2">電子信箱</th>
                            <th class="col-1">狀態</th>
                            <th class="col-2">建立時間</th>
                            <th class="col-2">更新時間</th>
                            <th class="col-1">修改/刪除</th>
                        </tr>
                    </thead>
                    <tbody id="list">
                        @include("admin.member.getList")
                    </tbody>
                </table>
            </div>
        </form>
    </div>

    <div class="card-footer d-flex justify-content-center">
        {{ $members->links() }}
    </div>

</div>
<script>
    function doDelete() {
        // 所有name=id[]有被選取
        let ids = $("input[name='id[]']:checked").map(function() {
            /* 
                this: 被選取的checkbox
                val(): 值(jquery取值的方法)
            */
            return $(this).val();
        }).get(); // 轉成javascript的陣列

        // 陣列長度小於等於0(沒有任何資料被選取)
        if (ids.length <= 0) {
            Swal.fire("請選取要刪除的資料");
            return;
        }

        Swal.fire({
            title: "確定刪除?",
            icon: "question",
            showDenyButton: true,
            showCancelButton: false,
            confirmButtonText: "確定",
            denyButtonText: "取消"
        }).then((result) => {
            console.log(ids);
            if (result.isConfirmed) {
                // let formElement = document.getElementById('form1');
                // let formData = new FormData(formElement);
                axios.delete('/admin/member/delete', {
                        data: {
                            ids: ids
                        }
                    })
                    .then(function(response) {
                        Swal.fire({
                            title: response.data.message,
                            icon: 'success',
                            confirmButtonText: "確定",
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location.href = "/admin/member/list";
                            };
                        });
                    })
                    .catch(function(error) {
                        console.log(error);
                        Swal.fire({
                            title: error.response.data.message,
                            icon: 'error',
                            confirmButtonText: "確定",
                        })
                    })
                    .finally(function() {
                        // always executed
                    });
            }
        });
    };
</script>
@endsection