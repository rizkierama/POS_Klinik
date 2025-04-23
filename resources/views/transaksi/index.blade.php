@extends('layouts.app')

@section('content')

<div class="flex">
    <!-- Sidebar -->
    <div id="sidebar" class="w-1/5 bg-blue-500 min-h-screen p-4 text-white transition-all duration-300 ease-in-out fixed left-0 top-0 h-full transform translate-x-0">
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
    <div id="main-content" class="w-4/5 p-6 transition-all duration-300 ease-in-out ml-[20%]">
        <h1 class="text-2xl font-bold mb-4">Manajemen Transaksi</h1>

        <div class="flex space-x-2 mb-4">
            <a href="{{ route('transaksi.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Tambah Transaksi</a>
        </div>

        @if (session('success'))
            <div class="bg-green-500 text-white p-4 rounded mt-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="table-auto w-full mt-4 border border-gray-300 shadow-md bg-white">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-2 border">Nama Obat</th>
                    <th class="px-4 py-2 border">Jumlah</th>
                    <th class="px-4 py-2 border">Total Harga</th>
                    <th class="px-4 py-2 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksis as $transaksi)
                    <tr class="hover:bg-gray-100">
                        <td class="border px-4 py-2">
                            @foreach ($transaksi->details as $detail)
                                <div>{{ $detail->obat->nama_obat }} (  {{ $detail->jumlah }} x Rp. {{ number_format($detail->obat->harga, 0, ',', '.') }})<br>                                </div>
                            @endforeach
                        </td>
                        <td class="border px-4 py-2 text-center">{{ $transaksi->details->sum('jumlah') }}</td>
                        <td class="border px-4 py-2 text-center">Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}</td>
                        <td class="border px-4 py-2 text-center">
                            <form action="{{ route('transaksi.destroy', $transaksi) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-2 py-1 rounded" onclick="return confirm('Apakah Anda yakin?')">Hapus</button>
                            </form>
                            <a href="{{ route('transaksi.nota', $transaksi->id) }}" class="bg-green-500 text-white px-2 py-1 rounded ml-2" target="_blank">Cetak Nota</a>
                            <a href="{{ route('transaksi.nota.thermal', $transaksi->id) }}" class="bg-blue-500 text-white px-2 py-1 rounded ml-2">Cetak Thermal</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    function toggleSidebar() {
        let sidebar = document.getElementById("sidebar");
        let mainContent = document.getElementById("main-content");

        if (sidebar.classList.contains("translate-x-0")) {
            sidebar.classList.remove("translate-x-0");
            sidebar.classList.add("translate-x-[-100%]");
            mainContent.classList.remove("ml-[20%]");
            mainContent.classList.add("ml-0");
        } else {
            sidebar.classList.remove("translate-x-[-100%]");
            sidebar.classList.add("translate-x-0");
            mainContent.classList.remove("ml-0");
            mainContent.classList.add("ml-[20%]");
        }
    }
</script>

@endsection
