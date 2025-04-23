@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Tambah Obat</h1>

    <form action="{{ route('obat.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="nama_obat" class="block text-sm font-medium text-gray-700">Nama Obat</label>
            <input type="text" name="nama_obat" id="nama_obat" class="mt-1 block w-full" required>
        </div>

        <div class="mb-4">
            <label for="stok" class="block text-sm font-medium text-gray-700">Stok</label>
            <input type="number" name="stok" id="stok" class="mt-1 block w-full" required>
        </div>

        <div class="mb-4">
            <label for="harga" class="block text-sm font-medium text-gray-700">Harga</label>
            <input type="number" name="harga" id="harga" class="mt-1 block w-full" required>
        </div>

        <div class="flex space-x-2">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('obat.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Kembali</a>
        </div>
    </form>
</div>
@endsection
