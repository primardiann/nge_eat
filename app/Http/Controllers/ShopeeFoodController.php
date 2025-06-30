<?php

namespace App\Http\Controllers;

use App\Models\ShopeeFood; // Model untuk tabel utama transaksi ShopeeFood
use App\Models\ShopeeFoodItem; // Model untuk tabel detail item transaksi ShopeeFood
use App\Models\Platform; // Model untuk data platform (ShopeeFood, GrabFood, dsb)
use App\Models\Menu; // Model untuk data menu
use App\Models\MenuPrice; // Model untuk harga menu berdasarkan platform
use Illuminate\Http\Request; // Untuk menangani request HTTP
use Illuminate\Support\Facades\DB; // Untuk transaksi database (begin, commit, rollback)
use Illuminate\Support\Str; // Untuk generate ID acak

class ShopeeFoodController extends Controller
{
    public function index()
    {
        // Mengambil data transaksi dengan relasi item dan menu, urut terbaru
        $transaksi = ShopeeFood::with(['items.menu'])->latest()->paginate(10);
        $platforms = Platform::all(); // Ambil semua platform
        $menus = Menu::all(); // Ambil semua menu
        $generatedId = $this->generateIdPesanan(); // Generate ID pesanan unik

        return view('shopeefood.index', compact('transaksi', 'platforms', 'menus', 'generatedId'));
    }

    public function getAll()
    {
        // Mengambil semua data transaksi beserta relasi item, menu, dan platform
        return response()->json(
            ShopeeFood::with('items.menu', 'items.platform')->latest()->get()
        );
    }

    public function getPrice(Request $request)
    {
        // Mengambil harga berdasarkan menu_id dan platform_id
        $price = MenuPrice::where('menu_id', $request->menu_id)
            ->where('platform_id', $request->platform_id)
            ->first();

        return response()->json(['price' => $price?->price ?? 0]); // Jika tidak ada, kembalikan 0
    }

    private function generateIdPesanan(): string
    {
        // Loop untuk memastikan ID pesanan yang dibuat unik (tidak duplikat)
        do {
            $id = 'SHOPPE' . strtoupper(Str::random(8)); // Prefix SHOPPE + 8 karakter acak
        } while (ShopeeFood::where('id_pesanan', $id)->exists());

        return $id;
    }

    public function store(Request $request)
    {
        // Validasi input request dari form
        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'nama_pelanggan' => 'required',
            'metode_pembayaran' => 'required',
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.platform_id' => 'required|exists:platforms,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::beginTransaction(); // Mulai transaksi database

        try {
            $total = 0; // Total harga semua item
            $jumlahTotalItem = 0; // Total jumlah item

            // Simpan data utama transaksi ke tabel shopee_foods
            $transaksi = ShopeeFood::create([
                'id_pesanan' => $this->generateIdPesanan(),
                'tanggal' => $request->tanggal,
                'waktu' => $request->waktu,
                'nama_pelanggan' => $request->nama_pelanggan,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => $request->has('status') ? 1 : 0,
                'total' => 0, // Akan diupdate setelah loop
                'jumlah' => 0,
            ]);

            // Loop menyimpan data item transaksi ke shopee_food_items
            foreach ($request->items as $item) {
                $menuPrice = MenuPrice::where('menu_id', $item['menu_id'])
                    ->where('platform_id', $item['platform_id'])
                    ->first();

                if (!$menuPrice) {
                    throw new \Exception('Harga tidak ditemukan.');
                }

                $subtotal = $menuPrice->price * $item['jumlah'];
                $total += $subtotal;
                $jumlahTotalItem += $item['jumlah'];

                // Simpan item ke tabel shopee_food_items
                ShopeeFoodItem::create([
                    'transaksi_id' => $transaksi->id,
                    'menu_id' => $item['menu_id'],
                    'menu_price_id' => $menuPrice->id,
                    'platform_id' => $item['platform_id'],
                    'harga' => $menuPrice->price,
                    'jumlah' => $item['jumlah'],
                ]);
            }

            // Update total dan jumlah item ke transaksi utama
            $transaksi->update([
                'total' => $total,
                'jumlah' => $jumlahTotalItem,
            ]);

            DB::commit(); // Commit transaksi jika berhasil

            return redirect()->route('shopeefood.index')->with('success', 'Transaksi berhasil ditambahkan!');
        } catch (\Exception $e) {
            DB::rollBack(); // Rollback jika terjadi error
            return back()->with('error', 'Gagal menyimpan transaksi: ' . $e->getMessage());
        }
    }

