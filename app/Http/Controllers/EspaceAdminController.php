<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EspaceAdminController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        return view('Auth\employe\admin\espace_admin');
    }
}
