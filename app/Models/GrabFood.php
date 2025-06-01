<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GrabFood extends Model
{
    protected $table = 'transaksi_grab_food';

  // Field yang boleh diisi mass assignment
    protected $fillable = [
        'id_pesanan',
        'tanggal',
        'waktu',
        'nama_pelanggan',
        'item_pesanan',
        'total',
        'metode_pembayaran',
        'status',
    ];

    // Casting tipe data
   protected $casts = [
    'tanggal' => 'date',
    'waktu' => 'datetime:H:i:s',
    'status' => 'boolean',
    'item_pesanan' => 'array', 
];

}
