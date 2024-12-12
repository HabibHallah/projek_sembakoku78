@extends('layouts/contentNavbarLayout')

@section('title', 'TambahData - Edit Barang')

@section('content')
<div class="card">
    <h5 class="card-header">Edit Barang</h5>
    <div class="card-body">
        <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nama_barang" class="form-label">Nama Barang</label>
                <input type="text" id="nama_barang" name="nama_barang" class="form-control" value="{{ old('nama_barang', $barang->nama_barang) }}" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" id="stok" name="stok" class="form-control" value="{{ old('stok', $barang->stok) }}" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" id="harga" name="harga" class="form-control" value="{{ old('harga', $barang->harga) }}" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-control" required>
                    <option value="available" {{ $barang->status == 'available' ? 'selected' : '' }}>Available</option>
                    <option value="unavailable" {{ $barang->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="foto" class="form-label">Foto</label>
                <input type="file" id="foto" name="foto" class="form-control">
                @if ($barang->foto)
                    <div class="mt-2">
                        <img src="{{ Storage::url($barang->foto) }}" alt="Foto Barang" class="img-thumbnail" width="100">
                    </div>
                @endif
            </div>
            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </form>
    </div>
</div>
@endsection
