<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Elèveparent;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
    protected function validator(array $data){
        $messages = [
            'required' => 'Le champ :attribute est obligatoire',
            'email' => 'Le format de votre :attribute est incorrecte',
            'tel.regex' => 'Le format de votre :attribute est incorrecte',
            'password.min' => 'Votre :attribute doit contenir au mininmum 8 charactères',
        ];
        return Validator::make($data, [
            'nom_père' => ['required', 'string', 'max:255'],
            'nom_mère' => ['required', 'string', 'max:255'],
            'fonction_père' => ['required', 'string', 'max:255'],
            'fonction_mère' => ['required', 'string', 'max:255'],
            'tel' => ['required', 'regex:/(06)[0-9]{8}/', 'min:8'],
            'email' => ['required', 'string', 'email:dns', 'max:255', 'unique:elèveparents'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data){
        return Elèveparent::create([
            'nom_père' => $data['nom_père'],
            'nom_mère' => $data['nom_mère'],
            'fonction_père' => $data['fonction_père'],
            'fonction_mère' => $data['fonction_mère'],
            'tel' => $data['tel'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