    public function edit($id)
    {
        // Ambil data transaksi + relasi items untuk ditampilkan di form edit
        $transaksi = ShopeeFood::with('items')->findOrFail($id);
        $platforms = Platform::all();
        $menus = Menu::all();

        return view('shopeefood.edit', compact('transaksi', 'platforms', 'menus'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input update
        $request->validate([
            'tanggal' => 'required|date',
            'waktu' => 'required',
            'nama_pelanggan' => 'required',
            'metode_pembayaran' => 'required',
            'items' => 'required|array|min:1',
            'items.*.menu_id' => 'required|exists:menus,id',
            'items.*.platform_id' => 'required|exists:platforms,id',
            'items.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::beginTransaction(); // Mulai transaksi update

        try {
            $transaksi = ShopeeFood::findOrFail($id);
            $transaksi->items()->delete(); // Hapus item lama

            $total = 0;
            $jumlahTotalItem = 0;

            // Simpan item baru
            foreach ($request->items as $item) {
                $menuPrice = MenuPrice::where('menu_id', $item['menu_id'])
                    ->where('platform_id', $item['platform_id'])
                    ->first();

                if (!$menuPrice) {
                    throw new \Exception('Harga tidak ditemukan.');
                }

                $subtotal = $menuPrice->price * $item['jumlah'];
                $total += $subtotal;
                $jumlahTotalItem += $item['jumlah'];

                ShopeeFoodItem::create([
                    'transaksi_id' => $transaksi->id,
                    'menu_id' => $item['menu_id'],
                    'menu_price_id' => $menuPrice->id,
                    'platform_id' => $item['platform_id'],
                    'harga' => $menuPrice->price,
                    'jumlah' => $item['jumlah'],
                ]);
            }

            // Update ke transaksi utama
            $transaksi->update([
                'tanggal' => $request->tanggal,
                'waktu' => $request->waktu,
                'nama_pelanggan' => $request->nama_pelanggan,
                'metode_pembayaran' => $request->metode_pembayaran,
                'status' => $request->has('status') ? 1 : 0,
                'total' => $total,
                'jumlah' => $jumlahTotalItem,
            ]);

            DB::commit(); // Sukses
            return redirect()->route('shopeefood.index')->with('success', 'Transaksi berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollBack();
            $page = $request->query('page', 1); // kembalikan ke halaman sebelumnya
            return redirect()->route('shopeefood.index', ['page' => $page])
                ->with('success', 'Transaksi berhasil diperbarui');
        }
    }

    public function destroy($id)
    {
        // Hapus transaksi dan item terkait
        $transaksi = ShopeeFood::find($id);

        if (!$transaksi) {
            return redirect()->route('shopeefood.index')->with('error', 'Transaksi tidak ditemukan.');
        }

        $transaksi->items()->delete();
        $transaksi->delete();

        return redirect()->route('shopeefood.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function editJson($id)
    {
        // Ambil transaksi dan relasi item untuk kebutuhan frontend (misalnya: modal edit)
        $transaksi = ShopeeFood::with(['items.menu', 'items.platform'])->findOrFail($id);

        // Format array item untuk dikirim ke frontend
        $items = $transaksi->items->map(function($item) {
            return [
                'platform_id' => $item->platform_id,
                'jumlah'      => $item->jumlah,
                'harga'       => $item->harga,
                'subtotal'    => $item->harga * $item->jumlah,
                'menu_id'     => $item->menu_id,
            ];
        })->toArray();

        return response()->json([
            'waktu'              => $transaksi->waktu ? \Carbon\Carbon::parse($transaksi->waktu)->format('H:i') : '',
            'id_pesanan'         => $transaksi->id_pesanan,
            'nama_pelanggan'     => $transaksi->nama_pelanggan,
            'metode_pembayaran'  => $transaksi->metode_pembayaran,
            'total'              => $transaksi->total,
            'status'             => $transaksi->status,
            'items'              => $items,
            'tanggal'            => $transaksi->tanggal ? $transaksi->tanggal->format('Y-m-d') : '',
        ]);
    }
}
