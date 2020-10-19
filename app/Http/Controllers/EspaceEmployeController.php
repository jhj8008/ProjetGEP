<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EspaceEmployeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('employe');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('Auth\employe\espace_employe');
    }

    public function getFichePersonnelle(){
        /*$f_p = Auth::guard('employe')->user()->fiche_personnelle;
        return view('Auth\employe\personnel\fiche_personnelle', compact('f_p'));*/
    }

    public function getPageForum(){
        $posts = \App\Post::select("*")->whereNotNull('employe_id')->get();
        $max_pages = round(count($posts) / 4);
        return view('Auth\employe\forum', compact('max_pages'));
    }
}
