<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Elève;
class ListeElèveController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $élèves = Elève::all();
        return view('liste_élèves', compact('élèves'));
    }
}
