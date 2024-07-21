<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class stok extends Model
{
    protected $table = "stok";
    protected $primaryKey = "id_stok";
    protected $fillable = ["id_barang", "stok_barang", "tanggal_stok"];
    public $timestamps = false;
    use HasFactory;

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang'); // Sesuaikan 'id_barang' dengan foreign key yang tepat
    }
}
