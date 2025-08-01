<?php

/**
 * Nama File   : DashboardController.php
 * Deskripsi   : Controller untuk menampilkan data dashboard seperti grafik dan total pendapatan bulanan.
 * Dibuat oleh : Prima Ardiansyah - NIM 3312301029
 * Tanggal     : 04 Juni 2025
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class DashboardController extends Controller
{
    public function index()
    {
        $year = now()->year;

        $data = collect(range(1, 12))->map(function ($month) use ($year) {
            $gofood = DB::table('transaksi_go_food')
                ->whereYear('tanggal', $year)
                ->whereMonth('tanggal', $month)
                ->sum('total');

            $grabfood = DB::table('transaksi_grab_food')
                ->whereYear('tanggal', $year)
                ->whereMonth('tanggal', $month)
                ->sum('total');

            $shopeefood = DB::table('transaksi_shopee_food')
                ->whereYear('tanggal', $year)
                ->whereMonth('tanggal', $month)
                ->sum('total');

            return $gofood + $grabfood + $shopeefood; 
        });

        $totalPendapatan = $data->sum();

        return view('dashboard', [
            'pendapatanBulanan' => $data,
            'totalPendapatan' => $totalPendapatan,
            'tahun' => $year
        ]);
    }
}
