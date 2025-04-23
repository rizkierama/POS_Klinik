@extends('layouts.app')

@section('content')
<div class="flex">
    <!-- Sidebar -->
    <div id="sidebar" class="w-1/5 bg-blue-500 min-h-screen p-4 text-white fixed left-0 top-0 h-full">
        <!-- Tombol Toggle Sidebar -->
        <button onclick="toggleSidebar()" class="absolute right-[-40px] top-4 bg-blue-500 text-white p-2 rounded-r-lg">
            ☰
        </button>

        <h2 class="text-lg font-bold mb-4">Menu</h2>
        <ul>
            <li class="mb-2 hover:bg-blue-600 p-2 rounded"><a href="/dashboard" class="flex items-center space-x-2"><span>🏠</span><span>Dashboard</span></a></li>
            <li class="mb-2 hover:bg-blue-600 p-2 rounded"><a href="/obat" class="flex items-center space-x-2"><span>💊</span><span>Manajemen Obat</span></a></li>
            <li class="mb-2 hover:bg-blue-600 p-2 rounded"><a href="/transaksi" class="flex items-center space-x-2"><span>💰</span><span>Transaksi</span></a></li>
            <li class="mb-2 hover:bg-blue-600 p-2 rounded"><a href="/laporan" class="flex items-center space-x-2"><span>📊</span><span>Laporan</span></a></li>
        </ul>
    </div>

    <!-- Main Content -->
    <div id="main-content" class="w-4/5 p-6 ml-[20%] transition-all duration-300 ease-in-out">
        <h1 class="text-2xl font-bold mb-4">Manajemen Obat</h1>

        <div class="flex justify-between items-center mb-4">
    <div class="flex space-x-2">
        <!-- Tombol Tambah & Update -->
        <a href="{{ route('obat.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded shadow">Tambah Obat</a>
        <a href="{{ route('obat.updateStok')}}" class="bg-green-500 text-white px-4 py-2 rounded shadow">Update Stok </a>
    </div>

    <div class="flex space-x-2">
        <!-- Form Pencarian -->
        <form method="GET" action="{{ route('obat.index') }}" class="flex space-x-2">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari obat..."
                class="border p-2 rounded shadow w-52">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow">Cari</button>
        </form>

        <!-- Pilihan Jumlah Data per Halaman -->
        <form method="GET" action="{{ route('obat.index') }}">
            <select name="per_page" onchange="this.form.submit()"
                class="border rounded shadow bg-white">
                <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
            </select>
        </form>
    </div>
</div>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mt-4 shadow">
                {{ session('success') }}
            </div>
        @endif

        <!-- Table -->
        <div class="bg-white p-4 rounded-lg shadow">
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
                            <td class="border px-4 py-2">Rp. {{ number_format($obat->harga, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2">
                                <a href="{{ route('obat.edit', $obat) }}" class="bg-yellow-500 text-white px-2 py-1 rounded shadow">Edit</a>
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
                {{ $obats->links() }}
            </div>
        </div>
    </div>
</div>

<script>
    function toggleSidebar() {
        let sidebar = document.getElementById("sidebar");
        let mainContent = document.getElementById("main-content");

        if (sidebar.classList.contains("translate-x-0")) {
            sidebar.classList.remove("translate-x-0");
            sidebar.classList.add("-translate-x-full");
            mainContent.classList.remove("ml-[20%]");
            mainContent.classList.add("ml-0");
        } else {
            sidebar.classList.remove("-translate-x-full");
            sidebar.classList.add("translate-x-0");
            mainContent.classList.remove("ml-0");
            mainContent.classList.add("ml-[20%]");
        }
    }
</script>
@endsection
