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
        
    ];

   // Relasi ke model Kategori
   public function kategori()
   {
       return $this->belongsTo(kategori::class, 'id_kategori', 'id_kategori');
   }

}
