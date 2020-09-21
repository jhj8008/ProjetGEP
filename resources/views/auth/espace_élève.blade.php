@extends('layouts.app')

@section('styles')
    <style>
        .my_content{
            flex: 1 0 auto;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .title{
            display: grid;
            place-items: center;
        }

        .menu_item {
            /*border: 1px solid rgba(50,50,50,0.1);*/
            border: 20px solid transparent;
            box-shadow: 0 1px 2px rgba(0,0,0,0.15);
            transition: box-shadow 0.3s ease-in-out;
            padding: 5px;
        }

        .menu_item:hover{
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }

        .item_desc > a {
            text-decoration: none;
            font-weight: bold;
            margin-left: 20px;
            height: 35px;
            width: 110px;
        }
        /*.object{
            width: 200px;
            height: 200px;
            border: 1px solid rgb(50,50,50);
        }*/

    </style>
@endsection

@section('content')
    
    <div class="title">
        <h1>Gestion des informations des élèves</h1>
    </div>
    <div class="container my_content">
        <div class="row">
                <div class="col-sm-6 menu_item">
                    <h3>Inscription en ligne <i class="fa fa-user-plus" aria-hidden="true"></i></h3>
                    <div class="item_desc">Inscrivez vos enfants en ligne <a href="{{ route('parents.inscription') }}" class="btn btn-info"><span>Continuer</span></a></div>
                </div>
                <div class="col-sm-6 menu_item">
                    <h3>Bulletin <i class="fa fa-files-o" aria-hidden="true"></i></h3>
                    <div class="item_desc">Accéder et télécharger tous les bulletins de vos enfants <a href="{{ route('parents.bulletins') }}" class="btn btn-info">Continuer</a> </div>
                </div>
                <div class="col-sm-6 menu_item">
                    <h3>Cahier de texte <i class="fa fa-calendar-minus-o" aria-hidden="true"></i></h3>
                    <div class="item_desc">Suivre les avancements des cours de vos enfants <a href="{{ route('parents.cahiers_de_texte') }}" class="btn btn-info">Continuer</a> </div>
                </div>
                <div class="col-sm-6 menu_item">
                    <h3>Emploi du temps <i class="fa fa-calendar" aria-hidden="true"></i> </h3>
                    <div class="item_desc">Accéder aux emplois du temps de vos enfants <a href="{{ route('parents.emplois_du_temps') }}" class="btn btn-info">Continuer</a> </div>
                </div>
                <div class="col-sm-6 menu_item">
                    <h3>Liste des élèves <i class="fa fa-th-list" aria-hidden="true"></i></h3>
                    <div class="item_desc">Accéder aux profiles de vos enfants <a href="{{ route('parents.liste_élèves') }}" class="btn btn-info">Continuer</a> </div>
                </div>
        </div>
    </div>
    <div class="object"></div>
@endsection
