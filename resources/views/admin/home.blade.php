@extends('admin.layout')
@section('title','Dashboard')
@section('content')

<h3 class="mb-4">Dashboard</h3>


<div class="row g-4">
    <div class="col-md-4">
        <div class="card dashboard-card">
            <div class="card-body d-flex align-items-center">
                <div class="card-icon bg-primary text-white me-3">
                    <i class="bi bi-people"></i>
                </div>
                <div>
                    <h6 class="text-muted">會員數量</h6>
                    <h3>1,280</h3>
                </div>
            </div>
        </div>
    </div>



    <div class="col-md-4">
        <div class="card dashboard-card">
            <div class="card-body d-flex align-items-center">
                <div class="card-icon bg-success text-white me-3">
                    <i class="bi bi-cart"></i>
                </div>
                <div>
                    <h6 class="text-muted">訂單數量</h6>
                    <h3>560</h3>
                </div>
            </div>
        </div>
    </div>



    <div class="col-md-4">
        <div class="card dashboard-card">
            <div class="card-body d-flex align-items-center">
                <div class="card-icon bg-warning text-white me-3">
                    <i class="bi bi-bar-chart"></i>
                </div>
                <div>
                    <h6 class="text-muted">今日訪問</h6>
                    <h3>3,420</h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection