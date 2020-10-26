@extends('layouts.admin')

@section('page_title')
{{ __('Fiches personnelles') }}
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
        color: white;
    }
    a {
        text-decoration: none;
    }
    h5 > i{
        font-size: 20px;
    }
</style>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1 class="title">Fiches personnelles du personnel</h1>
        @include('flash-message')
        <div class="container mb-3 mt-3">
            <table id="liste_personnels" class="table table-dark table-hover dt-responsive" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>Id de fiche</th>
                        <th>Nom complet</th>
                        <th>Carte de travail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody class="text-body">
                    @foreach($fiches as $f)
                        <tr>
                            <td class="align-middle"><strong style="color:#ffcbcb;">{{ $f->id }}</strong></td>
                            <td class="align-middle">{{ $f->employe->nom }}, {{ $f->employe->prénom }}</td>
                            <td class="align-middle">{{ $f->num_carte_travail }}</td>
                            <td>
                                <a href="{{ route('admins.voir_fiche_personnelle', ['id' => $f->id]) }}" class="btn btn-outline-secondary" title="Voir ce profile">{{ __('Voir') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Id de fiche</th>
                        <th>Nom complet</th>
                        <th>Carte de travail</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
