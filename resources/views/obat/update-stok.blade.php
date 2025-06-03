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
        <button id="toggleButton" onclick="toggleSidebar()" class="absolute -right-6 top-4 bg-blue-700 text-white p-2 rounded-r-lg shadow-lg">
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
        <h1 class="text-3xl font-bold mb-6 text-blue-700">Update Stok Obat</h1>

        <!-- Tombol Kembali dan Search dalam 1 garis -->
        <!-- Flex Container -->
<div class="flex justify-between items-center mb-6">
    
    <!-- Tombol Kembali di kiri -->
    <a href="{{ route('obat.index') }}" class="inline-block bg-gray-500 hover:bg-gray-700 text-white px-6 py-2 rounded-lg shadow-md transition">
        ← Kembali ke Manajemen Obat
    </a>

    <!-- Form Search di kanan -->
    <form method="GET" action="{{ route('obat.updateStok') }}" class="flex space-x-2">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama obat..." class="border p-2 rounded-lg shadow w-64">
        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow">
            Cari
        </button>

        @if(request('search'))
        <a href="{{ route('obat.updateStok') }}" class="bg-gray-400 hover:bg-gray-500 text-white px-4 py-2 rounded-lg shadow inline-block">
            Reset
        </a>
        @endif
    </form>

</div>


        <!-- Notifikasi sukses -->
        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded-lg mb-6 shadow-md">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Update Stok -->
        <div class="overflow-x-auto bg-white p-6 rounded-lg shadow-md">
            <table class="min-w-full table-auto">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">No</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Nama Obat</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Stok Saat Ini</th>
                        <th class="px-6 py-3 text-left text-sm font-semibold uppercase">Tambah / Kurangi Stok</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @forelse ($obats as $obat)
                        <tr class="border-b hover:bg-gray-100 border-blue-500">
                            <td class="px-6 py-4">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4">{{ $obat->nama_obat }}</td>
                            <td class="px-6 py-4">{{ $obat->stok }}</td>
                            <td class="px-6 py-4">
                                <form action="{{ route('obat.updateStokProses', $obat->id) }}" method="POST" class="flex flex-wrap gap-2 items-center">
                                    @csrf
                                    <input type="number" name="jumlah" placeholder="0" required class="w-20 border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                    <select name="tipe" class="border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500">
                                        <option value="tambah">Tambah</option>
                                        <option value="kurangi">Kurangi</option>
                                    </select>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg shadow-md transition">
                                        Update
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-gray-500">
                                Tidak ada data obat ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Script Toggle Sidebar -->
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
