<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DataPemilik extends Model
{
    use HasFactory;

    protected $table = 'data_pemilik';  // Sesuaikan nama tabel jika berbeda
    protected $primaryKey = 'id_data_pemilik';  // Sesuaikan primary key jika berbeda
    public $incrementing = false; // Primary key bukan auto-increment
    protected $keyType = 'string'; // Primary key adalah string
    protected $fillable = [
        'id_user',
        'nama',
        'jenis_kelamin',
        'nomor_telp',
        'foto'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($dataPemilik) {
            // Pastikan ID tidak kosong
            if (empty($dataPemilik->id_data_pemilik)) {
                // Ambil ID terakhir berdasarkan pola 'dt%'
                $lastId = self::where('id_data_pemilik', 'LIKE', 'dt%')
                    ->orderByRaw('CAST(SUBSTRING(id_data_pemilik, 3) AS UNSIGNED) DESC')
                    ->value('id_data_pemilik');

                // Ekstrak angka terakhir dan tambahkan 1
                $lastNumber = $lastId ? (int) substr($lastId, 2) : 0;
                $newNumber = $lastNumber + 1;

                // Format ID baru
                $dataPemilik->id_data_pemilik = 'dt' . $newNumber;
            }
        });
    }
    public function hewan()
    {
        return $this->hasMany(DataHewan::class, 'id_data_pemilik', 'id_data_pemilik');
    }
}
