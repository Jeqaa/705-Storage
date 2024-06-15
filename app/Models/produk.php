<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    // Set the primary key
    protected $primaryKey = 'id';

    // Disable auto-incrementing for the primary key
    public $incrementing = true;

    // Set the primary key type
    protected $keyType = 'string';

    // Define fillable fields
    protected $fillable = [
        'nama_produk',
        'kategori',
        'jumlah_barang',
        'created_at',
        'updated_at',
    ];

    // Enable timestamps if you want Laravel to manage created_at and updated_at
    public $timestamps = true;
}