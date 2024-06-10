<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;

    protected $table = 'produk';

    // Set the primary key
    protected $primaryKey = 'nama_produk';

    // Disable auto-incrementing for the primary key
    public $incrementing = false;

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

    // If you want to customize the timestamp columns
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'terakhir_sunting';
}