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
        <h1 class="text-2xl font-bold mb-4">Manajemen Obat</h1>

        <!-- ISI HALAMAN OBAT -->
        <div class="flex justify-between items-center mb-4">
            <div class="flex space-x-2">
                <a href="{{ route('obat.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow">Tambah Obat</a>
                <a href="{{ route('obat.updateStok') }}" class="bg-green-500 text-white px-4 py-2 rounded shadow">Update Stok</a>
                <a href="{{ route('obat.index', ['per_page' => request('per_page', 10)]) }}" class="bg-gray-500 text-white px-4 py-2 rounded shadow">
                    Refresh
                </a>
            </div>

            <div class="flex space-x-2">
                <form method="GET" action="{{ route('obat.index') }}" class="flex space-x-2">
                    <input type="hidden" name="per_page" value="{{ request('per_page', 10) }}"> <!-- Tambahkan ini -->

                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari obat..." class="border p-2 rounded shadow w-52">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow">Cari</button>
                </form>

                <form method="GET" action="{{ route('obat.index') }}">
    <input type="hidden" name="search" value="{{ request('search') }}"> <!-- Tambahkan ini -->

    <select name="per_page" onchange="this.form.submit()" class="border rounded shadow bg-white">
        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
        <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
    </select>
</form>

            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mb-6 shadow">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white p-4 rounded-lg shadow">
            @if ($obats->count() > 0)
            <table class="table-auto w-full border-collapse border mt-4">
                <thead>
                    <tr class="bg-blue-500 text-white">
                        <th class="border p-2">No</th>
                        <th class="px-4 py-2 border">Nama Obat</th>
                        <th class="px-4 py-2 border">Stok</th>
                        <th class="px-4 py-2 border">Harga</th>
                        <th class="px-4 py-2 border">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($obats as $obat)
                        <tr class="hover:bg-gray-100">
                            <td class="border p-2 text-center">{{ $obats->firstItem() + $loop->index }}</td>
                            <td class="border px-4 py-2">{{ $obat->nama_obat }}</td>
                            <td class="border px-4 py-2">{{ $obat->stok }}</td>
                            <td class="border px-4 py-2">Rp {{ number_format($obat->harga, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('obat.edit', $obat) }}" class="bg-yellow-500 text-white px-2 py-1.5 rounded shadow">Edit</a>
                                <form action="{{ route('obat.destroy', $obat) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded shadow" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $obats->appends(request()->query())->links() }}
            </div>

            @else
            <!-- Kalau hasil pencarian kosong -->
            <div class="text-center text-gray-500 py-12">
                <h2 class="text-xl font-bold mb-2">Tidak ada obat ditemukan.</h2>
                <p class="text-sm">Coba gunakan kata kunci lain atau klik tombol Refresh.</p>
                <a href="{{ route('obat.index') }}" class="inline-block mt-4 bg-gray-500 hover:bg-gray-700 text-white px-6 py-2 rounded-lg shadow">
                    Refresh Data
                </a>
            </div>
            @endif
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
