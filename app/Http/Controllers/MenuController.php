<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Menu;
use App\Models\Platform;
use App\Models\MenuPrice;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    // Tampilkan semua menu dengan pagination dan data untuk modal tambah
   public function index()
{
    $menus = Menu::with(['category', 'prices.platform'])->paginate(10);
    $categories = Category::all();
    $platforms = Platform::all();

    return view('menus.index', compact('menus', 'categories', 'platforms'));
}


    // Simpan menu baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'prices' => 'required|array',
            'prices.*' => 'required|numeric|min:0',
        ]);

        $menu = Menu::create([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description ?? null,
        ]);

        foreach ($request->prices as $platform_id => $price) {
            MenuPrice::create([
                'menu_id' => $menu->id,
                'platform_id' => $platform_id,
                'price' => $price,
            ]);
        }

        return redirect()->route('menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    // Tampilkan form edit menu
    public function edit(Menu $menu)
    {
        $categories = Category::all();
        $platforms = Platform::all();
  $menu->load('prices.platform', 'category');


        return view('menus.edit', compact('menu', 'categories', 'platforms'));
    }

    // Update menu yang sudah ada
    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'name' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'prices' => 'required|array',
            'prices.*' => 'required|numeric|min:0',
        ]);

        $menu->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'description' => $request->description ?? null,
        ]);

        foreach ($request->prices as $platform_id => $price) {
            $menu->prices()->updateOrCreate(
                [
                    'platform_id' => $platform_id,
                ],
                ['price' => $price]
            );
        }

        return redirect()->route('menus.index')->with('success', 'Menu berhasil diupdate.');
    }

    // Hapus menu beserta harga per platform-nya
    public function destroy(Menu $menu)
    {
        try {
            $menu->prices()->delete();
            $menu->delete();

            return redirect()->route('menus.index')->with('success', 'Menu berhasil dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menghapus menu: ' . $e->getMessage());
        }
    }
}
