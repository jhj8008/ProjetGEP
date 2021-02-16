@extends('layouts.admin')

@section('page_title')
{{ __('Profile parent') }}
@endsection

@section('scripts')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#liste_élèves').DataTable({
            "lengthChange": false,
            "ordering": true,
            "pageLength": 5,
            stateSave: true,
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

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#ajouterElèveForm').on('submit', function(event){
            event.preventDefault();
            $('#nom_error').text('');
            $('#prénom_error').text('');
            $('#sexe_error').text('');
            $('#date_de_naissance_error').text('');

            nom = $('#nom').val();
            prénom = $('#prénom').val();
            sexe = $('#sexe').val();
            date_de_naissance = $('#date_de_naissance').val();
            niveau_scolaire = $('#niveau_scolaire').val();

            $.ajax({
                url: "{{ route('personnels.ajouter_élève', ['id' => $parent->id]) }}",
                type: "POST",
                dataType: 'JSON',
                data: {
                    nom: nom,
                    prénom: prénom,
                    sexe: sexe,
                    date_de_naissance: date_de_naissance,
                    niveau_scolaire: niveau_scolaire,
                },
                success: function(response){
                    if($.isEmptyObject(response.errors)){
                        var t = $('#liste_élèves').DataTable();
                        t.row.add([
                            response.id,
                            response.nom + ', ' + response.prénom,
                            response.sexe,
                            response.niveau_scolaire,
                        ]);
                        $('#success-container').show();
                        $('#success-msg').text(response.success);
                        $('#ajouterElèveForm')[0].reset();

                        $('#nom').removeClass('is-invalid');
                        $('#prénom').removeClass('is-invalid');
                        $('#sexe').removeClass('is-invalid');
                        $('#date_de_naissance').removeClass('is-invalid');
                        $('#niveau_scolaire').removeClass('is-invalid');

                        /*$('#formAjouterElève').modal('toggle');*/
                        $('#formAjouterElève').removeClass('in');
                        $(".modal-backdrop").remove();
                        $('#formAjouterElève').modal('hide');
                        /*$('#modal-close').fadeOut(500, function(){
                            $('#modal-close').modal('hide');
                        });*/
                    }else {
                        if(typeof response.errors.nom !== 'undefined'){
                            $('#nom').addClass('is-invalid');
                            $('#nom_error').show().text(response.errors.nom);
                        }

                        if(response.errors.prénom) {
                            $('#prénom').addClass('is-invalid');
                            $('#prénom_error').show().text(response.errors.prénom);
                        }
                        if(response.errors.sexe){
                            $('#sexe').addClass('is-invalid');
                            $('#sexe_error').text(response.errors.sexe);
                        }
                        if(response.errors.date_de_naissance){
                            $('#date_de_naissance').addClass('is-invalid');
                            $('#date_de_naissance_error').text(response.errors.date_de_naissance);
                        }

                        if(response.errors.niveau_scolaire){
                            $('#niveau_scolaire').addClass('is-invalid');
                            $('#niveau_scolaire_error').text(response.errors.niveau_scolaire);    
                        }
                    }
                },
                error: function(response) {
                    console.log('Something is wrong');
                }
            });
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
                                    <h6 class="f-w-600">Parent ID</h6>
                                    <p>{{ $parent->id }}</p> <i class=" mdi mdi-square-edit-outline feather icon-edit m-t-10 f-16"></i>
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="card-block">
                                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Nom pére</p>
                                            <h6 class="text-muted f-w-400">{{ $parent->nom_père }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Nom mère</p>
                                            <h6 class="text-muted f-w-400">{{ $parent->nom_mère }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Fonction du père</p>
                                            <h6 class="text-muted f-w-400">{{ $parent->fonction_père }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Fonction de mère</p>
                                            <h6 class="text-muted f-w-400">{{ $parent->fonction_mère }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Tél</p>
                                            <h6 class="text-muted f-w-400">{{ $parent->tel }}</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <p class="m-b-10 f-w-600">Email</p>
                                            <h6 class="text-muted f-w-400">{{ $parent->email }}</h6>
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
        
        <div id="success-container" class="alert alert-success alert-block" role="alert" hidden>
            <button type="button" class="close" data-dismiss="alert">×</button>    
            <span id="success-msg"></span>
        </div>
        <div class="container mb-3 mt-3">
            <table id="liste_élèves" class="table table-hover table-bordered dt-responsive nowrap hover" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th class="header-text">Id</th>
                        <th class="header-text">Nom complet</th>
                        <th class="header-text">Sexe</th>
                        <th class="header-text">Niveau</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($parent->elèves as $elève)
                        <tr>
                            <td class="align-middle">{{ $elève->id }}</td>
                            <td class="align-middle">{{ $elève->nom }}, {{ $elève->prénom }}</td>
                            <td class="align-middle">{{ $elève->sexe }}</td>
                            <td class="align-middle">{{ $elève->niveau_scolaire }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="header-text">Id</th>
                        <th class="header-text">Nom complet</th>
                        <th class="header-text">Sexe</th>
                        <th class="header-text">Niveau</th>
                    </tr>
                </tfoot>
            </table>
        </div>      
        <div class="row justify-content-center action-btns">
            <!--<a href="{{ route('personnels.form_ajouter_élève', ['id' => $parent->id]) }}" class="btn btn-primary a-btn-slide-text">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <span><strong>Ajouter un enfant</strong></span>            
            </a>-->
            <button type="button" class="btn btn-primary a-btn-slide-text" data-toggle="modal" data-target="#formAjouterElève">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <span><strong>Nouveau enfant</strong></span>            
            </button>
            <a href="{{ route('personnels.liste_parents') }}" class="btn btn-primary a-btn-slide-text">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <span><strong>Retourner à la liste des parents</strong></span>            
            </a>
        </div>  

        <!-- Creating a modal -->
        <div class="modal fade" id="formAjouterElève" tabindex="-1" role="dialog" aria-labelledby="formAjouterElèveLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="formAjouterElèveLabel">Ajouter un nouvel enfant</h5>
                        <button type="button" id="modal-close" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" id="ajouterElèveForm">
                            @csrf
                            <div class="form-group">
                            
                                <div class="form-group row">
                                    <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom ') }}</label>

                                    <div class="col-md-6">
                                        <input id="nom" type="text" class="form-control" name="nom" value="{{ old('nom') }}" autocomplete="nom" placeholder="Nom" autofocus>
                                        <span id="nom_error" class="invalid-feedback" role="alert"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="prénom" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>

                                    <div class="col-md-6">
                                        <input id="prénom" type="text" class="form-control" name="prénom" value="{{ old('prénom') }}" placeholder="Prénom" autocomplete="prénom" autofocus>

                                        <span id="prénom_error" class="invalid-feedback" role="alert"></span>
                                        
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sexe" class="col-md-4 col-form-label text-md-right">{{ __('Sexe') }}</label>

                                    <div class="col-md-6">
                                        <select id="sexe" name="sexe" class="form-control">
                                            <option value="">...</option>
                                            <option value="M">Garçon</option>
                                            <option value="F">Fille</option>
                                        </select>
                                        <span class="invalid-feedback" id="sexe_error" role="alert"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="date_de_naissance" class="col-md-4 col-form-label text-md-right">{{ __('Date de naissance') }}</label>

                                    <div class="col-md-6">
                                        <input id="date_de_naissance" class="form-control" type="date" value="{{ old('date_de_naissance') }}" name="date_de_naissance">
                                        <span id="date_de_naissance_error" class="invalid-feedback" role="alert"></span>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="niveau_scolaire" class="col-md-4 col-form-label text-md-right">{{ __('Niveau scolaire') }}</label>

                                    <div class="col-md-6">
                                        <select id="niveau_scolaire" name="niveau_scolaire" class="form-control">
                                            <option value="">Niveau</option>
                                            <option value="CP1">CP1</option>
                                            <option value="CP2">CP2</option>
                                            <option value="CE1">CE1</option>
                                            <option value="CE2">CE2</option>
                                            <option value="CM1">CM1</option>
                                            <option value="CM2">CM2</option>
                                        </select>
                                        <span class="invalid-feedback" role="alert" id="niveau_scolaire_error">
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary btn-submit">
                                        {{ __('Ajouter') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
