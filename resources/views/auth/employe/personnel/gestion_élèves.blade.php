@extends('layouts.admin')

@section('page_title')
{{ __('Gestion des élèves') }}
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
            saveState: true,
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

    .my_footer {
        position: absolute;
    }
</style>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row float-left action-btns">
            <a href="{{ route('personnels.liste_classes') }}" class="btn btn-primary a-btn-slide-text">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <span><strong>Liste des classes</strong></span>            
            </a>

            <a href="{{ route('personnels.liste_parents') }}" class="btn btn-primary a-btn-slide-text">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <span><strong>Liste des parents</strong></span>            
            </a>
        </div>
        <div class="container mb-3 mt-3">
            <!-- table table-dark table-hover | table table-striped table-bordered dt-responsive nowrap hover -->
            <table id="liste_élèves" class="table table-dark table-hover dt-responsive" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nom élève</th>
                        <th>Sexe</th>
                        <th>Niveau scolaire</th>
                        <th>Profile</th>
                    </tr>
                </thead>
                <tbody class="text-body">
                    @foreach($élèves as $élève)
                        <tr>
                            <td class="align-middle"><strong style="color:#ffcbcb;">{{ $élève->id }}</strong></td>
                            <td class="align-middle">{{ $élève->nom }}, {{ $élève->prénom }}</td>
                            <td class="align-middle">
                                @if($élève->sexe == 'M')
                                    {{ 'Garçon' }}
                                @else
                                    {{ 'Fille' }}
                                @endif
                            </td>
                            <td class="align-middle">{{ $élève->niveau_scolaire }}</td>
                            <td>
                                <a href="{{ route('personnels.profile_élève', ['id' => $élève->id]) }}" class="btn btn-outline-secondary" title="Voir ce profile">{{ __('Voir') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id</th>
                        <th>Nom élève</th>
                        <th>Sexe</th>
                        <th>Niveau scolaire</th>
                        <th>Profile</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
