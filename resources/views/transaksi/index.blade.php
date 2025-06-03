@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <div id="sidebar" class="w-64 h-screen fixed top-0 left-0 bg-blue-500 p-4 text-white transition-all duration-300 ease-in-out">
        <a href="/dashboard" class="flex items-center mb-4">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-12 h-12">
            <span id="menuTitle" class="ml-2 text-lg font-bold">Klinik Azizi</span>
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
    <div id="main-content" class="ml-64 p-6 transition-all duration-300 w-full">
        <h1 class="text-2xl font-bold mb-4">Manajemen Transaksi</h1>

        <div class="flex justify-between items-center mb-4">
            <a href="{{ route('transaksi.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                Tambah Transaksi
            </a>

            <div class="flex items-center space-x-2">
                <form action="{{ route('transaksi.index') }}" method="GET" class="flex items-center space-x-2">
                    <input 
                        type="text" 
                        name="search" 
                        placeholder="Cari transaksi obat..." 
                        value="{{ request('search') }}"
                        class="border border-gray-300 rounded px-3 py-1 focus:outline-none focus:ring focus:border-blue-300"
                    >
                    <button type="submit" class="bg-gray-700 text-white px-3 py-1 rounded">
                        Cari
                    </button>
                </form>

                <a href="{{ route('transaksi.index') }}" class="bg-gray-400 text-white px-3 py-1 rounded">
                    🔄
                </a>

                <!-- Pilihan jumlah baris -->
                <form action="{{ route('transaksi.index') }}" method="GET">
                    <select name="per_page" onchange="this.form.submit()" class="border border-gray-300 rounded  ">
                        @foreach([10, 25, 50, 100] as $size)
                            <option value="{{ $size }}" {{ request('per_page', 10) == $size ? 'selected' : '' }}>
                                {{ $size }} 
                            </option>
                        @endforeach
                    </select>
                </form>
            </div>
        </div>

        <div class="bg-white p-4 rounded-lg shadow">
            <table class="table-auto w-full border-collapse border">
                <thead class="bg-blue-500 text-white">
                    <tr>
                        <th class="px-4 py-2 border">No</th>
                        <th class="px-4 py-2 border">Nama Obat</th>
                        <th class="px-4 py-2 border">Jumlah</th>
                        <th class="px-4 py-2 border">Total Harga</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transaksis as $index => $transaksi)
                        <tr class="hover:bg-gray-100">
                            <td class="border px-4 py-2 text-center">{{ $transaksis->firstItem() + $index }}</td>
                            <td class="border px-4 py-2">
                                @foreach ($transaksi->details as $detail)
                                    <div>{{ $detail->obat->nama_obat }} ({{ $detail->jumlah }} x Rp. {{ number_format($detail->obat->harga, 0, ',', '.') }})</div>
                                @endforeach
                            </td>
                            <td class="border px-4 py-2 text-center">{{ $transaksi->details->sum('jumlah') }}</td>
                            <td class="border px-4 py-2 text-center">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2 text-center">
                                <a href="{{ route('transaksi.nota', $transaksi->id) }}" class="bg-green-500 text-white px-2 py-1 rounded">Nota</a>
                                <a href="{{ route('transaksi.nota.thermal', $transaksi->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded">Thermal</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $transaksis->appends(request()->except('page'))->links() }}
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

        // Toggle ukuran sidebar
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
