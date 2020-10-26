@extends('layouts.admin')

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
        .my_footer {
            position: absolute;
        }
    </style>
@endsection


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-sm-6 menu_item">
                <h3>Notes et remarques<i class="fa fa-graduation-cap" aria-hidden="true"></i></h3>
                <div class="item_desc">Ajouter des notes et des remarques pour chaque élèves<a href="{{ route('enseignants.notes_et_remarques') }}" class="btn btn-info float-right"><span>Continuer</span></a></div>
            </div>
            <div class="col-sm-6 menu_item">
                <h3>Absence et retards<i class="fa fa-object-group" aria-hidden="true"></i></h3>
                <div class="item_desc">Ajouter les absences et les retards<a href="{{ route('enseignants.absences_retards') }}" class="btn btn-info float-right">Continuer</a> </div>
            </div>
            <div class="col-sm-6 menu_item">
                <h3>Bulletins des élèves<i class="fa fa-cog" aria-hidden="true"></i></h3>
                <div class="item_desc">Mettre en ligne les notes de vos classes<a href="{{ route('enseignants.bulletins') }}" class="btn btn-info float-right">Continuer</a> </div>
            </div>
            <div class="col-sm-6 menu_item">
                <h3>Saisir des cahiers de texte<i class="fa fa-address-card" aria-hidden="true"></i> </h3>
                <div class="item_desc">Saisir les cahiers de texte de vos classes<a href="{{ route('enseignants.cahiers_texte') }}" class="btn btn-info float-right">Continuer</a> </div>
            </div>
        </div>
    </div>
</div>
@endsection
