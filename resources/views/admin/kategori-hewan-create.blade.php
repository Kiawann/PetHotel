@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Kategori Hewan</h1>

        <form action="{{ route('kategori_hewan.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="nama_kategori">Nama Kategori Hewan</label>
                <input type="text" name="nama_kategori" class="form-control" id="nama_kategori" value="{{ old('nama_kategori') }}" required>
                @error('nama_kategori')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
@endsection
