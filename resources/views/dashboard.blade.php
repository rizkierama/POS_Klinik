@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
<div id="sidebar" class="w-64 h-screen fixed top-0 left-0 bg-blue-500 p-4 text-white transition-all duration-300 ease-in-out">
    <!-- Logo bisa diklik -->
    <a href="/dashboard" class="flex items-center mb-4">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12">
        <span id="menuTitle" class="ml-2 text-lg font-bold">Menu</span>
    </a>

    <!-- Tombol Toggle -->
    <button id="toggleButton" onclick="toggleSidebar()" class="absolute -right-6 top-4 bg-blue-700 text-white p-2 rounded-r-lg shadow-lg">
        ☰
    </button>

    <ul>
    <li class="mb-2 flex items-center hover:bg-blue-600 p-2 rounded">
        <a href="/dashboard" class="flex items-center w-full">
            <span class="icon">🏠</span>
            <span class="menu-text ml-2">Dashboard</span>
        </a>
    </li>
    <li class="mb-2 flex items-center hover:bg-blue-600 p-2 rounded">
        <a href="/obat" class="flex items-center w-full">
            <span class="icon">💊</span>
            <span class="menu-text ml-2">Manajemen Obat</span>
        </a>
    </li>
    <li class="mb-2 flex items-center hover:bg-blue-600 p-2 rounded">
        <a href="/transaksi" class="flex items-center w-full">
            <span class="icon">💰</span>
            <span class="menu-text ml-2">Transaksi</span>
        </a>
    </li>
    <li class="mb-2 flex items-center hover:bg-blue-600 p-2 rounded">
        <a href="/laporan" class="flex items-center w-full">
            <span class="icon">📊</span>
            <span class="menu-text ml-2">Laporan</span>
        </a>
    </li>
</ul>

</div>

    <!-- Main Content -->
<div id="main-content" class="ml-64 p-6 transition-all duration-300 w-full">
    <h1 class="text-2xl font-bold mb-4">Dashboard</h1>
    <p>Selamat datang di sistem manajemen obat.</p>

    <div class="grid grid-cols-3 gap-4 mt-6">
        <div class="p-4 bg-white shadow rounded-lg">
            <h2 class="text-lg font-semibold">Jumlah Obat</h2>
            <p class="text-2xl">{{ $jumlahObat }}</p>
        </div>
        <div class="p-4 bg-white shadow rounded-lg">
            <h2 class="text-lg font-semibold">Jumlah Transaksi</h2>
            <p class="text-2xl">{{ $jumlahTransaksi }}</p>
        </div>
        <div class="p-4 bg-white shadow rounded-lg">
            <h2 class="text-lg font-semibold">Total Penghasilan</h2>
            <p class="text-2xl">Rp {{ number_format($totalPenghasilan, 0, ',', '.') }}</p>
        </div>
    </div>
</div>

</div>

<script>
    function toggleSidebar() {
        let sidebar = document.getElementById("sidebar");
        let mainContent = document.getElementById("main-content");
        let menuTextElements = document.querySelectorAll(".menu-text");
        let menuTitle = document.getElementById("menuTitle");

        if (sidebar.classList.contains("w-64")) {
            // Sidebar kecil
            sidebar.classList.remove("w-64", "p-4");
            sidebar.classList.add("w-16", "p-2");

            mainContent.classList.remove("ml-64");
            mainContent.classList.add("ml-16");

            menuTextElements.forEach(el => el.classList.add("hidden"));
            menuTitle.classList.add("hidden");
        } else {
            // Sidebar besar
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
