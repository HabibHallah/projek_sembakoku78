@extends('layouts/contentNavbarLayout')

@section('title', 'Input Data Barang')

@section('content')
<h4 class="py-3 mb-4">
  <span class="text-muted fw-light">Forms /</span> Input Data Barang
</h4>

<div class="row">
  <div class="col-md-6 mx-auto">
    <div class="card mb-4">
      <h5 class="card-header">Form Input Data Barang</h5>
      <div class="card-body">
        <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <!-- Nama Barang -->
          <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" placeholder="Masukkan nama barang" value="{{ old('nama_barang') }}" required>
            @error('nama_barang')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <!-- Stok -->
          <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="number" class="form-control" id="stok" name="stok" placeholder="Masukkan jumlah stok" min="1" value="{{ old('stok') }}" required>
            @error('stok')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <!-- Harga -->
          <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" placeholder="Masukkan harga barang" min="0" value="{{ old('harga') }}" required>
            @error('harga')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <!-- Status -->
          <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-select" id="status" name="status" required>
              <option selected disabled>Pilih status barang</option>
              <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Tersedia</option>
              <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Habis</option>
            </select>
            @error('status')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <!-- Upload Foto -->
          <div class="mb-3">
            <label for="foto" class="form-label">Upload Foto</label>
            <input class="form-control" type="file" id="foto" name="foto" accept="image/*" required>
            @error('foto')
              <div class="text-danger">{{ $message }}</div>
            @enderror
          </div>

          <!-- Tombol Submit -->
          <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
