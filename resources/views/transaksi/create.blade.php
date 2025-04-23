@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-4">Transaksi Kasir</h1>

    <form id="transaksiForm" action="{{ route('transaksi.store') }}" method="POST">
        @csrf
        <div id="itemsContainer" class="mb-4">
            <div class="item mb-2">
                <label for="obat_id" class="block text-sm font-medium text-gray-700">Pilih Obat</label>
                <select name="items[0][obat_id]" class="mt-1 block w-full" required>
                    <option value="">-- Pilih Obat --</option>
                    @foreach ($obats as $obat)
                        <option value="{{ $obat->id }}">{{ $obat->nama_obat }} (Stok: {{ $obat->stok }})</option>
                    @endforeach
                </select>
                <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                <input type="number" name="items[0][jumlah]" class="mt-1 block w-full" required>
            </div>
        </div>
        <button type="button" id="addItem" class="bg-green-500 text-white px-4 py-2 rounded">Tambah Item</button>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan Transaksi</button>
    </form>
</div>

<script>
    let itemIndex = 1;
    const obatOptions = `{!! json_encode($obats->map(fn($obat) => ['id' => $obat->id, 'nama' => $obat->nama_obat, 'stok' => $obat->stok])) !!}`;

    document.getElementById('addItem').addEventListener('click', function () {
        const container = document.getElementById('itemsContainer');
        const options = JSON.parse(obatOptions).map(obat => 
            `<option value="${obat.id}">${obat.nama} (Stok: ${obat.stok})</option>`
        ).join('');

        const itemHTML = `
            <div class="item mb-2">
                <label class="block text-sm font-medium text-gray-700">Pilih Obat</label>
                <select name="items[${itemIndex}][obat_id]" class="mt-1 block w-full" required>
                    <option value="">-- Pilih Obat --</option>
                    ${options}
                </select>
                <label class="block text-sm font-medium text-gray-700">Jumlah</label>
                <input type="number" name="items[${itemIndex}][jumlah]" class="mt-1 block w-full" required>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', itemHTML);
        itemIndex++;
    });
</script>

@endsection