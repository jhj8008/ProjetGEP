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

    public function getAllArticles(Request $request, $type){
        $articles = \App\Article::where('type', 'like', $type)->get();

        if(isset($request->all()['last_article'])){
            $articles = \App\Article::distinct()->where('type', 'like', 'actualité')->where('id', '>', $request->all()['last_article'])->orderBy('created_at')->paginate(4);
        }else {
            $articles = \App\Article::distinct()->where('type', 'like', 'actualité')->orderBy('created_at')->paginate(4);
        }

        $data = '';
        if($request->ajax()){
            foreach($articles as $article){
                
                //echo '<h3>Number of posts: ' . count($post->employe->posts) . '</h3>';
                //$data .= '<li>'.$post->id.' <strong>'.$post->title.'</strong> : '.$post->description.'</li>';
                /*$days = $article->getPostAgeInDays();
                if($days > 1){
                    $days .= ' jours';
                }else if ($days == 1){
                    $days .= ' jour';
                }else {
                    $days = 'Aujourd\'hui';
                }*/
                if($type == "actualité"){
                    $post_url = route('clients.actualité_details', ['id' => $article->id]);
                }else {
                    $post_url = route('clients.activité_details', ['id' => $article->id]);
                }
                $texte = $article->texte;
                $data .= '<div class="col-sm-8" id="' . $article->id . '">
                                <h3 class="title">' . $article->titre . '</h3>
                                <p class="text-muted">Publié le: ' . $article->created_at . '</p>
                                ' . (strlen($texte) > 50 ? substr($texte,0,50)."..." : $texte) . '
                                <div class="justify-content-right">
                                    <a href="#" class="btn btn-primary">Lire</a>
                                </div> 
                            </div>
                            <hr>';
            }
            return $data;
        }
    }

    public function getArticleDetails($type, $article_id){
        $article = \App\Article::find($article_id);

        if($type == 'actualité'){
            return view('actualité_detail', compact('article'));
        }
        return view('activité_detail', compact('article'));
    }
}
