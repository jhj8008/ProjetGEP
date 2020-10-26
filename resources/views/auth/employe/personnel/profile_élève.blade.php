@extends('layouts.admin')

@section('page_title')
{{ __('Profile élève') }}
@endsection

@section('styles')
<style>
.padding {
    padding: 2rem !important;
}

.user-card-full {
    overflow: hidden;
}

.card {
    border-radius: 5px;
    -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
    border: none;
    margin-bottom: 30px;
}

.m-r-0 {
    margin-right: 0px;
}

.m-l-0 {
    margin-left: 0px;
}

.user-card-full .user-profile {
    border-radius: 5px 0 0 5px;
}

.bg-c-lite-green {
    background: -webkit-gradient(linear, left top, right top, from(#4568DC), to(#B06AB3));/* from #f29263 to #ee5a6f  */ /* from #6190E8 to #A7BFE8  */
    background: linear-gradient(to right, #B06AB3, #4568DC);
}

.user-profile {
    padding: 20px 0;
}

.card-block {
    padding: 1.25rem;
}

.m-b-25 {
    margin-bottom: 25px;
}

.img-radius {
    border-radius: 5px;
}

h6 {
    font-size: 14px;
}

.card .card-block p {
    line-height: 25px;
}

@media only screen and (min-width: 1400px) {
    p {
        font-size: 14px;
    }
}

.card-block {
    padding: 1.25rem;
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0;
}

.m-b-20 {
    margin-bottom: 20px;
}

.p-b-5 {
    padding-bottom: 5px !important;
}

.card .card-block p {
    line-height: 25px;
}

.m-b-10 {
    margin-bottom: 10px;
}

.text-muted {
    color: #919aa3 !important;
}

.b-b-default {
    border-bottom: 1px solid #e0e0e0;
}

.f-w-600 {
    font-weight: 600;
}

.m-b-20 {
    margin-bottom: 20px;
}

.m-t-40 {
    margin-top: 20px;
}

.p-b-5 {
    padding-bottom: 5px !important;
}

.m-b-10 {
    margin-bottom: 10px;
}

.m-t-40 {
    margin-top: 20px;
}

.user-card-full .social-link li {
    display: inline-block;
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out
}

.title{
    font-family: 'Exo';
}

.action-btns{
    margin-top: -40px;
    margin-right: 20px;
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

@section('links')
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-start">
        <div class="title">
            <h1>Profile élève</h1>
        </div>
    </div>
    <div class="page-content page-container p-2" id="page-content">
        <div class="padding">
            <div class="row container d-flex justify-content-center">
                <div class="col-xl-12 col-md-20">
                    <div class="card user-card-full">
                        <div class="row m-l-0 m-r-0">
                            <div class="col-sm-4 bg-c-lite-green user-profile">
                                <div class="card-block text-center text-white">
                                    <div class="m-b-25"> <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image"> </div>
                                    <h6 class="f-w-600">{{ $élève->nom }} {{ $élève->prénom }}</h6>
                                    <p>Élève en {{ $élève->niveau_scolaire }}</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Nom complet</p>
                                            <h6 class="text-muted f-w-400">{{ $élève->nom }} {{ $élève->prénom }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Classe</p>
                                            <h6 class="text-muted f-w-400">{{ $élève->classe->nom_classe }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Date de naissance</p>
                                            <h6 class="text-muted f-w-400">{{ $élève->date_de_naissance }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Niveau scolaire</p>
                                            <h6 class="text-muted f-w-400">{{ $élève->niveau_scolaire }}</h6>
                                        </div>
                                    </div>
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Parents</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Nom complet du père</p>
                                            <h6 class="text-muted f-w-400">{{ $info_parent->nom_père }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Nom complet de mère</p>
                                            <h6 class="text-muted f-w-400">{{ $info_parent->nom_mère }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Fonction du père</p>
                                            <h6 class="text-muted f-w-400">{{ $info_parent->fonction_père }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Fonction de mère</p>
                                            <h6 class="text-muted f-w-400">{{ $info_parent->fonction_mère }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <h6 class="text-muted f-w-400">{{ $info_parent->email }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Tel</p>
                                            <h6 class="text-muted f-w-400">{{ $info_parent->tel }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Carte crédit</p>
                                            <h6 class="text-muted f-w-400">{{ $info_parent->card_brand }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Numéro de carte crédit</p>
                                            <h6 class="text-muted f-w-400">{{ $info_parent->card_last_four }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row float-right action-btns">
        <a href="{{ route('personnels.form_modification_profile', ['id' => $élève->id]) }}" class="btn btn-primary a-btn-slide-text">
            <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
            <span><strong>Modifier</strong></span>            
        </a>
        <a href="{{ route('personnels.supprimer_profile', ['id' => $élève->id]) }}" class="btn btn-primary a-btn-slide-text">
        <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
            <span><strong>Supprimer</strong></span>            
        </a>
	</div>
</div>
@endsection
