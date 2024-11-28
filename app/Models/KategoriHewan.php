<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriHewan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_kategori_hewan';
    public $incrementing = false; // Non-Auto-Increment
    protected $keyType = 'string';
    protected $table = 'kategori_hewan';

    protected $fillable = [
        'id_kategori_hewan',
        'nama_kategori',
    ];

    // Generate ID otomatis saat create
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($kategori) {
            $lastId = self::orderBy('id_kategori_hewan', 'desc')->first();

            if ($lastId) {
                // Ambil angka terakhir dari ID terakhir, tambahkan 1
                $lastNumber = intval(substr($lastId->id_kategori_hewan, 2)) + 1;
            } else {
                $lastNumber = 1;
            }

            // Format ID baru (e.g., kt1, kt2, ...)
            $kategori->id_kategori_hewan = 'kt' . $lastNumber;
        });
    }
    public function hewan()
    {
        return $this->hasMany(DataHewan::class, 'id_kategori_hewan', 'id_kategori_hewan');
    }
}
