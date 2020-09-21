<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EspaceEnseignantController extends Controller
{
    public function __construct(){
        $this->middleware('enseignant');
    }

    public function index(){
        return view('Auth\employe\enseignant\espace_enseignant');
    }
}
