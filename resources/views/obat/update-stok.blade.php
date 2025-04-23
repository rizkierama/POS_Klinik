@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Update Stok Obat</h1>

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <table class="table-auto w-full">
        <thead>
            <tr>
                <th class="px-4 py-2">Nama Obat</th>
                <th class="px-4 py-2">Stok Saat Ini</th>
                <th class="px-4 py-2">Tambah/Kurangi Stok</th>
                
            </tr>
        </thead>
        <tbody>
            @foreach ($obats as $obat)
                <tr>
                    <td class="border px-4 py-2">{{ $obat->nama_obat }}</td>
                    <td class="border px-4 py-2">{{ $obat->stok }}</td>
                    <td class="border px-4 py-2">
                        <form action="{{ route('obat.updateStokProses', $obat->id) }}" method="POST" class="flex space-x-2">
                            @csrf
                            @method('POST')
                            <input type="number" name="jumlah" class="border px-2 py-1 w-20" placeholder="0" required>
                            <select name="tipe" class="border px-7 py-1">
                                <option value="tambah">Tambah</option>
                                <option value="kurangi">Kurangi</option>
                            </select>
                            <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded">Update</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <br>
    <div class="mb-4">
    <a href="{{ route('obat.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-700">
        ← Kembali ke Manajemen Obat
    </a>
</div>
</div>
@endsection
