<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $primaryKey ='id_user';
    public $incrementing = false;
   protected $fillable = [
       'name',
       'email',
       'password',
   ];

   protected static function boot()
{
    parent::boot();

    static::creating(function ($user) {
        // Ambil id_user terakhir dari database
        $lastId = User::where('id_user', 'LIKE', 'us%')
                      ->orderBy('id_user', 'desc')
                      ->value('id_user');

        // Ekstrak angka dari id_user terakhir
        $lastNumber = $lastId ? intval(str_replace('us', '', $lastId)) : 0;

        // Tambahkan 1 untuk id berikutnya
        $newId = $lastNumber + 1;

        // Buat id_user baru dengan format "us{angka}"
        $user->id_user = 'us' . $newId;
    });
}


   public function dataPemilik()
{
    return $this->hasOne(DataPemilik::class, 'id_user', 'id_user');
}


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
