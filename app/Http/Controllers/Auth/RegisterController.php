<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Maestro;
use App\Models\Aprendiz;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller {
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
    protected $redirectTo = RouteServiceProvider::HOME;
    
    protected function redirectTo()
    {
        if (auth()->user()->is_admin == true) {
            return '/admin';
        }
        return RouteServiceProvider::HOME;
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data) {
        return Validator::make($data, [
                    'name' => ['required', 'string', 'max:255'],
                    'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                    'password' => ['required', 'string', 'min:8', 'confirmed'],
                    'nick_a' => ['required', 'string', 'max:255','unique:aprendizs'],
                    'descripcion_a' => ['required', 'string'],
                    'nick_m' => ['required', 'string', 'max:255','unique:maestros'],
                    'descripcion_m' => ['required', 'string']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data) {
        
        $usuario = User::create([
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'birthdate' => $data['birthdate'] ?? null, 
                    'localidad' => $data['localidad'] ?? null, 
                    'genero' => $data['genero'] ?? null, 
                    'password' => Hash::make($data['password']),
        ]);

        $maestro = new Maestro();
        $maestro->nick_m = $data['nick_m'];
        $maestro->descripcion_m = $data['descripcion_m'];
        $aprendiz = new Aprendiz();
        $aprendiz->nick_a = $data['nick_a'];
        $aprendiz->descripcion_a = $data['descripcion_a'];
        
        $maestro->user()->associate($usuario);
        $maestro->save();
        $aprendiz->user()->associate($usuario);
        $aprendiz->save();

        return $usuario;
    }

}
