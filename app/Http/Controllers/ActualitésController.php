<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActualitésController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('guest');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $articles = \App\Article::select("*")->where('type', 'like', 'actualité')->get();
        $max_pages = round(count($articles) / 4);
        return view('actualités', compact('max_pages'));
    }

    public function getAllArticles(Request $request, $type){
        $articles = \App\Article::where('type', 'like', $type)->get();

        if(isset($request->all()['last_article'])){
            $articles = \App\Article::distinct()->where('type', 'like', 'actualité')->where('id', '>', $request->all()['last_article'])->orderBy('created_at')->paginate(4);
        }else {
            $articles = \App\Article::distinct()->where('type', 'like', 'actualité')->orderBy('created_at')->paginate(4);
        }

        $data = '';
        //if($request->ajax()){
            foreach($articles as $article){
                if($type == "actualité"){
                    $post_url = route('clients.actualité_details', ['type' => $type,'id' => $article->id]);
                }else {
                    $post_url = route('clients.activité_details', ['type' => $type, 'id' => $article->id]);
                }
                $texte = $article->texte;
                $data .= '<div class="col-sm-8" id="' . $article->id . '">
                                <h3 class="title">' . $article->titre . '</h3>
                                <p class="text-muted">Publié le: ' . $article->created_at . '</p>
                                ' . (strlen($texte) > 50 ? substr($texte,0,50)."..." : $texte) . '
                                <p class="text-muted">Rédiger par <span class="author-name">' . $article->employe->nom . ' ' . $article->employe->prénom . '</span></p>
                                <div class="justify-content-right">
                                    <a href="' . $post_url . '" class="btn btn-primary">Lire la suite</a>
                                </div> 
                            </div>
                            <hr>';
            }
            return $data;
        //}
    }

    public function getArticleDetails($type, $article_id){
        $article = \App\Article::find($article_id);

        /*if($type == 'actualité'){
            return view('actualité_detail', compact('article'));
        }*/
        return view('Auth\employe\personnel\page_article', compact('article'));
    }
}
