<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use \App\Post;
use \App\Comment;

class ForumController extends Controller
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
        $posts = Post::select("*")->whereNotNull('elèveparent_id')->get();
        $max_pages = round(count($posts) / 4);
        return view('Auth\forum', compact('max_pages'));
    }

    public function getPosts(Request $request){
        if(isset($request->all()['last_post'])){
            $posts = Post::distinct()->whereNull('employe_id')->where('id', '>', $request->all()['last_post'])->orderBy('created_at')->paginate(4);
        }else {
            $posts = Post::distinct()->whereNull('employe_id')->orderBy('created_at')->paginate(4);
        }
        $data = '';
        
        if($request->ajax()){
            foreach($posts as $post){
                $days = $post->getPostAgeInDays();
                if($days > 1){
                    $days .= ' jours';
                }else if ($days == 1){
                    $days .= ' jour';
                }else {
                    $days = 'Aujourd\'hui';
                }
                $post_url = route('parents.post_thread', ['id' => $post->id]);
                //$post_url = "#";
                $data .= '<div class="a_post container-fluid mt-100" id="' . $post->id . '">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <div class="media flex-wrap w-100 align-items-center"> <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="d-block ui-w-40 rounded-circle" alt="Image du profile">
                                        <div class="media-body ml-3"> <a href="javascript:void(0)" data-abc="true">Parent ID ' . $post->elèveparent->id . '</a>
                                            <div class="text-muted small"> ' . $days . ' </div>
                                        </div>
                                        <div class="text-muted small ml-3">
                                            <div><strong>' . count($post->elèveparent->posts) . '</strong> posts</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <p> ' . $post->description . '
                                    </p>
                                </div>
                                <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                                    <div class="px-4 pt-3"> <a href="javascript:void(0)" class="text-muted d-inline-flex align-items-center align-middle" data-abc="true" title="Commentaires"> <i class="fa fa-commenting-o text-danger"></i>&nbsp;&nbsp; <span class="align-middle">' . count($post->comments) . '</span> </a> </div>
                                    <div class="px-4 pt-3"> <a href="' . $post_url . '" class="btn btn-primary"><i class="ion ion-md-create"></i>&nbsp; Voir le thread</a> </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            return $data;
        }

        return view('Auth\forum');
    }

    public function getPostThread($post_id){
        $post = Post::find($post_id);
        return view('Auth\forum_post_thread', compact('post'));
    }

    public function pageAjouterPost(){
        return view('Auth\nouveau_post');
    }

    public function ajouterPost(Request $request){
        $valid = $this->validator($request->all());

        if($valid->fails()){
            return redirect()->back()->withErrors($valid)->withInput();
        }
        $employe_id = null;
        $parent_id = Auth::user()->id;

        $this->createPost($request->all(), $employe_id, $parent_id);

        return redirect()->route('parents.forum');
    }

    public function ajouterCommentaire(Request $request, $post_id){
        $validation = $this->validatorComment($request->all());

        if($validation->fails()){
            return redirect()->back()->withErrors($validation)->withInput();
        }
        $employe_id = null;
        $parent_id = Auth::user()->id;
        $this->createComment($request->all(), $post_id, $employe_id, $parent_id);

        return redirect()->route('parents.post_thread', ['id' => $post_id]);
    }

    protected function validatorComment(array $data){
        return Validator::make($data, [
            'description' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function validator(array $data){
        return Validator::make($data, [
            'titre' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
        ]);
    }

    protected function createPost(array $data, $employe_id, $parent_id){
        return Post::create([
            'titre' => $data['titre'],
            'description' => $data['description'],
            'employe_id' => $employe_id,
            'elèveparent_id' => $parent_id,
        ]);
    }

    protected function createComment(array $data, $post_id, $employe_id, $parent_id){
        return Comment::create([
            'description' => $data['description'], 
            'post_id' => $post_id,
            'employe_id' => $employe_id,
            'elèveparent_id' => $parent_id,
        ]);
    }
}
