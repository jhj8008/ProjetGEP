@extends('layouts.admin')

@section('page_title')
 {{ __('Emplois du temps') }}
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
        $('#liste_negligences').DataTable({
            "lengthChange": false,
            "ordering": true,
            "pageLength": 10,
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
    .text-body{
        font-family: 'Montserrat', sans-serif;

    }
    .title{
        font-family: 'Nunito', sans-serif;
        color: #636b6f;
    }
    td, th{
        text-align: center;
    }

    th {
        font-size: 15px;
    }

    td {
        font-size: 13px;
        color: white;
    }
    a {
        text-decoration: none;
    }
    h5 > i{
        font-size: 20px;
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
    <div class="row justify-content-center">
        <div class="row float-left action-btns">
            <a href="{{ route('personnels.form_ajouter_negligence', ['ensg_id' => $enseignant_id]) }}" class="btn btn-primary a-btn-slide-text">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <span><strong>Ajouter une absence ou un retard</strong></span>            
            </a>
            <a href="{{ route('personnels.gestion_negligences_enseignant') }}" class="btn btn-primary a-btn-slide-text">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <span><strong>Retour à la liste des enseignants</strong></span>            
            </a>
        </div>
        <div class="container mb-3 mt-3">
            <table id="liste_negligences" class="table table-dark table-hover dt-responsive" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th class="header-text">Type de négligence</th>
                        <th class="header-text">Date</th>
                        <th class="header-text">Durée</th>
                        <th class="header-text">Période</th>
                        <th class="header-text">Raison</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-body">
                    @foreach($negligences as $negligence)
                        <tr>
                            <td class="align-middle">{{ ucfirst($negligence->type) }}</td>
                            <td class="align-middle">{{ $negligence->date }}</td>
                            <td class="align-middle">{{ $negligence->durée }}</td>
                            <td class="align-middle">{{ $negligence->période }}</td>
                            <td class="align-middle">{{ $negligence->raison }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="action_buttons">
                                <a class="btn btn-outline-secondary" href="{{ route('personnels.form_modifier_negligence', ['ensg_id' => $enseignant_id, 'id' => $negligence->id]) }}" title="Modifier">{{ __('Modifier') }}</a>
                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="{{ '#supprimer'.$negligence->id }}" title="Supprimer">{{ __('Supprimer') }}</button>
                                </div>
                                
                            </td>
                        </tr>

                        <div class="modal fade" id="{{'supprimer'.$negligence->id}}" tabindex="-1" role="dialog" aria-labelledby="{{ 'ScrollableTitleSupprimer'.$negligence->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="{{ 'ScrollableTitleSupprimer'.$negligence->id }}">Oui, supprimer</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Est-ce que vous êtes sure ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('personnels.supprimer_negligence', ['ensg_id' => $enseignant_id, 'id' => $negligence->id]) }}" class="btn btn-primary">Supprimer</a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th class="header-text">Type de négligence</th>
                        <th class="header-text">Date</th>
                        <th class="header-text">Durée</th>
                        <th class="header-text">Période</th>
                        <th class="header-text">Raison</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
