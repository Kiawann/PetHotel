@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="text-center mb-4">Kategori Hewan</h1>

        <a href="{{ route('kategori_hewan.create') }}" class="btn btn-primary mb-3">Tambah Kategori Hewan</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nama Kategori Hewan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kategori_hewan as $kategori)
                        <tr>
                            <td>{{ $kategori->id_kategori_hewan }}</td>
                            <td>{{ $kategori->nama_kategori }}</td>
                            <td>
                                <a href="{{ route('kategori_hewan.edit', $kategori->id_kategori_hewan) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('kategori_hewan.destroy', $kategori->id_kategori_hewan) }}" method="POST" style="display:inline;">
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
    </div>
@endsection
