@extends('layouts.admin')

@section('page_title')
    {{ __('Espace admin') }}
@endsection

@section('styles')
    <style>
        .my_content{
            flex: 1 0 auto;
            margin-top: 20px;
            margin-bottom: 20px;
        }

        .titre{
            text-align: center;
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
                <h3>Boîte de récéption<i class="fa fa-graduation-cap" aria-hidden="true"></i></h3>
                <div class="item_desc">Gérer les messages envoyés dans la boîte de récéption.<a href="{{ route('admins.boite_reception') }}" class="btn btn-info float-right">Continuer</a></div>
            </div>
            <div class="col-sm-6 menu_item">
                <h3>Gestion du personnel<i class="fa fa-object-group" aria-hidden="true"></i></h3>
                <div class="item_desc">Gérer les comptes et les fiches personnelles des personnels.<a href="{{ route('admins.gestion_personnel') }}" class="btn btn-info float-right">Continuer</a> </div>
            </div>
            <div class="col-sm-6 menu_item">
                <h3>Gestion des comptes admin<i class="fa fa-object-group" aria-hidden="true"></i></h3>
                <div class="item_desc">Gérer les comptes et les fiches personnelles des admins.<a href="{{ route('admins.gestion_admin') }}" class="btn btn-info float-right">Continuer</a> </div>
            </div>
        </div>
    </div>
</div>
@endsection
