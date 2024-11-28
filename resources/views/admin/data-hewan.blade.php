@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Data Hewan</h1>
    <a href="{{ route('data_hewan.create') }}" class="btn btn-primary mb-3">Tambah Data Hewan</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Data Hewan</th>
                <th>Nama Pemilik</th>
                <th>Nama Kategori Hewan</th>
                <th>Nama Hewan</th>
                <th>Umur</th>
                <th>Berat Badan</th>
                <th>Warna</th>
                <th>Ras Hewan</th>
                <th>Jenis Kelamin</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_hewan as $hewan)
            <tr>
                <td>{{ $hewan->id_data_hewan }}</td> <!-- ID Data Hewan -->
                <td>{{ $hewan->pemilik->nama ?? 'Tidak Ditemukan' }}</td> <!-- Nama Pemilik -->
                <td>{{ $hewan->kategori->nama_kategori ?? 'Tidak Ditemukan' }}</td> <!-- Nama Kategori Hewan -->
                <td>{{ $hewan->nama_hewan }}</td> <!-- Nama Hewan -->
                <td>{{ $hewan->umur }}</td> <!-- Umur -->
                <td>{{ $hewan->berat_badan }}</td> <!-- Berat Badan -->
                <td>{{ $hewan->warna }}</td> <!-- Warna -->
                <td>{{ $hewan->ras_hewan }}</td> <!-- Ras Hewan -->
                <td>{{ $hewan->jenis_kelamin == 'L' ? 'Laki-laki' : 'Perempuan' }}</td> <!-- Jenis Kelamin -->
                <td>
                    @if ($hewan->foto)
                        <img src="{{ asset('storage/' . $hewan->foto) }}" alt="Foto Hewan" width="100">
                    @else
                        Tidak ada foto
                    @endif
                </td> <!-- Foto Hewan -->
                <td>
                    <a href="{{ route('data_hewan.edit', $hewan->id_data_hewan) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('data_hewan.destroy', $hewan->id_data_hewan) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
