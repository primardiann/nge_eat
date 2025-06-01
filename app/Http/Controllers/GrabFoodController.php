<?php

namespace App\Http\Controllers;

use App\Models\GrabFood;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Platform;
use App\Models\MenuPrice;
use Illuminate\Http\Request;

class GrabFoodController extends Controller
{
    // Tampilkan halaman utama transaksi GrabFood
    public function index()
    {
        $categories = Category::all();
        $platforms = Platform::all();
        return view('grabfood.index', compact('categories', 'platforms'));
    }

    // Ambil semua data transaksi GrabFood (misal untuk API/frontend)
    public function getAll()
    {
        $data = GrabFood::latest()->get();
        return response()->json($data);
    }

    // Simpan transaksi GrabFood baru
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'id_pesanan' => 'required|string|max:255',
            'nama_pelanggan' => 'required|string|max:255',
            'metode_pembayaran' => 'required|string|max:255',
            'total' => 'required|numeric',
            'item_pesanan' => 'required|json',
        ]);

        $data = new GrabFood();
        $data->tanggal = $request->tanggal;
        $data->waktu = $request->waktu;
        $data->id_pesanan = $request->id_pesanan;
        $data->nama_pelanggan = $request->nama_pelanggan;
        $data->metode_pembayaran = $request->metode_pembayaran;
        $data->total = $request->total;
        $data->status = $request->has('status') ? 1 : 0;
        $data->items = $request->item_pesanan;
        $data->save();

        return redirect()->route('grabfood.index')->with('success', 'Transaksi berhasil ditambahkan!');
    }

    // Hapus transaksi GrabFood berdasarkan ID
    public function destroy($id)
    {
        $data = GrabFood::find($id);
        if (!$data) {
            return response()->json(['message' => 'Data tidak ditemukan'], 404);
        }

        $data->delete();
        return response()->json(['message' => 'Data berhasil dihapus'], 200);
    }
}
