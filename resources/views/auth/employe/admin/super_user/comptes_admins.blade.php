@extends('layouts.admin')

@section('page_title')
    {{ __('Liste des comptes admin') }}
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
        $('#liste_personnels').DataTable({
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
        /*color: white;*/
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
        @if($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="row float-left action-btns">
            <a href="{{ route('admins.form_ajouter_admin') }}" class="btn btn-primary a-btn-slide-text">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <span><strong>Nouveau compte personnel</strong></span>            
            </a>
        </div>
        <div class="container mb-3 mt-3">
            <table id="liste_personnels" class="table table-hover dt-responsive" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom complet</th>
                        <th>Sexe</th>
                        <th>Date de naissance</th>
                        <th>E-mail</th>
                        <th>Tel</th>
                        <th>Adresse</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-body">
                    @foreach($admins as $personnel)
                        <tr>
                            <td class="align-middle"><strong style="color:#ffcbcb;">{{ $personnel->id }}</strong></td>
                            <td class="align-middle">{{ $personnel->nom }}, {{ $personnel->prénom }}</td>
                            <td class="align-middle">
                                @if($personnel->sexe == 'M')
                                    {{ __('Homme') }}
                                @else
                                    {{ __('Femme') }}
                                @endif
                            </td>
                            <td class="align-middle">{{ $personnel->date_de_naissance }}</td>
                            <td class="align-middle">{{ $personnel->email }}</td>
                            <td class="align-middle">{{ $personnel->tel }}</td>
                            <td class="align-middle">{{ $personnel->adresse }}</td>
                            <td>
                                <!--<a href="" class="btn btn-outline-secondary" title="Voir ce profile">{{ __('Voir') }}</a>-->
                                <div class="btn-group" role="group" aria-label="action_buttons">
                                    <a href="{{ route('admins.form_modifier_admin', ['id' => $personnel->id]) }}" class="btn btn-secondary">{{ __('Modifier') }}</a>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="{{ '#delete'.$personnel->id }}" title="Supprimer">{{ __('Supprimer') }}</button>
                                </div>
                            </td>
                        </tr>
                        <div class="modal fade" id="{{ 'delete'.$personnel->id }}" tabindex="-1" role="dialog" aria-labelledby="{{ 'ScrollableTitleDelete'.$personnel->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="{{ 'ScrollableTitleDelete'.$personnel->id }}">Supprimer compte</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Est-ce que vous êtes sûre ?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <a href="{{ route('admins.supprimer_admin', ['id' => $personnel->id]) }}" class="btn btn-primary">Oui, supprimer</a>
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
                        <th>Nom complet</th>
                        <th>Sexe</th>
                        <th>Date de naissance</th>
                        <th>E-mail</th>
                        <th>Tel</th>
                        <th>Adresse</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
