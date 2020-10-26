@extends('layouts.app')

@section('page_title')
{{ __('Cahier de texte') }}
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
        $('#liste_tâches').DataTable({
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

    .my_footer {
        position: absolute;
    }
</style>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="container mb-3 mt-3">
            <table id="liste_tâches" class="table table-hover table-bordered dt-responsive nowrap hover" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>À faire</th>
                        <th>Fait</th>
                        <th>Cours</th>
                        <th>Niveau</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cahiers as $ct)
                            <tr>
                                <td class="align-middle"><strong style="color:#557A95;">{{ $ct->date_publication }}</strong></td>
                                <td class="align-middle">{{ $ct->a_faire }}</td>
                                <td class="align-middle">{{ $ct->fait }}</td>
                                <td class="align-middle">{{ $ct->cours }}</td>
                                <td class="align-middle">{{ $ct->niveau_scolaire }}</td>
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
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
