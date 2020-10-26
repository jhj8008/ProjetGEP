<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Elève;

class NotesController extends Controller
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
    public function index()
    {
        $élèves = Elève::where('parent_id', '=', Auth::user()->id)->get();
        return view('Auth\notes', compact('élèves'));
    }

    public function getNotes($élève_id){
        $élève = Elève::find($élève_id);
        $notes = $élève->notes;

        return view('Auth\liste_notes', compact('notes'));
    }
}
