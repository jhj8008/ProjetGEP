<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Message;
use App\Mail\GEPMailing;
use App\Mail\MyTestMail;

class BoiteReceptionController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $messages = Message::all();
        return view('Auth\employe\admin\boite_reception', compact('messages'));
    }

    public function getMessage($message_id){
        $message = Message::find($message_id);

        return view('Auth\employe\admin\message', compact('message'));
    }

    public function supprimerMessage($message_id){
        $message = Message::find($message_id);
        $message->delete();

        return redirect()->route('admins.boite_reception')->with('success', 'Message supprimé avec succés');
    }

    public function mail(Request $request){
        $message = $request->all()['message'];
        $email_to = $request->all()['email_to'];

        $validation = $this->validator($request->all());

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }

        $details = [
            'title' => "E-Mail de l'administration du GEP",
            'email' => Auth::guard('employe')->user()->email,
            'body' => $message,
        ];

        Mail::to($email_to)->send(new MyTestMail($details));
        
        return redirect()->route('admins.boite_reception')->with('success', 'Message envoyé avec succés');
    }

    public function getPageNouveauEmail(){
        return view('Auth\employe\admin\nouveau_email');
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'email_to' => ['required', 'email:dns', 'max:255'],
            'message' => ['required', 'string', ]
        ]);
    }
}
