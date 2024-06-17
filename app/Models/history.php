<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class History extends Model
{
    use HasFactory;

    protected $table = 'history';

    // Set the primary key
    protected $primaryKey = 'id';

    // Disable auto-incrementing for the primary key
    public $incrementing = true;

    // Set the primary key type
    protected $keyType = 'string';

    // Define fillable fields
    protected $fillable = [
        'username',
        'nama_produk',
        'keterangan',
        'jumlah_barang',
        'created_at',
        'updated_at',
    ];

    // Enable timestamps if you want Laravel to manage created_at and updated_at
    public $timestamps = true;

    // Accessor for created_at
    public function getCreatedAtAttribute($value)
    {
        // Format tanggal ke format yang diinginkan
        return Carbon::parse($value)->translatedFormat('d F Y, H:i:s');
    }

    // Accessor for updated_at
    public function getUpdatedAtAttribute($value)
    {
        return Carbon::parse($value)->translatedFormat('d F Y, H:i:s');
    }
}
