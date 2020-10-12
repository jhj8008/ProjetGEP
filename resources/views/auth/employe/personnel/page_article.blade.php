@extends('layouts.admin')

@section('page_title')
    {{ __('Page article') }}
@endsection

@section('styles')
<style>
    .title{
        margin-top: 40px;
        margin-bottom: 50px;
        font-family: 'Exo';
        text-align: left;
    }
    .objet{
        font-family: 'Roboto';
        font-weight: bold;
        text-align: center;
    }

    .subtitle{
        margin-left: 40px;
        font-weight: bold;
    }

    .author_date{
        text-align: right;
    }

    .data{
        font-family: 'Roboto';
        color: #9e9e9e;
    }

    .main_texte{
        margin-top: 60px;
        font-family: 'Montserrat';
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if(strlen($article->image) > 0)
            <img class="img-fluid" src="{{ URL::asset('imgs/' . $article->image) }}" width="600" height="150" alt="Responsive image">
        @endif
        <h1 class="title">{{ $article->titre }}</h1>
        <div class="texte-body">
            <h4 class="objet">{{ $article->objet }}</h4>
            <p class="author_date"><strong class="subtitle">Auteur:</strong> <span class="data">{{ $article->employe->nom }}, {{ $article->employe->prénom }}</span> <strong class="subtitle">Date:</strong> <span class="data">{{ $article->created_at }}</span></p>
            <div class="main_texte">
                {!! $article->texte !!}
            </div>
        </div>
    </div>
</div>
@endsection
