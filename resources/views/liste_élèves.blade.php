@extends('layouts.app')

@section('page_title')
{{ __('Liste des élèves') }}
@endsection

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
            stateSave: true,
            "language": {
                "search": "Chercher: ",
                "emptyTable": "Aucun résultat",
                "searchPlaceholder": "Saisir un mot clé...",
                "info": "Page _PAGE_ de _PAGES_",
                "infoEmpty": "Page 0 de 0 sur 0",
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

<style>
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
    .profile-img{
        /*width: 70px;
        height: 80px;*/
    }

    .my_footer {
        position: absolute;
    }
</style>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container mb-3 mt-3">
            <table id="liste_élèves" class="table table-hover table-bordered dt-responsive nowrap hover" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>Niveau</th>
                        <th>Nom élève</th>
                        <th>Profile</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($élèves as $élève)
                        <tr>
                            <td class="align-middle"><strong style="color:#557A95;">{{ $élève->niveau_scolaire }}</strong></td>
                            <td class="align-middle">{{ $élève->nom }}, {{ $élève->prénom }}</td>
                            <td>
                                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="{{'#exampleModalScrollable'.$élève->id}}">
                                    {{ __('Voir profile') }}
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="{{'exampleModalScrollable'.$élève->id}}" tabindex="-1" role="dialog" aria-labelledby="{{ 'ScrollableTitle'.$élève->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="{{ 'ScrollableTitle'.$élève->id }}"><i class="fa fa-user fa-5x"></i>&nbsp;&nbsp;&nbsp;Profile élève</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="profile-img">
                                                    <img src="{{ asset('imgs/user_profile.png') }}" class="rounded-circle" width="204" height="215" alt="Cinque Terre">
                                                </div>
                                                <dl class="row justify-content-center">
                                                    <dt class="col-sm-4">{{ __('ID de l\'élève ') }}</dt>
                                                    <dd class="col-sm-5">{{ $élève->id }}</dd>
                                                    
                                                    <dt class="col-sm-4">{{ __('Nom complet') }}</dt>
                                                    <dd class="col-sm-5">{{ $élève->nom }}, {{ $élève->prénom }}</dd>
                                                
                                                    <dt class="col-sm-4">{{ __('Sexe') }}</dt>
                                                    <dd class="col-sm-5">
                                                        @if($élève->sexe == 'M')
                                                            {{ 'Garçon' }}
                                                        @else
                                                            {{ 'Fille' }}
                                                        @endif
                                                    </dd>

                                                    <dt class="col-sm-4">{{ __('Date de naissance') }}</dt>
                                                    <dd class="col-sm-5">{{ $élève->date_de_naissance }}</dd>

                                                    <dt class="col-sm-4">{{ __('Niveau scolaire') }}</dt>
                                                    <dd class="col-sm-5">{{ $élève->niveau_scolaire }}</dd>

                                                    <dt class="col-sm-4">{{ __('Nom père') }}</dt>
                                                    <dd class="col-sm-5">{{ $élève->elèveparent->nom_père }}</dd>

                                                    <dt class="col-sm-4">{{ __('Nom mère') }}</dt>
                                                    <dd class="col-sm-5">{{ $élève->elèveparent->nom_mère }}</dd>
                                                </dl>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
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
                        <th>Niveau</th>
                        <th>Nom élève</th>
                        <th>Profile</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
