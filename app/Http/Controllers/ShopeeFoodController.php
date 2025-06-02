<?php

namespace App\Http\Controllers;

use App\Models\ShopeeFood;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Platform;
use App\Models\Menu;
use App\Models\MenuPrice;

class ShopeeFoodController extends Controller
{   
    // Tampilkan semua transaksi + kirim kategori & platform ke view
    public function index()
    {
        $transaksi = ShopeeFood::latest()->get();
        $categories = Category::all();
        $platforms = Platform::all();

        return view('grabfood.index', compact('transaksi', 'categories', 'platforms'));
    }

    // Dapatkan semua transaksi (json)
    public function getAll()
    {
        $data = ShopeeFood::latest()->get();
        return response()->json($data);
    }

    // Ambil daftar menu berdasarkan category_id (ajax)
    public function getMenus($category_id)
    {
        $menus = Menu::where('category_id', $category_id)->get();
        return response()->json($menus);
    }

    // Ambil harga menu berdasarkan menu_id dan platform_id (ajax)
    public function getPrice(Request $request)
    {
        $menuId = $request->menu_id;
        $platformId = $request->platform_id;

        $price = MenuPrice::where('menu_id', $menuId)
            ->where('platform_id', $platformId)
            ->first();

        return response()->json([
            'price' => $price ? $price->price : 0
        ]);
    }

    // Simpan transaksi baru
   public function store(Request $request)
{
    $request->validate([
        'id_pesanan' => 'required',
        'tanggal' => 'required|date',
        'waktu' => 'required',
        'nama_pelanggan' => 'required',
        'total' => 'required|numeric',
        'metode_pembayaran' => 'required',
        'items' => 'required|array|min:1',
        'items.*.category_id' => 'required|exists:categories,id',
        'items.*.menu_id' => 'required|exists:menus,id',
        'items.*.platform_id' => 'required|exists:platforms,id',
        'items.*.jumlah' => 'required|numeric|min:1',
        'items.*.harga' => 'required|numeric|min:0',
        'items.*.subtotal' => 'required|numeric|min:0',
    ]);

    // Simpan data transaksi + item pesanan dalam bentuk JSON
    ShopeeFood::create([
        'id_pesanan' => $request->id_pesanan,
        'tanggal' => $request->tanggal,
        'waktu' => $request->waktu,
        'nama_pelanggan' => $request->nama_pelanggan,
        'item_pesanan' => json_encode($request->items), 
        'total' => $request->total,
        'metode_pembayaran' => $request->metode_pembayaran,
        'status' => $request->status ? 1 : 0,
    ]);

    return redirect()->route('gofood.index')->with('success', 'Transaksi berhasil ditambahkan!');
}

    // Hapus transaksi
    public function destroy($id)
    {
        $item = ShopeeFood::find($id);
        if (!$item) {   
            return response()->json(['message' => 'Data not found'], 404);
        }
        $item->delete();
        return response()->json(['message' => 'Data deleted successfully'], 200);
    }
}
