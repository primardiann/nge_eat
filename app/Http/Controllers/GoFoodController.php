<?php

namespace App\Http\Controllers;  // wajib

use App\Models\GoFood;
use Illuminate\Http\Request;

class GoFoodController extends Controller  // extends dari Controller bawaan Laravel
{
    public function index()
    {
        $transaksi = GoFood::latest()->get();
        return view('gofood.index', compact('transaksi'));
    }

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
            'status' => $request->has('status'),
        ]);

        return redirect()->route('gofood.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }
}
