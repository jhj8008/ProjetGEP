<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GestionActualitésActivitésController extends Controller
{
    public function __construct(){
        $this->middleware('personnel');
    }    

    public function index(){
        $articles = \App\Article::select("*")->where('employe_id', '=', Auth::guard('employe')->user()->id)->get();
        return view('Auth\employe\personnel\gestion_actualités_activités', compact('articles'));
    }

    public function pageCréerArticle(){
        return view('Auth\employe\personnel\form_ajouter_article');
    }

    public function pageModifierArticle($article_id){
        $article = \App\Article::find($article_id);
        return view('Auth\employe\personnel\form_modifier_article', compact('article'));
    }

    public function getArticle($article_id){
        $article = \App\Article::find($article_id);
        return view('Auth\employe\personnel\page_article', compact('article'));
    }

    public function créerArticle(Request $request){
        $validation = $this->validator($request->all());
        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
            //echo $request->all()['image'];
        }

        $this->createArticle($request->all());
        return redirect()->route('personnels.gestion_actualités_activités');
    }

    public function modifierArticle(Request $request, $article_id){
        
        $validation = $this->validator($request->all());

        if($validation->fails()){
            redirect()->back()->withErrors($validation)->withInput();
        }

        $this->updateArticle($request->all(), $article_id);
        return redirect()->route('personnels.page_article', ['id' => $article_id]);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'type' => ['required', 'string', 'min:4'],
            'titre' => ['required', 'string'],
            'objet' => ['required', 'string', 'max:255'],
            'texte' => ['required', 'string', 'max:10000', 'min:10'],
        ]);
    }

    protected function createArticle(array $data){
        return \App\Article::create([
            'type' => $data['type'],
            'titre' => $data['titre'],
            'image' => (strlen($data['image']) > 0 ? $data['image'] : 0),
            'objet' => $data['objet'],
            'texte' => $data['texte'],
            'employe_id' => Auth::guard('employe')->user()->id,
        ]);
    }

    protected function updateArticle(array $data, $article_id){
        $article = \App\Article::find($article_id);
        $article->type = $data['type'];
        $article->titre = $data['titre'];
        $article->image = $data['image'];
        $article->objet = $data['objet'];
        $article->texte = $data['texte'];

        $article->save();
    }

    protected function supprimerArticle($article_id){
        $article = \App\Article::find($article_id);
        $article->delete();

        return redirect()->route('personnels.gestion_actualités_activités');
    }
}
