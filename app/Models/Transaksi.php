<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = [
        'idPetugas',
        'idOrder',
        'total',
        'status',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'idOrder', 'id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'idPetugas', 'id');
    }
}
