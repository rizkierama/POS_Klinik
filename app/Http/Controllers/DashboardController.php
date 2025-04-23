<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Obat;
use App\Models\Transaksi;
class DashboardController extends Controller
{
    public function index()
    {
        $jumlahObat = Obat::count();
        $jumlahTransaksi = Transaksi::count();
        $totalPenghasilan = Transaksi::sum('total_harga');

        return view('dashboard', compact('jumlahObat', 'jumlahTransaksi', 'totalPenghasilan'));
    }
}
