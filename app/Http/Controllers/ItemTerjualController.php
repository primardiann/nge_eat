<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ItemTerjualController extends Controller
{
    public function gofood(Request $request)
    {
        return $this->getDataByPlatform(1, 'items-terjual.gofood', $request);
    }

    public function grabfood(Request $request)
    {
        return $this->getDataByPlatform(2, 'items-terjual.grabfood', $request);
    }

    public function shopeefood(Request $request)
    {
        return $this->getDataByPlatform(3, 'items-terjual.shopeefood', $request);
    }

    private function getDataByPlatform($platformId, $view, Request $request)
    {
        $selectedDay = $request->input('day');
        $selectedWeek = $request->input('week');
        $selectedMonth = $request->input('month', now()->month);
        $selectedYear = $request->input('year', now()->year);

        $transaksiTable = match ($platformId) {
            1 => 'transaksi_go_food',
            2 => 'transaksi_grab_food',
            3 => 'transaksi_shopee_food',
            default => throw new \Exception("Platform tidak dikenali"),
        };

        $transaksiItemTable = $transaksiTable . '_items';

        $query = DB::table($transaksiItemTable . ' as t')
            ->join('menus as m', 't.menu_id', '=', 'm.id')
            ->join('categories as c', 'm.category_id', '=', 'c.id')
            ->join($transaksiTable . ' as tf', 't.transaksi_id', '=', 'tf.id')
            ->select(
                'm.name as nama_menu',
                'c.name as kategori',
                DB::raw('MAX(t.harga) as harga'),
                DB::raw('SUM(t.jumlah) as item_terjual'),
                DB::raw('DATE_FORMAT(tf.tanggal, "%d-%m-%Y") as tanggal')
            )
            ->where('t.platform_id', $platformId)
            ->whereMonth('tf.tanggal', $selectedMonth)
            ->whereYear('tf.tanggal', $selectedYear);

        if ($selectedWeek) {
            $startOfWeek = Carbon::create($selectedYear, $selectedMonth, 1)->addWeeks($selectedWeek - 1)->startOfWeek(Carbon::MONDAY);
            $endOfWeek = $startOfWeek->copy()->endOfWeek(Carbon::SUNDAY);
            $query->whereBetween('tf.tanggal', [$startOfWeek->toDateString(), $endOfWeek->toDateString()]);
        } elseif ($selectedDay) {
            $query->whereDay('tf.tanggal', $selectedDay);
        }

        $items = $query
            ->groupBy('m.id', 'm.name', 'c.name', DB::raw('DATE_FORMAT(tf.tanggal, "%d-%m-%Y")'))
            ->orderByDesc('item_terjual')
            ->paginate(10)
            ->appends($request->except('page'));

        // Hitung jumlah minggu dalam bulan
        $weeksInMonth = [];
        $date = Carbon::create($selectedYear, $selectedMonth, 1)->startOfWeek(Carbon::MONDAY);
        $lastDay = Carbon::create($selectedYear, $selectedMonth, 1)->endOfMonth();

        $weekNumber = 1;
        while ($date <= $lastDay) {
            $weeksInMonth[] = [
                'number' => $weekNumber,
                'label' => $date->copy()->format('d M') . ' - ' . $date->copy()->endOfWeek(Carbon::SUNDAY)->format('d M')
            ];
            $date->addWeek();
            $weekNumber++;
        }

        return view($view, [
            'items' => $items,
            'selectedDay' => $selectedDay,
            'selectedMonth' => $selectedMonth,
            'selectedYear' => $selectedYear,
            'selectedWeek' => $selectedWeek,
            'weeksInMonth' => $weeksInMonth,
        ]);
    }
}
