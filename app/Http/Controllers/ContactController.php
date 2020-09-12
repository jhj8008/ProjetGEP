<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Message;

class ContactController extends Controller
{

    use RegistersUsers;
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('contact');
    }

    public function envoyerMessage(Request $request){
        $valid = $this->validator($request->all());
        if($valid->fails()){
            //echo "OOPS ! Looks like there are some errors";
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $this->create($request->all());

        return redirect()->back()->with('msg_sent', 'Votre message a été envoyer avec succés !');
    }

    public function validator(array $data){
        $messages = [
            'required' => 'Le champ :attribute est obligatoire',
            'email' => 'Le format de votre email est incorrecte'
        ];
        return Validator::make($data, [
            'nom' => ['required', 'string', 'max:255', 'min:3'],
            'email' => ['required', 'email:dns', 'max:255'],
            'message' => ['required', 'string', 'max:5000', 'min:10'],
        ], $messages);
    }

    public function create(array $data){
        return Message::create([
            'nom' => $data['nom'],
            'email' => $data['email'],
            'message' => $data['message'],
        ]);
    }

    public function messages(){
        return [
            'email.email' => 'Veuillez corriger votre adresse email.',
        ];
    }
}
