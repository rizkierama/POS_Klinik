@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <div id="sidebar" class="w-64 h-screen fixed top-0 left-0 bg-blue-500 p-4 text-white transition-all duration-300 ease-in-out">
        <a href="/dashboard" class="flex items-center mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12">
            <span id="menuTitle" class="ml-2 text-lg font-bold">Menu</span>
        </a>
        <button onclick="toggleSidebar()" class="absolute -right-6 top-4 bg-blue-700 text-white p-2 rounded-r-lg shadow-lg">☰</button>
        <ul>
            <li class="mb-2 flex items-center p-2 rounded {{ Request::is('dashboard') ? 'bg-blue-700' : 'hover:bg-blue-600' }}">
                <a href="/dashboard" class="flex items-center w-full">
                    <span class="icon">🏠</span>
                    <span class="menu-text ml-2">Dashboard</span>
                </a>
            </li>
            <li class="mb-2 flex items-center p-2 rounded {{ Request::is('obat') ? 'bg-blue-700' : 'hover:bg-blue-600' }}">
                <a href="/obat" class="flex items-center w-full">
                    <span class="icon">💊</span>
                    <span class="menu-text ml-2">Manajemen Obat</span>
                </a>
            </li>
            <li class="mb-2 flex items-center p-2 rounded {{ Request::is('transaksi') ? 'bg-blue-700' : 'hover:bg-blue-600' }}">
                <a href="/transaksi" class="flex items-center w-full">
                    <span class="icon">💰</span>
                    <span class="menu-text ml-2">Transaksi</span>
                </a>
            </li>
            <li class="mb-2 flex items-center p-2 rounded {{ Request::is('laporan') ? 'bg-blue-700' : 'hover:bg-blue-600' }}">
                <a href="/laporan" class="flex items-center w-full">
                    <span class="icon">📊</span>
                    <span class="menu-text ml-2">Laporan</span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="ml-64 p-6 transition-all duration-300 w-full min-h-screen bg-gray-50">
        <div class="max-w-3xl mx-auto">
            <div class="bg-white p-8 rounded-xl shadow-lg">
                <h1 class="text-3xl font-bold text-center text-blue-700 mb-8">Transaksi Kasir</h1>

                <form id="transaksiForm" action="{{ route('transaksi.store') }}" method="POST" class="space-y-6">
                    @csrf
                    <div id="itemsContainer" class="space-y-6">
                        <!-- Item pertama -->
                        <div class="item grid grid-cols-12 gap-4 items-end" id="item-0">
                            <div class="col-span-6">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Obat</label>
                                <input list="obatList" class="obat-input w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Ketik nama obat..." autocomplete="off">
                                <input type="hidden" name="items[0][obat_id]" class="obat-id">
                                <datalist id="obatList">
                                @foreach ($obats as $obat)
                                    <option 
                                        value="{{ $obat->nama_obat }} (Stok: {{ $obat->stok }})"
                                        data-id="{{ $obat->id }}"
                                        data-stok="{{ $obat->stok }}">
                                    </option>
                                @endforeach
                                </datalist>
                            </div>
                            <div class="col-span-4">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                                <input type="number" name="items[0][jumlah]" class="jumlah-input w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required min="1">
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-4 justify-center mt-6">
                        <button type="button" id="addItem" class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                            + Tambah Item
                        </button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg shadow transition">
                            Simpan Transaksi
                        </button>
                        <button type="button" name="cetak_pdf" value="true" class="bg-gray-500 text-white px-4 py-2 rounded shadow">
                            <a href="{{ route('transaksi.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded shadow">
                                Kembali
                            </a>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Scripts -->
<script>
    let itemIndex = 1;
    const obatOptions = {!! json_encode($obatListJson) !!};
    
    function toggleSidebar() {
        let sidebar = document.getElementById("sidebar");
        let mainContent = document.getElementById("main-content");
        let menuTextElements = document.querySelectorAll(".menu-text");
        let menuTitle = document.getElementById("menuTitle");

        sidebar.classList.toggle("w-64");
        sidebar.classList.toggle("w-16");
        sidebar.classList.toggle("p-4");
        sidebar.classList.toggle("p-2");
        mainContent.classList.toggle("ml-64");
        mainContent.classList.toggle("ml-16");

        menuTextElements.forEach(el => el.classList.toggle("hidden"));
        menuTitle.classList.toggle("hidden");
    }

    // Tambah item obat
    document.getElementById('addItem').addEventListener('click', function () {
        const container = document.getElementById('itemsContainer');
        const datalistId = `obatList-${itemIndex}`;

        const options = obatOptions.map(obat =>
            `<option value="${obat.nama} (Stok: ${obat.stok})" data-id="${obat.id}" data-stok="${obat.stok}"></option>`
        ).join('');

        const itemHTML = `
            <div class="item grid grid-cols-12 gap-4 items-end" id="item-${itemIndex}">
                <div class="col-span-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilih Obat</label>
                    <input list="${datalistId}" class="obat-input w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Ketik nama obat..." autocomplete="off">
                    <input type="hidden" name="items[${itemIndex}][obat_id]" class="obat-id">
                    <datalist id="${datalistId}">
                        ${options}
                    </datalist>
                </div>
                <div class="col-span-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah</label>
                    <input type="number" name="items[${itemIndex}][jumlah]" class="jumlah-input w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500" required min="1">
                </div>
                <div class="col-span-2 flex justify-end">
                    <button type="button" onclick="removeItem(${itemIndex})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow transition">&times;</button>
                </div>
            </div>
        `;

        container.insertAdjacentHTML('beforeend', itemHTML);
        itemIndex++;
    });

    function removeItem(index) {
        const item = document.getElementById(`item-${index}`);
        if (item) item.remove();
    }

    // Validasi input jumlah vs stok
    document.addEventListener('input', function (e) {
        if (e.target.classList.contains('jumlah-input')) {
            const jumlahInput = e.target;
            const container = jumlahInput.closest('.item');
            const input = container.querySelector('.obat-input');
            const options = container.querySelectorAll('datalist option');
            const selectedOption = [...options].find(opt =>
                input.value.startsWith(opt.value.split(' (Stok:')[0])
            );
            const stok = parseInt(selectedOption?.dataset?.stok || 0);
            const val = parseInt(jumlahInput.value || 0);

            if (val > stok) {
                alert(`Stok tidak cukup! Maksimal hanya ${stok}`);
                jumlahInput.value = stok > 0 ? stok : 0;
            }
        }
    });

    // Validasi akhir sebelum submit
    document.getElementById('transaksiForm').addEventListener('submit', function (e) {
        let isValid = true;

        document.querySelectorAll('.item').forEach(item => {
            const input = item.querySelector('.obat-input');
            const hidden = item.querySelector('.obat-id');
            const jumlah = item.querySelector('.jumlah-input');
            const options = item.querySelectorAll('datalist option');
            const selected = [...options].find(opt =>
                input.value.startsWith(opt.value.split(' (Stok:')[0])
            );
            const stok = parseInt(selected?.dataset?.stok || 0);
            const obatId = selected?.dataset?.id;

            if (!obatId || parseInt(jumlah.value) > stok) {
                isValid = false;
                alert(`Jumlah melebihi stok untuk obat: ${input.value}`);
            } else {
                hidden.value = obatId;
            }
        });

        if (!isValid) e.preventDefault();
    });
</script>

@endsection
