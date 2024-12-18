@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
<div class="row gy-4">
  <!-- Congratulations card -->
  <div class="col-md-12 col-lg-4">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-1">Selamat Datang 🎉</h4>
        <p class="pb-0">Pantau Penjualan Anda</p>
        <h4 class="text-primary mb-1">Data Penjualan 🚀</h4>
        <p class="mb-2 pb-1">Admin</p>
        <a href="/cards/basic" class="btn btn-sm btn-primary">Lihat Transaksi</a>
      </div>
      <img src="{{asset('assets/img/icons/misc/triangle-light.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0" width="166" alt="triangle background">
      <img src="{{asset('assets/img/illustrations/trophy.png')}}" class="scaleX-n1-rtl position-absolute bottom-0 end-0 me-4 mb-4 pb-2" width="83" alt="view sales">
    </div>
  </div>
  <!--/ Congratulations card -->

  <!-- Transactions -->
  <div class="col-lg-8">
    <div class="card">
      <div class="card-header">
        <div class="d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Transaksi</h5>
        </div>
        <p class="mt-3"><span class="fw-medium">Data Penjualan</span> 😎</p>
      </div>
      <div class="card-body">
        <div class="row g-3">
          <div class="col-md-3 col-6 mb-1 mx-5">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-primary rounded shadow">
                  <i class="mdi mdi-trending-up mdi-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <div class="small mb-1">Transaksi</div>
                <h5 class="mb-0">{{ number_format($totalSales, 2, ',', '.') }}</h5>
              </div>
            </div>
          </div>
          <div class="col-md-3 col-6 mb-1 mx-5">
            <div class="d-flex align-items-center">
              <div class="avatar">
                <div class="avatar-initial bg-warning rounded shadow">
                  <i class="mdi mdi-cellphone-link mdi-24px"></i>
                </div>
              </div>
              <div class="ms-3">
                <div class="small mb-1">Produk</div>
                <h5 class="mb-0">{{ $totalJenisBarang }}</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--/ Transactions -->
</div>
@endsection
