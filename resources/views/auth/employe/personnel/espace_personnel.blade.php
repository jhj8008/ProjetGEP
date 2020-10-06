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

    </style>
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="titre">
            <h1>Espace du personnel</h1>
        </div>
        <div class="row">
            <div class="col-sm-6 menu_item">
                <h3>Gestion des emplois du temps<i class="fa fa-calendar-check-o" aria-hidden="true"></i></h3>
                <div class="item_desc">Gérer les emplois du temps de différentes classes<a href="#" class="btn btn-info"><span>Continuer</span></a></div>
            </div>
            <div class="col-sm-6 menu_item">
                <h3>Gestion des informations des élèves<i class="fa fa-address-book-o" aria-hidden="true"></i></h3>
                <div class="item_desc">Gérer les informations des élèves et de leurs parents<a href="{{ route('personnels.liste_élèves') }}" class="btn btn-info">Continuer</a> </div>
            </div>
            <div class="col-sm-6 menu_item">
                <h3>Gestion des enseignants<i class="fa fa-user-circle" aria-hidden="true"></i></h3>
                <div class="item_desc">Gérer les informations des enseignants<a href="#" class="btn btn-info">Continuer</a> </div>
            </div>
            <div class="col-sm-6 menu_item">
                <h3>Gestion des fiches personnlles<i class="fa fa-address-card" aria-hidden="true"></i> </h3>
                <div class="item_desc">Gérer votre fiche personnelle et aussi celles des enseignants<a href="{{ route('personnels.fiches_personnelles') }}" class="btn btn-info">Continuer</a> </div>
            </div>
            <div class="col-sm-6 menu_item">
                <h3>Gestion des classes et matières<i class="fa fa-folder-open-o" aria-hidden="true"></i></h3>
                <div class="item_desc">Gérer les informations des matières et des classes de l'école<a href="{{ route('personnels.classes_matières') }}" class="btn btn-info">Continuer</a> </div>
            </div>
            <div class="col-sm-6 menu_item">
                <h3>Gestion des salles<i class="fa fa-building-o" aria-hidden="true"></i></h3>
                <div class="item_desc">Gérer les informations des salles de l'école<a href="#" class="btn btn-info">Continuer</a> </div>
            </div>
        </div>
    </div>
</div>
@endsection
