@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <div id="sidebar" class="w-64 h-screen fixed top-0 left-0 bg-blue-500 p-4 text-white transition-all duration-300 ease-in-out">
        <!-- Logo bisa diklik -->
        <a href="/dashboard" class="flex items-center mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12">
            <span id="menuTitle" class="ml-2 text-lg font-bold">Klinik Azizi</span>
        </a>

        <!-- Tombol Toggle -->
        <button id="toggleButton" onclick="toggleSidebar()" class="absolute -right-9 top-4 bg-blue-700 text-white p-2.5 rounded-r-lg shadow-lg">
            ☰
        </button>

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
    <div id="main-content" class="ml-64 p-6 transition-all duration-300 w-full">

        <!-- BAGIAN HEADER TAMBAHAN MULAI -->
        <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg mb-6 shadow">
            <div class="flex justify-between items-center">
                <div>
                    <div class="text-sm text-blue-100 mb-1">Dashboard / Home</div>
                    <h1 class="text-3xl font-bold">Selamat Datang, Mingyu!</h1>
                </div>
                <div>
                    <span class="text-sm text-white">
                        Hari ini: {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}
                    </span>
                </div>
            </div>
        </div>
        <!-- BAGIAN HEADER TAMBAHAN SELESAI -->

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mt-6">
    <div class="p-6 bg-gradient-to-r from-cyan-400 to-cyan-600 text-white rounded-lg shadow hover:shadow-lg transition-all">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-sm uppercase font-bold ">Jumlah Obat</h2>
                <p class="text-3xl font-bold mt-2 text-center">{{ $jumlahObat }}</p>
            </div>
            <div class="text-5xl opacity-30">
                💊
            </div>
        </div>
    </div>

    <div class="p-6 bg-gradient-to-r from-green-400 to-green-600 text-white rounded-lg shadow hover:shadow-lg transition-all">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-sm uppercase font-bold">Jumlah Transaksi</h2>
                <p class="text-3xl font-bold mt-2 text-center">{{ $jumlahTransaksi }}</p>
            </div>
            <div class="text-5xl opacity-30">
                💰
            </div>
        </div>
    </div>

    <div class="p-6 bg-gradient-to-r from-yellow-400 to-orange-500 text-white rounded-lg shadow hover:shadow-lg transition-all">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-sm uppercase font-bold">Total Penghasilan</h2>
                <p class="text-3xl font-bold mt-2">Rp {{ number_format($totalPenghasilan, 0, ',', '.') }}</p>
            </div>
            <div class="text-5xl opacity-30">
                📈
            </div>
        </div>
    </div>
</div>

    </div>
</div>

<!-- Script Toggle -->
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
