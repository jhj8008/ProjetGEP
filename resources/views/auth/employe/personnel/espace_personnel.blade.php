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
            <h1>Espace employé</h1>
        </div>
        <div class="row">
            <div class="col-sm-6 menu_item">
                <h3>Espace de l'enseignant<i class="fa fa-graduation-cap" aria-hidden="true"></i></h3>
                <div class="item_desc">Espace de l'enseignant<a href="#" class="btn btn-info"><span>Continuer</span></a></div>
            </div>
            <div class="col-sm-6 menu_item">
                <h3>Espace du personnel<i class="fa fa-object-group" aria-hidden="true"></i></h3>
                <div class="item_desc">Espace du personnel<a href="#" class="btn btn-info">Continuer</a> </div>
            </div>
            <div class="col-sm-6 menu_item">
                <h3>Espace admin<i class="fa fa-cog" aria-hidden="true"></i></h3>
                <div class="item_desc">Espace admin<a href="#" class="btn btn-info">Continuer</a> </div>
            </div>
            <div class="col-sm-6 menu_item">
                <h3>Fiche personnelle<i class="fa fa-address-card" aria-hidden="true"></i> </h3>
                <div class="item_desc">Fiche personnelle<a href="#" class="btn btn-info">Continuer</a> </div>
            </div>
            <div class="col-sm-6 menu_item">
                <h3>Forum<i class="fa fa-globe" aria-hidden="true"></i></h3>
                <div class="item_desc">Accéder aux forum des employées <a href="#" class="btn btn-info">Continuer</a> </div>
            </div>
            <div class="col-sm-6 menu_item">
                <h3>Notifications<i class="fa fa-inbox" aria-hidden="true"></i></h3>
                <div class="item_desc">Accéder à tous vos notifications<a href="#" class="btn btn-info">Continuer</a> </div>
            </div>
        </div>
    </div>
</div>
@endsection
