@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
<h4 class="py-3 mb-4"><span class="text-muted fw-light">Tambah Data /</span> Tambah Data Barang
</h4>

<!-- Hoverable Table rows -->
<div class="card">
  <h5 class="card-header">Daftar Barang</h5>
  <div class="table-responsive text-nowrap">
      <table class="table table-hover">
          <thead>
              <tr>
                  <th>Nama Barang</th>
                  <th>Stok</th>
                  <th>Harga</th>
                  <th>Status</th>
                  <th>Foto</th>
                  <th>Aksi</th>
              </tr>
          </thead>
          <tbody>
              @forelse($barangs as $barang)
              <tr>
                  <td>{{ $barang->nama_barang }}</td>
                  <td>{{ $barang->stok }}</td>
                  <td>{{ number_format($barang->harga, 0, ',', '.') }}</td>
                  <td>
                      <span class="badge bg-{{ $barang->status == 'available' ? 'success' : 'danger' }}">
                          {{ ucfirst($barang->status) }}
                      </span>
                  </td>
                  <td>
                      @if($barang->foto)
                          <img src="{{ Storage::url($barang->foto) }}" alt="Foto Barang" class="rounded-circle" width="50" height="50">
                      @else
                          <span>Tidak ada foto</span>
                      @endif
                  </td>
                  <td>
                      <!-- Tombol aksi -->
                      <a href="{{ route('barang.edit', $barang->id) }}" class="btn btn-sm btn-primary">Edit</a>
                      <form action="{{ route('barang.destroy', $barang->id) }}" method="POST" style="display: inline;">
                          @csrf
                          @method('DELETE')
                          <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                      </form>
                  </td>
              </tr>
              @empty
              <tr>
                  <td colspan="6" class="text-center">Tidak ada data barang.</td>
              </tr>
              @endforelse
          </tbody>
      </table>
  </div>
</div>
<!--/ Hoverable Table rows -->
<div class="d-flex justify-content-end align-items-center mt-4 pe-3">
  <a href="{{ route('barang.create') }}" class="btn btn-success">Tambah Data Barang</a>
</div>

@endsection
