<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';
    
    protected $fillable = [
        
        'tanggal', 
        'harga_bayar', 
        'harga_kembali', 
        'grand_total', 
        'total_barang',
        'kd_transaksi',
    ];


    /**
     * Boot the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($transaksi) {
            if (is_null($transaksi->kd_transaksi)) {
                $transaksi->kd_transaksi = self::generateKdTransaksi();
            }
        });
    }

    /**
     * Generate a unique kd_transaksi.
     *
     * @return string
     */
    protected static function generateKdTransaksi()
    {
        return strtoupper(bin2hex(random_bytes(4))); // 8 karakter acak
    }


    // Relasi ke model DetailTransaksi
    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class, 'id_transaksi', 'id');
    }
}
