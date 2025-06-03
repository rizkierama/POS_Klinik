<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obat;

class ObatController extends Controller
{
    public function index(Request $request)
    {
        $query = Obat::query();

        if ($request->filled('search')) {
            $query->where('nama_obat', 'like', '%' . $request->search . '%');
        }
    
        $obats = $query->orderBy('nama_obat')->paginate($request->per_page ?? 10);
    
        return view('obat.index', compact('obats'));
    }

    public function create()
    {
        return view('obat.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        Obat::create($request->all());

        return redirect()->route('obat.index')->with('success', 'Obat berhasil ditambahkan.');
    }

    public function edit(Obat $obat)
    {
        return view('obat.edit', compact('obat'));
    }

    public function update(Request $request, Obat $obat)
    {
        $request->validate([
            'nama_obat' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'harga' => 'required|numeric|min:0',
        ]);

        $obat->update($request->all());

        return redirect()->route('obat.index')->with('success', 'Obat berhasil diperbarui.');
    }

    public function updateStok(Request $request)
    {
        $query = Obat::query();

        if ($request->filled('search')) {
            $query->where('nama_obat', 'like', '%' . $request->search . '%');
        }
    
        $obats = $query->orderBy('nama_obat')->get(); // ambil semua tanpa paginate
        
        return view('obat.update-stok', compact('obats'));
    }

    public function updateStokProses(Request $request, $id)
    {
        $obat = Obat::findOrFail($id);
        $jumlah = $request->jumlah;

        if ($request->tipe == 'tambah') {
            $obat->stok += $jumlah;
        } elseif ($request->tipe == 'kurangi' && $obat->stok >= $jumlah) {
            $obat->stok -= $jumlah;
        } else {
            return redirect()->back()->with('error', 'Stok tidak mencukupi!');
        }

        $obat->save();
        return redirect()->back()->with('success', 'Stok berhasil diperbarui!');
        return redirect()->route('obat.index');
    }

    public function destroy(Obat $obat)
    {
        $obat->delete();

        return redirect()->route('obat.index')->with('success', 'Obat berhasil dihapus.');
    }
}

