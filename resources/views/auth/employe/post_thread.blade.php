@extends('layouts.admin')

@section('page_title')
{{ __('Post') }}
@endsection

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(function(){
    //Set character limit on comments
    //var maxchars = <span style="background-color: rgb(247, 218, 100);">300</span>; //Change this number to change the character limit
    //$('.hg-comment-post textarea').before('<div class="text-right"><span id="remain">'+maxchars+'</span> characters remaining</div>');
    $('#description').keyup(function () {
        //alert('Ok textarea');
        //var tlength = $(this).val().length;
        //$(this).val($(this).val().substring(0, 255));
        var tlength = $(this).val().length;
        remain = 255 - parseInt(tlength);
        $('#remain').text(remain + ' / 255 caractères');
    });
  });
</script>
@endsection

@section('styles')
<style>
    .subtitle{
        font-family: 'Poppins';
        color: #2d6187;
    }

    .post-container{
        margin-bottom: 30px;  
    }

    .comment-section {
        display: block;
        border-radius: 11px;
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        margin-top: 5%;
        margin-bottom: 5%;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto
    }

    .name {
        font-size: 20px
    }

    .comment-content {
        font-size: 14px;
        margin-left: 10px;
    }

    .comments {
        color: blue
    }

    .comment-container{
        margin-left: 20px;
    }

/* Post style */
    .mt-100 {
        margin-top: 50px
    }

    .card {
        box-shadow: 0 0.46875rem 2.1875rem rgba(4, 9, 20, 0.03), 0 0.9375rem 1.40625rem rgba(4, 9, 20, 0.03), 0 0.25rem 0.53125rem rgba(4, 9, 20, 0.05), 0 0.125rem 0.1875rem rgba(4, 9, 20, 0.03);
        border-width: 0;
        transition: all .2s
    }

    .card-header:first-child {
        border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0
    }

    .card-header {
        display: flex;
        align-items: center;
        border-bottom-width: 1px;
        padding-top: 0;
        padding-bottom: 0;
        padding-right: .625rem;
        height: 3.5rem;
        text-transform: uppercase;
        background-color: #fff;
        border-bottom: 1px solid rgba(26, 54, 126, 0.125)
    }

    .btn-primary {
        color: #fff;
        background-color: #3f6ad8;
        border-color: #3f6ad8
    }

    .btn {
        font-size: 0.8rem;
        font-weight: 500;
        outline: none !important;
        position: relative;
        transition: color 0.15s, background-color 0.15s, border-color 0.15s, box-shadow 0.15s
    }

    .card-body {
        flex: 1 1 auto;
        padding: 1.25rem
    }

    .card-body p {
        font-size: 13px
    }

    a {
        color: #E91E63;
        text-decoration: none !important;
        background-color: transparent
    }

    .media img {
        width: 40px;
        height: auto
    }

    #description {
        width: 500px;
        height: 100px;
    }

    .col-form-label{
        font-weight: bold;
    }

    .comment-card-header{
        background-color: #7579e7;
        color: white;
        font-family: 'Lato';
    }

    .action-btns{
        /*position: absolute;*/
        margin-top: 10px;
        float:left;
    }

    .action-btns > .btn:hover {
        -webkit-transform: scale(1.1);
        -moz-transform: scale(1.1);
        -o-transform: scale(1.1);
    }
    .action-btns > .btn {
        -webkit-transform: scale(0.8);
        -moz-transform: scale(0.8);
        -o-transform: scale(0.8);
        -webkit-transition-duration: 0.5s;
        -moz-transition-duration: 0.5s;
        -o-transition-duration: 0.5s;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-right">
        <div class="title">
            <h1>Thread</h1>
        </div>
    </div>
    <div class="row float-left action-btns">
        <a href="{{ route('employés.forum_employe') }}" class="btn btn-primary a-btn-slide-text">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <span><strong>Retourner au forum</strong></span>            
        </a>
    </div>
    <div class="container-fluid mt-100 post-container">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-header">
                        <!-- old image: https://res.cloudinary.com/dxfq3iotg/image/upload/v1574583246/AAA/2.jpg -->
                        <div class="media flex-wrap w-100 align-items-center"> <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="d-block ui-w-40 rounded-circle" alt="Image du profile">
                            <div class="media-body ml-3"> <a href="javascript:void(0)" data-abc="true">
                                @if($post->elèveparent_id == null)
                                    {{ $post->employe->nom }} {{ $post->employe->prénom }}
                                @else
                                    Parent ID {{ $post->elèveparent->id }}
                                @endif
                            </a>
                                <div class="text-muted small">Publié le {{ $post->created_at }}, Post id: {{ $post->id }}</div>
                            </div>
                            <div class="text-muted small ml-3">
                                <div><strong>
                                @if($post->elèveparent_id == null)
                                    {{ count($post->employe->posts) }}
                                @else
                                    {{ count($post->elèveparent->posts) }}
                                @endif
                                </strong> posts</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p> 
                            {{ $post->description }}
                        </p>
                    </div>
                    <div class="card-footer d-flex flex-wrap justify-content-between align-items-center px-0 pt-0 pb-3">
                        <div class="px-4 pt-3"> <a href="javascript:void(0)" class="text-muted d-inline-flex align-items-center align-middle" data-abc="true" title="Commentaires"> <i class="fa fa-commenting-o text-danger"></i>&nbsp;&nbsp; <span class="align-middle">{{ count($post->comments) }}</span> </a> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-right">
        <div class="subtitle">
            <h3>Commentaires</h3>
        </div>
    </div>
    <div class="row justify-content-right">
        @foreach($post->comments as $comment)
            <div class="container">
                <div class="comment-container d-flex justify-content-right row">
                    <div class="col-md-6">
                        <div class="bg-white comment-section">
                            <div class="d-flex flex-row user p-2"><img class="d-block ui-w-40 rounded-circle" src="https://img.icons8.com/bubbles/100/000000/user.png" width="50">
                                <div class="d-flex flex-column ml-2"><span class="name font-weight-bold">
                                    @if($comment->elèveparent_id == null)
                                        {{ $comment->employe->nom }} {{ $comment->employe->prénom }}
                                    @else
                                        Parent ID: {{ $comment->elèveparent->id }}
                                    @endif
                                </span><span>Le {{ $comment->created_at }}</span></div>
                            </div>
                            <div class="mt-2 p-2">
                                <p class="comment-content">{{ $comment->description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="col-md-12">
            <div class="card">
                <div class="card-header comment-card-header">{{ __('Commentez') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('employés.ajouter_commentaire', ['id' => $post->id]) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Votre commentaire') }}</label>
                            <div class="col-md-6">
                                <textarea id="description" type="text" placeholder="Saisissez votre Commentaire ..." maxlength="255" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}"></textarea>
                                <div class="float-right"><span id="remain">255 / 255 caractères</span></div>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Ajouter commentaire') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
@endsection
