<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\DataPemilik;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/konsumen';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
{
    // Validasi data input
    Validator::make($data, [
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'nama' => 'required|string|max:255',
        'nomor_telp' => 'required|string|max:15',
        'jenis_kelamin' => 'required|in:L,P',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Validasi untuk file foto
    ])->validate();

    // Upload foto jika ada
    $foto = null;
    if (request()->hasFile('foto_data_pemilik')) {
        $foto = request()->file('foto_data_pemilik')->store('foto_data_pemilik');
    }

    // Buat pengguna
    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    // Buat data pemilik terkait
    DataPemilik::create([
        'id_user' => $user->id_user,
        'nama' => $data['nama'],
        'nomor_telp' => $data['nomor_telp'],
        'jenis_kelamin' => $data['jenis_kelamin'],
        'foto' => $foto, // Simpan path foto
    ]);

    return $user;
}


public function datapemilik(Request $request)
{
    // Validasi data input
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Kirim data ke view untuk proses lebih lanjut
    $data = $request->only(['name', 'email', 'password', 'password_confirmation']);
    return view('auth.datapemilik', compact('data'));
}


}
