@extends('layouts.admin')

@section('scripts')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="htt^s://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<title>Cahier de texte de  {{ $matière->nom }}</title>
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
            stateSave: true,
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

<style>
    .dataTables_filter{
        float: right;
        text-align: right;
    }
    .table{
        font-family: 'Lato', sans-serif;
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

    .nbrs {
        font-family: 'Lato', sans-serif;
        font-weight: bold;
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
    th{
        font-size: 15px;
    }

    td {
        font-size: 13px;
    }
</style>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1 class="title">Cahier de texte de  {{ $matière->nom }}</h1>
        <div class="container mb-3 mt-3">
            <ul class="list-inline m-0">
                <li class="list-inline-item">
                    <a class="btn btn-primary" href="{{ route('enseignants.créer_tache_cahier', ['matId' => $matId, 'classe_id' => $classe_id]) }}">{{ __('Ajouter une ligne') }}</a>
                </li>
                <li class="list-inline-item">
                    <a class="btn btn-dark" href="{{ route('enseignants.liste_classes_cahier', ['id' => $matId]) }}">{{ __('Retour à la page des classes') }}</a>
                </li>
                <li class="list-inline-item">
                    <a class="btn btn-dark" href="{{ route('enseignants.cahiers_texte') }}">{{ __('Retour à la page des matières') }}</a>
                </li>
            </ul>
            <table id="liste_élèves" class="table table-striped table-bordered dt-responsive nowrap hover" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>À faire</th>
                        <th>Fait</th>
                        <th>Cours</th>
                        <th>Niveau</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cahier_texte as $ct)
                            <tr>
                                <td class="align-middle"><strong style="color:#557A95;">{{ $ct->date_publication }}</strong></td>
                                <td class="align-middle">{{ $ct->a_faire }}</td>
                                <td class="align-middle">{{ $ct->fait }}</td>
                                <td class="align-middle">{{ $ct->cours }}</td>
                                <td class="align-middle">{{ $ct->niveau_scolaire }}</td>
                                <td>
                                    <ul class="list-inline m-0">
                                        <li class="list-inline-item">
                                            <a class="btn btn-success btn-circle" href="{{ route('enseignants.ouvrir_tache_cahier', ['classe_id' => $classe_id, 'matId' => $matId, 'id' => $ct->id]) }}" title="Modifier"><i class="fa fa-edit fa-absence"></i></a>
                                        </li>
                                        <li class="list-inline-item">
                                            <!-- class = btn btn-default btn-sm rounded-0 -->
                                            <button class="btn btn-danger btn-circle" type="button" data-toggle="modal" data-target="{{ '#supprimer'.$ct->id }}" title="Supprimer"><i class="fa fa-trash fa-absence"></i></button>
                                        </li>
                                    </ul>

                                    <div class="modal fade" id="{{'supprimer'.$ct->id}}" tabindex="-1" role="dialog" aria-labelledby="{{ 'ScrollableTitleSupprimer'.$ct->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="{{ 'ScrollableTitleSupprimer'.$ct->id }}">Supprimer ligne</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Est-ce que vous êtes sûre ?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="{{ route('enseignants.supprimer_tache_cahier', ['classe_id' => $classe_id, 'matId' => $matId, 'id' => $ct->id]) }}" class="btn btn-primary">Supprimer</a>
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
                        <th>Date</th>
                        <th>À faire</th>
                        <th>Fait</th>
                        <th>Cours</th>
                        <th>Niveau</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
            @if($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>    
                    <strong>{{ $message }}</strong>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
