<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    
    protected $primaryKey = 'id_barang';
    
    protected $fillable = [
        
        'nama_barang',
        'id_kategori',
        'harga',
        'foto',
        'kd_barang',
        
    ];

   // Relasi ke model Kategori
   public function kategori()
   {
       return $this->belongsTo(kategori::class, 'id_kategori', 'id_kategori');
   }

   public function stok()
    {
        return $this->hasOne(Stok::class, 'id_barang', 'id_barang'); // Sesuaikan 'id_barang' dengan foreign key yang tepat
    }

}
