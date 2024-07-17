<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;
    protected $table = 'gudang_detail';
    public $fillable = [
        'gudang_id','no_part','nama_barang','jenis_barang','deskripsi','stok','foto','barcode','pengeluaran'
    ];
}
