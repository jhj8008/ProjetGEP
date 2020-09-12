<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;
use App\Elève;
use App\Elèveparent;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class InscriptionController extends Controller
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

    //private $niveaux = array('CP1' => 'prod_Hz7mwZNXsEFxBl', 'CP2' => 'prod_Hz7oi1PLTZwlL5', 'CE1' => 'prod_Hz7oeHvmPXr3R8', 'CE2' => 'prod_Hz7pcbj28oCCSM', 'CM1' => 'prod_Hz7qbr42LiWXDX', 'CM2' => 'prod_Hz7qxVCQ49AAo6');
    private $niveaux = array('CP1' => 'price_1HPA1ZIPrKjgy6qPTV5silYo', 'CP2' => 'price_1HPA1ZIPrKjgy6qPDPNc8IqI', 'CE1' => 'price_1HPA1ZIPrKjgy6qPNnOg597j', 'CE2' => 'price_1HPA1ZIPrKjgy6qPA1HHtEvM', 'CM1' => 'price_1HPA1aIPrKjgy6qPISnUQ7lo', 'CM2' => 'price_1HPA1aIPrKjgy6qP5sex28VS');
    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::ElèveHome;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data = [
            'intent' => auth()->user()->createSetupIntent()
        ];
        return view('Auth\inscription')->with($data);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */

     public function inscrire(Request $req){
        $valid = $this->validator($req->all());
        
        if($valid->fails()){
            return redirect('espace_élève/inscription')
                    ->withErrors($valid)->withInput();
        }

        // check if record exists
        if(Elève::where(['nom' => $req->all()['nom'], 'prénom' => $req->all()['prénom'], 'parent_id' => auth()->id()])->exists()){
            //return view('auth\my_page');
            return redirect()->back()->withErrors(['duplicate_error' => 'Cet élève est déjà inscrit dans cette école']);
        }
        
        //$u = Elèveparent::where(['email' => auth()->user()->email])->get();

        $persisted_data = $req->all();

        $persisted_data['parent_id'] = auth()->id();

        $user = auth()->user();

        $paymentMethod = 'pm_1HP9PCIPrKjgy6qPUwZY5YZu';

        $planId = $this->niveaux[$persisted_data['niveau_scolaire']];

        $user->newSubscription('main', $planId)->create($paymentMethod);
        
        $this->create($persisted_data);
        return redirect()->route('espace_élève');
     }
    protected function validator(array $data){
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255'],
            'prénom' => ['required', 'string', 'max:255'],
            'sexe' => ['required', 'string', 'max:255'],
            'date_de_naissance' => ['required', 'string', 'max:20'],
            'niveau_scolaire' => ['required', 'string', 'max:8'],
            'montant' => ['required', 'string']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data){
        
        return Elève::create([
            'nom' => $data['nom'],
            'prénom' => $data['prénom'],
            'sexe' => $data['sexe'],
            'date_de_naissance' => date('Y-m-d',strtotime($data['date_de_naissance'])),
            'niveau_scolaire' => $data['niveau_scolaire'],
            'parent_id' => $data['parent_id'],
        ]);
    }
}
