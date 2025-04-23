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
        <h1 class="text-2xl font-bold mb-4">Laporan Transaksi</h1>

        <!-- Form Filter -->
        <form action="{{ route('laporan.index') }}" method="GET" class="mb-4 flex flex-wrap items-end gap-4">
            <div>
                <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700">Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ request('tanggal_mulai') }}" class="border-gray-300 rounded shadow-sm p-2">
            </div>
            <div>
                <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700">Tanggal Selesai</label>
                <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ request('tanggal_selesai') }}" class="border-gray-300 rounded shadow-sm p-2">
            </div>
            <div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow">Tampilkan</button>
            </div>
            <div>
                <button type="submit" name="cetak_pdf" value="true" class="bg-green-500 text-white px-4 py-2 rounded shadow">Cetak PDF</button>
            </div>
        </form>

        <!-- Tabel Laporan -->
        <div class="overflow-x-auto">
            <table class="table-auto w-full border border-gray-300 shadow-md bg-white">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Tanggal</th>
                        <th class="border px-4 py-2">Nama Obat</th>
                        <th class="border px-4 py-2">Jumlah</th>
                        <th class="border px-4 py-2">Subtotal</th>
                        <th class="border px-4 py-2">Total Harga</th>
                        <th class="border px-4 py-2">Stok Akhir</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaksis as $index => $transaksi)
                        <tr class="hover:bg-gray-100 text-center">
                            <td class="border px-4 py-2">{{ $index + 1 }}</td>
                            <td class="border px-4 py-2">{{ $transaksi->created_at->format('d-m-Y') }}</td>
                            <td class="border px-4 py-2">
                                @foreach ($transaksi->details as $detail)
                                    {{ $detail->obat->nama_obat ?? 'Obat tidak ditemukan' }} <br>
                                @endforeach
                            </td>
                            <td class="border px-4 py-2">
                                @foreach ($transaksi->details as $detail)
                                    {{ $detail->jumlah }} <br>
                                @endforeach
                            </td>
                            <td class="border px-4 py-2">
                                @foreach ($transaksi->details as $detail)
                                    Rp {{ number_format($detail->subtotal, 0, ',', '.') }} <br>
                                @endforeach
                            </td>
                            <td class="border px-4 py-2 font-bold">
                                Rp {{ number_format($transaksi->total_harga, 0, ',', '.') }}
                            </td>
                            <td class="border px-4 py-2">
                                @foreach ($transaksi->details as $detail)
                                    {{ $stokAkhir[$transaksi->id][$detail->obat_id] ?? 'N/A' }} <br>
                                @endforeach
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center border px-4 py-2">Tidak ada data transaksi</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-gray-200 font-bold">
                    <tr>
                        <td colspan="5" class="text-right px-4 py-2">Total Pendapatan:</td>
                        <td class="text-center px-4 py-2">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
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
