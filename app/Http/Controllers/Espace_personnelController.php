<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Espace_personnelController extends Controller
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
        return view('Auth\employe\personnel\espace_personnel');
    }
}
