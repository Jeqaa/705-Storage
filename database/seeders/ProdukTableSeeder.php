<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('produk')->insert([
            [
                'nama_produk' => 'Black250',
                'kategori' => 'Best Seller',
                'jumlah_barang' => 14,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Black100',
                'kategori' => 'Best Seller',
                'jumlah_barang' => 23,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Green250',
                'kategori' => 'Best Seller',
                'jumlah_barang' => 11,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Green100',
                'kategori' => 'Best Seller',
                'jumlah_barang' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Silver',
                'kategori' => 'Best Seller',
                'jumlah_barang' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Sampo',
                'kategori' => 'Other (Liquid)',
                'jumlah_barang' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Nektar Hijau',
                'kategori' => 'Other (Liquid)',
                'jumlah_barang' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Nektar Merah',
                'kategori' => 'Other (Liquid)',
                'jumlah_barang' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Gold Phoenix',
                'kategori' => 'Other (Voer)',
                'jumlah_barang' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Gold Seed',
                'kategori' => 'Other (Voer)',
                'jumlah_barang' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Barcok',
                'kategori' => 'Other (Voer)',
                'jumlah_barang' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Barjo',
                'kategori' => 'Other (Voer)',
                'jumlah_barang' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Topcok',
                'kategori' => 'Other (Voer)',
                'jumlah_barang' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Topjo',
                'kategori' => 'Other (Voer)',
                'jumlah_barang' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Red',
                'kategori' => 'Other (Voer)',
                'jumlah_barang' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Black Phoenix',
                'kategori' => 'Other (Voer)',
                'jumlah_barang' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_produk' => 'Green Premium',
                'kategori' => 'Other (Voer)',
                'jumlah_barang' => 12,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            // Tambahkan data produk lainnya jika diperlukan
        ]);
    }
}
