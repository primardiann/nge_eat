<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ShopeeFood;
use App\Models\Category;  
use App\Models\Menu;
use App\Models\Platform;
use App\Models\MenuPrice;

class ShopeeFoodController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $platforms = Platform::all();

        return view('shopeefood.index', compact('categories', 'platforms'));
    }

    public function getAll()
    {
        $data = ShopeeFood::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'id_pesanan' => 'required|string',
            'nama_pelanggan' => 'required|string',
            'metode_pembayaran' => 'required|string',
            'total' => 'required|numeric',
            'item_pesanan' => 'required|json',
        ]);

        $items = json_decode($request->input('item_pesanan'), true);

        if (!$items || count($items) === 0) {
            return back()->withErrors(['item_pesanan' => 'Minimal harus ada satu item pesanan']);
        }

        foreach ($items as $item) {
            ShopeeFood::create([
                'tanggal' => $request->tanggal,
                'waktu' => $request->waktu,
                'id_pesanan' => $request->id_pesanan,
                'nama_pelanggan' => $request->nama_pelanggan,
                'metode_pembayaran' => $request->metode_pembayaran,
                'total' => $request->total,
                'status' => $request->has('status') ? 1 : 0,
                'category_id' => $item['category_id'],
                'menu_id' => $item['menu_id'],
                'platform_id' => $item['platform_id'],
                'jumlah' => $item['jumlah'],
                'harga' => $item['harga'],
                'subtotal' => $item['subtotal'],
            ]);
        }

        return redirect()->route('shopeefood.index')->with('success', 'Transaksi berhasil disimpan.');
    }

    public function destroy($id)
    {
        $transaksi = ShopeeFood::findOrFail($id);
        $transaksi->delete();

        return response()->json(['message' => 'Data transaksi berhasil dihapus']);
    }
}
