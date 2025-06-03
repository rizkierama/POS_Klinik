@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <div id="sidebar" class="w-64 h-screen fixed top-0 left-0 bg-blue-500 p-4 text-white transition-all duration-300 ease-in-out">
        <a href="/dashboard" class="flex items-center mb-6">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12">
            <span id="menuTitle" class="ml-2 text-lg font-bold">Klinik Azizi</span>
        </a>
        <button onclick="toggleSidebar()" class="absolute -right-6 top-4 bg-blue-700 text-white p-2 rounded-r-lg shadow-lg">
            ☰
        </button>
        <ul class="mt-4">
            <li class="mb-2 flex items-center p-2 rounded {{ Request::is('dashboard') ? 'bg-blue-700' : 'hover:bg-blue-600' }}">
                <a href="/dashboard" class="flex items-center w-full"><span class="icon">🏠</span><span class="menu-text ml-2">Dashboard</span></a>
            </li>
            <li class="mb-2 flex items-center p-2 rounded {{ Request::is('obat') ? 'bg-blue-700' : 'hover:bg-blue-600' }}">
                <a href="/obat" class="flex items-center w-full"><span class="icon">💊</span><span class="menu-text ml-2">Manajemen Obat</span></a>
            </li>
            <li class="mb-2 flex items-center p-2 rounded {{ Request::is('transaksi') ? 'bg-blue-700' : 'hover:bg-blue-600' }}">
                <a href="/transaksi" class="flex items-center w-full"><span class="icon">💰</span><span class="menu-text ml-2">Transaksi</span></a>
            </li>
            <li class="mb-2 flex items-center p-2 rounded {{ Request::is('laporan') ? 'bg-blue-700' : 'hover:bg-blue-600' }}">
                <a href="/laporan" class="flex items-center w-full"><span class="icon">📊</span><span class="menu-text ml-2">Laporan</span></a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="ml-64 p-6 w-full min-h-screen bg-gray-50">
        <div class="max-w-2xl mx-auto">
            <div class="bg-gradient-to-r from-blue-500 to-green-500 text-white text-center rounded-lg p-3 shadow-lg mb-2">
                <h1 class="text-3xl font-bold">Tambah Data Obat</h1>
                <p class="text-sm mt-2">Lengkapi informasi obat baru dengan benar.</p>
            </div>

            <div class="bg-white p-2 rounded-lg shadow-lg">
                <form action="{{ route('obat.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="nama_obat" class="block mb-2 text-sm font-medium text-gray-700">Nama Obat</label>
                        <input type="text" name="nama_obat" id="nama_obat" class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Masukkan nama obat" required>
                    </div>

                    <div>
                        <label for="stok" class="block mb-2 text-sm font-medium text-gray-700">Stok</label>
                        <input type="number" name="stok" id="stok" class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Jumlah stok tersedia" min="0" required>
                    </div>

                    <div>
                        <label for="harga" class="block mb-2 text-sm font-medium text-gray-700">Harga (Rp)</label>
                        <input type="number" name="harga" id="harga" class="w-full border border-gray-300 p-3 rounded-lg focus:ring-2 focus:ring-blue-400 focus:outline-none" placeholder="Harga satuan" min="0" required>
                    </div>

                    <div class="flex justify-center space-x-4">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full shadow-md transition-all">
                            Simpan
                        </button>
                        <a href="{{ route('obat.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white px-6 py-2 rounded-full shadow-md transition-all">
                            Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Script Sidebar -->
<script>
    function toggleSidebar() {
        let sidebar = document.getElementById("sidebar");
        let mainContent = document.getElementById("main-content");
        let menuTextElements = document.querySelectorAll(".menu-text");
        let menuTitle = document.getElementById("menuTitle");

        if (sidebar.classList.contains("w-64")) {
            sidebar.classList.remove("w-64", "p-4");
            sidebar.classList.add("w-16", "p-2");
            mainContent.classList.remove("ml-64");
            mainContent.classList.add("ml-16");
            menuTextElements.forEach(el => el.classList.add("hidden"));
            menuTitle.classList.add("hidden");
        } else {
            sidebar.classList.remove("w-16", "p-2");
            sidebar.classList.add("w-64", "p-4");
            mainContent.classList.remove("ml-16");
            mainContent.classList.add("ml-64");
            menuTextElements.forEach(el => el.classList.remove("hidden"));
            menuTitle.classList.remove("hidden");
        }
    }
</script>
@endsection
