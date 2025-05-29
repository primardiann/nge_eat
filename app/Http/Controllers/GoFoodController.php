<?php

namespace App\Http\Controllers;

use App\Models\GoFood;
use Illuminate\Http\Request;

class GoFoodController extends Controller
{
    // Tampilkan semua transaksi
    public function index()
    {
        $transaksi = GoFood::latest()->get();
        return view('gofood.index', compact('transaksi'));
    }

    public function getAll()
{
    $data = GoFood::latest()->get();
    return response()->json($data);
}

    // Simpan transaksi baru
    public function store(Request $request)
    {
        $request->validate([
            'id_pesanan' => 'required',
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'nama_pelanggan' => 'required',
            'item_pesanan' => 'required',
            'total' => 'required|numeric',
            'metode_pembayaran' => 'required',
        ]);

        GoFood::create([
            'id_pesanan' => $request->id_pesanan,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'nama_pelanggan' => $request->nama_pelanggan,
            'item_pesanan' => $request->item_pesanan,
            'total' => $request->total,
            'metode_pembayaran' => $request->metode_pembayaran,
            // 'status' biasanya adalah string atau boolean, sesuaikan ini:
            'status' => $request->status ?? null,
        ]);

        return redirect()->route('gofood.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

   
public function destroy($id)
{
    $item = GoFood::find($id);
    if (!$item) {
        return response()->json(['message' => 'Data not found'], 404);
    }
    $item->delete();
    return response()->json(['message' => 'Data deleted successfully'], 200);
}

}