<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginEmployeController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/espace_employe';

    public function index(){
        return view('auth\employe\loginEmploye');
    }
    public function login(Request $request){
        $input = $request->all();

        
        $valid = $this->validator($input);
        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }

        //if(Auth::guard('employe')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)){
        $credentials = $request->only('email', 'password');
        //if (Auth::guard('employe')->attempt(['email' => $input['email'], 'password' => $input['password']])){
        if(Auth::guard('employe')->attempt(['email' => $input['email'], 'password' => $input['password']], $request->get('remember'))){
            return redirect('espace_employe');
        }
        //return $this->loginFailed();
        //echo '<h3>Bravo vous êtes connectés entant que Employé</h3>';
    }

    public function validator(array $data){
        return Validator::make($data, [
            'email' => ['required', 'string', 'email:dns'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }

    public function loginFailed(){
        return redirect()->back()->with('error', 'Login a échouer veuillez réessayer une autre fois');
    }
}
