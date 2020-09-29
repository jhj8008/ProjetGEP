@extends('layouts.admin')

@section('scripts')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="htt^s://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootsrapcdn.com/bootstrap/4.3.1/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#liste_élèves').DataTable({
            "lengthChange": false,
            "ordering": true,
            "pageLength": 5,
            "language": {
                "search": "Chercher: ",
                "searchPlaceholder": "Saisir un mot clé...",
                "info": "Page _PAGE_ de _PAGES_",
                "infoEmpty": "Page 0 de 0",
                "infoFiltered": "",
                "zeroRecords": "Aucun résultat trouvé",
                "paginate": {
                    "first": "Premier",
                    "previous": "Précédent",
                    "next": "Suivant", 
                    "last": "Dernier",
                }
            },
        });
    });
</script>
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
    background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
    background: linear-gradient(to right, #ee5a6f, #f29263);
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
    display: inline-block
}

.user-card-full .social-link li a {
    font-size: 20px;
    margin: 0 10px 0 0;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out
}

/* Style du tableau des absences et retards */

.dataTables_filter{
    float: right;
    text-align: right;
}
.table{
    font-family: 'Raleway', sans-serif;
}
.dataTables_filter input[type="search"]{ 
    width: 350px; 
    display:inline-block;
    margin-left: 5px;
}
.title{
    font-family: 'Nunito', sans-serif;
    color: #636b6f;
}
td, th{
    text-align: center;
}
a {
    text-decoration: none;
}
h5 > i{
    font-size: 20px;
}

.fa-absence{
    color:white !important;
    margin-left: -15px;
    margin-top: -5px;
}

.btn-circle {
    text-decoration: none;
    padding-right: 10px;
    border-radius: 50% !important;
    width: 50px;
    height: 50px;
    padding: 6px 0px;
    border-radius: 15px;
    text-align: center !important;
    font-size: 12px;
    line-height: 1.42857;
}

.header-text{
    text-align: center;
}
</style>
@endsection

@section('content')

<div class="container">
    <div class="row justify-content-start">
        <div class="title">
            <h1>Profile</h1>
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
                                    </div>
                                    <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Parents</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <h6 class="text-muted f-w-400">{{ $élève->elèveparent->email }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Tel</p>
                                            <h6 class="text-muted f-w-400">{{ $élève->elèveparent->tel }}</h6>
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

    <div class="row justify-content-center">
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>    
                <strong>{{ $message }}</strong>
            </div>
        @endif
        <div class="col-md-8 offset-md-4">
            <ul class="list-inline m-0">
                <li class="list-inline-item">
                    <a class="btn btn-primary" href="{{ route('enseignants.ajouter_negligence', ['classe_id' => $classe_id, 'id' => $élève_id]) }}">{{ __('Ajouter une négligence') }}</a>
                </li>
                <li class="list-inline-item">
                    <a class="btn btn-dark" href="{{ route('enseignants.liste_absence', $classe_id) }}">{{ __('Retour à la liste des élèves') }}</a>
                </li>
            </ul>
        </div>
        <div class="container mb-3 mt-3">
            <table id="liste_élèves" class="table table-striped table-bordered dt-responsive nowrap hover" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th class="header-text">Type de négligence</th>
                        <th class="header-text">Date</th>
                        <th class="header-text">Durée</th>
                        <th class="header-text">Période</th>
                        <th class="header-text">Séance</th>
                        <th class="header-text">Raison</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($élève->negligences as $negligence)
                        <tr>
                            <td>{{ $negligence->type }}</td>
                            <td>{{ $negligence->date }}</td>
                            <td>{{ $negligence->durée }}</td>
                            <td>{{ $negligence->période }}</td>
                            <td>{{ $negligence->matière->nom }}</td>
                            <td>{{ $negligence->raison }}</td>
                            <td>
                                <ul class="list-inline m-0">
                                    <li class="list-inline-item">
                                        <a class="btn btn-success btn-circle" href="{{ route('enseignants.ouvrir_negligence', ['classe_id' => $classe_id, 'élève_id' => $élève_id, 'id' => $negligence->id]) }}" title="Modifier"><i class="fa fa-edit fa-absence"></i></a>
                                    </li>
                                    <li class="list-inline-item">
                                        <!-- class = btn btn-default btn-sm rounded-0 -->
                                        <button class="btn btn-danger btn-circle" type="button" data-toggle="modal" data-target="{{ '#supprimer'.$negligence->id }}" title="Supprimer"><i class="fa fa-trash fa-absence"></i></button>
                                    </li>
                                </ul>

                                <div class="modal fade" id="{{'supprimer'.$negligence->id}}" tabindex="-1" role="dialog" aria-labelledby="{{ 'ScrollableTitleSupprimer'.$negligence->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="{{ 'ScrollableTitleSupprimer'.$negligence->id }}">Supprimer {{ $negligence->type }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Est-ce que vous pouvez confirmer cette suppression ?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <a href="{{ route('enseignants.supprimer_negligence', ['classe_id' => $classe_id, 'élève_id' => $élève_id, 'id' => $negligence->id]) }}" class="btn btn-primary">Supprimer</a>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="header-text">Type de négligence</th>
                        <th class="header-text">Date</th>
                        <th class="header-text">Durée</th>
                        <th class="header-text">Période</th>
                        <th class="header-text">Séance</th>
                        <th class="header-text">Raison</th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>        
    </div>
</div>

@endsection
