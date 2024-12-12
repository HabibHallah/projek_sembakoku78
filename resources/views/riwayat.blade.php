@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Riwayat Barang')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Riwayat /</span> Riwayat Transaksi
</h4>

<!-- Hoverable Table rows -->
<div class="card">
  <h5 class="card-header">Riwayat Transaksi</h5>
  <div class="table-responsive text-nowrap">
      <table class="table table-hover">
          <thead>
              <tr>
                  <th>Nama Barang</th>
                  <th>Jumlah</th>
                  <th>Total</th>
              </tr>
          </thead>
          <tbody>
              @forelse($riwayats as $riwayat)
              <tr>
                  <td>{{ $riwayat->barang->nama_barang }}</td>
                  <td>{{ $riwayat->jumlah }}</td>
                  <td>{{ number_format($riwayat->total, 0, ',', '.') }}</td>
              </tr>
              @empty
              <tr>
                  <td colspan="3" class="text-center">Tidak ada data riwayat.</td>
              </tr>
              @endforelse
          </tbody>
      </table>
  </div>
</div>
<!--/ Hoverable Table rows -->
@endsection
