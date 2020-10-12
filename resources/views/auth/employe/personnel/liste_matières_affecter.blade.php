@extends('layouts.admin')

@section('page_title')
 {{ __('Liste des matières') }}
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
        $('#liste_matières').DataTable({
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
            <button type="button" class="btn btn-primary a-btn-slide-text" data-toggle="modal" data-target="#ajouterMatière">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <span><strong>Ajouter une classe</strong></span>            
            </button>
        </div>

        <div class="modal fade" id="ajouterMatière" tabindex="-1" role="dialog" aria-labelledby="ScrollableAjouterMatière" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ScrollableAjouterMatière">Ajouter une matière</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('personnels.ajouter_matière', ['ensg_id' => $enseignant_id]) }}">
                            @csrf
                            <div class="form-group row">
                                <label for="matière" class="col-md-4 col-form-label text-md-right">{{ __('Matières') }}</label>

                                <div class="col-md-6">
                                    <select id="matière" name="matière" class="form-control @error('matière') is-invalid @enderror">
                                        @foreach($matières_non_existantes as $mne)
                                            <option value="{{ $mne->id }}">{{ $mne->nom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Ajouter') }}
                                    </button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="container mb-3 mt-3">
            <table id="liste_matières" class="table table-dark table-hover dt-responsive" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Matière</th>
                        <th>Coefficient</th>
                        <th>Nbr d'heures</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-body">
                    @foreach($matières as $matière)
                        <tr>
                            <td class="align-middle"><strong style="color:#ffcbcb;">{{ $matière->id }}</strong></td>
                            <td class="align-middle">{{ $matière->nom }}</td>
                            <td class="align-middle">{{ $matière->coefficient }}</td>
                            <td class="align-middle">{{ $matière->nbr_heures }}</td>
                            <td>
                                <!--<a href="" class="btn btn-outline-secondary" title="Voir ce profile">{{ __('Voir') }}</a>-->
                                <div class="btn-group" role="group" aria-label="action_buttons">
                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="{{ '#delete'.$matière->id }}" title="Supprimer">{{ __('Supprimer') }}</button>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="{{ 'delete'.$matière->id }}" tabindex="-1" role="dialog" aria-labelledby="{{ 'ScrollableTitleDelete'.$matière->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="{{ 'ScrollableTitleDelete'.$matière->id }}">Supprimer classe</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Est-ce que vous êtes sûre ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('personnels.supprimer_matière_enseignant', ['id' => $matière->id, 'ensg_id' => $enseignant_id]) }}" class="btn btn-primary">Oui, supprimer</a>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Matière</th>
                        <th>Coefficient</th>
                        <th>Nbr d'heures</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
