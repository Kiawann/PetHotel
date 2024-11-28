@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4">Tambah Data Hewan</h2>

    <!-- Tampilkan pesan sukses jika ada -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Tampilkan pesan error jika ada -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('data_hewan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

       <!-- Pemilik -->
       <div class="form-group mb-3">
        <label for="id_data_pemilik">Pemilik Hewan</label>
        <input type="text" id="search_pemilik" class="form-control" placeholder="Ketik nama pemilik..." autocomplete="off">
        <input type="hidden" name="id_data_pemilik" id="id_data_pemilik">

        <div id="pemilik_list" class="list-group mt-1" style="position: absolute; z-index: 1000; width: 100%; display: none;">
            <!-- Hasil pencarian akan muncul di sini -->
        </div>
    </div>

        <!-- Kategori Hewan -->
        <div class="form-group mb-3">
            <label for="id_kategori_hewan">Kategori Hewan</label>
            <select name="id_kategori_hewan" id="id_kategori_hewan" class="form-control" required>
                <option value="">Pilih Kategori</option>
                @foreach ($kategori as $item)
                    <option value="{{ $item->id_kategori_hewan }}">{{ $item->nama_kategori }}</option>
                @endforeach
            </select>
        </div>

        <!-- Nama Hewan -->
        <div class="form-group mb-3">
            <label for="nama_hewan">Nama Hewan</label>
            <input type="text" name="nama_hewan" id="nama_hewan" class="form-control" placeholder="Masukkan Nama Hewan" required>
        </div>

        <!-- Umur -->
        <div class="form-group mb-3">
            <label for="umur">Umur (Tahun)</label>
            <input type="number" name="umur" id="umur" class="form-control" placeholder="Masukkan Umur Hewan" required>
        </div>

        <!-- Berat Badan -->
        <div class="form-group mb-3">
            <label for="berat_badan">Berat Badan</label>
            <input type="number" name="berat_badan" id="berat_badan" class="form-control" placeholder="Masukkan Berat Badan Hewan" required>
        </div>

        <!-- Warna -->
        <div class="form-group mb-3">
            <label for="warna">Warna</label>
            <input type="text" name="warna" id="warna" class="form-control" placeholder="Masukkan Warna Hewan" required>
        </div>

        <!-- Ras Hewan -->
        <div class="form-group mb-3">
            <label for="ras_hewan">Ras Hewan</label>
            <input type="text" name="ras_hewan" id="ras_hewan" class="form-control" placeholder="Masukkan Ras Hewan" required>
        </div>

        <!-- Jenis Kelamin -->
        <div class="form-group mb-3">
            <label for="jenis_kelamin">Jenis Kelamin</label>
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-control" required>
                <option value="">Pilih Jenis Kelamin</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
        </div>

        <!-- Foto -->
        <div class="form-group mb-3">
            <label for="foto">Foto Hewan</label>
            <input type="file" name="foto" id="foto" class="form-control" accept="image/*">
        </div>

        <!-- Tombol -->
        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{ route('data_hewan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Live search
        $('#search_pemilik').on('input', function () {
            let query = $(this).val();
            if (query.length > 1) { // Hanya cari jika input lebih dari 1 karakter
                $.ajax({
                    url: '{{ route("pemilik.search") }}',
                    method: 'GET',
                    data: { q: query },
                    success: function (response) {
                        let dropdown = $('#pemilik_list');
                        dropdown.empty();
                        if (response.length > 0) {
                            response.forEach(function (item) {
                                dropdown.append(`<a href="#" class="list-group-item list-group-item-action" data-id="${item.id_data_pemilik}">${item.nama} (ID: ${item.id_data_pemilik})</a>`);
                            });
                            dropdown.show();
                        } else {
                            dropdown.hide();
                        }
                    }
                });
            } else {
                $('#pemilik_list').hide();
            }
        });

        // Pilih pemilik dari hasil pencarian
        $(document).on('click', '#pemilik_list a', function (e) {
            e.preventDefault();
            let id = $(this).data('id');
            let name = $(this).text();
            $('#search_pemilik').val(name);
            $('#id_data_pemilik').val(id);
            $('#pemilik_list').hide();
        });

        // Klik di luar hasil pencarian untuk menyembunyikan
        $(document).on('click', function (e) {
            if (!$(e.target).closest('#pemilik_list, #search_pemilik').length) {
                $('#pemilik_list').hide();
            }
        });
    });
</script>
@endsection
