<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'idUser',
        'idProduk',
        'amount',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'idUser', 'id');
    }

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'idProduk', 'id');
    }

    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'idOrder', 'id');
    }
}
