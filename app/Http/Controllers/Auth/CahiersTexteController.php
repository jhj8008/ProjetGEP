<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Elève;

class CahiersTexteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $élèves = Elève::where('parent_id', '=', Auth::user()->id)->get();
        return view('cahiers_de_texte', compact('élèves'));
    }

    public function getMatières($élève_id){
        $élève = Elève::find($élève_id);

        
        try {
            $cahiers = $élève->classe->cahier_textes;
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['failure' => "Désolé, il n'y pas matières à voir"]);
        }
        return view('liste_matières', compact(['cahiers', 'élève_id']));
    }

    public function getCahierTexte(Request $request, $élève_id){
        $élève = Elève::find($élève_id);
        //$cahiers = $élève->classe->cahier_textes;
        try {
            $cahiers = $élève->classe->cahier_textes;
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['failure' => "Désolé, il n'y pas matières à voir"]);
        }
        if($request->session()->has('failure')) {
            $request->session()->forget('failure');
        }
        //$cahier = \App\Cahier_texte::find($cahier_id);
        return view('cahier_texte', compact('cahiers'));
    }
}
