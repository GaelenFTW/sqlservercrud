@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Karyawan</h2>
    <form action="{{ route('karyawan.update', $karyawan->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" value="{{ $karyawan->nama }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" value="{{ $karyawan->alamat }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>No. Telp</label>
            <input type="text" name="no_telp" value="{{ $karyawan->no_telp }}" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Jabatan</label>
            <input type="text" name="jabatan" value="{{ $karyawan->jabatan }}" class="form-control" required>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('karyawan.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
