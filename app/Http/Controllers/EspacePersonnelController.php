<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EspacePersonnelController extends Controller
{
    public function __construct(){
        $this->middleware('personnel');
    }

    public function index(){
        return view('Auth\employe\personnel\espace_personnel');
    }
}
