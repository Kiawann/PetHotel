<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataHewan extends Model
{
    use HasFactory;

    protected $table = 'data_hewan';
    protected $primaryKey = 'id_kategori_hewan';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id_kategori_hewan',
        'id_data_pemilik',
        'nama_hewan',
        'umur',
        'berat_badan',
        'warna',
        'ras_hewan',
        'jenis_kelamin',
        'foto',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $latest = self::orderBy('id_data_hewan', 'desc')->first();
            $number = $latest ? intval(substr($latest->id_data_hewan, 2)) + 1 : 1; // Ambil angka terakhir
            $model->id_data_hewan = 'dh' . $number; // Format id_data_hewan
        });
    }

     // Relasi ke DataPemilik
     public function pemilik()
     {
         return $this->belongsTo(DataPemilik::class, 'id_data_pemilik', 'id_data_pemilik');
     }
 
     // Relasi ke KategoriHewan
     public function kategori()
     {
         return $this->belongsTo(KategoriHewan::class, 'id_kategori_hewan', 'id_kategori_hewan');
     } 
}
