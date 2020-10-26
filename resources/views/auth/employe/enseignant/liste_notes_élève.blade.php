@extends('layouts.admin')

@section('page_title')
{{ __('Liste des notes') }}
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

    .nbrs {
        font-family: 'Lato', sans-serif;
        font-weight: bold;
    }

    .my_footer {
        position: absolute;
    }
</style>

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1 class="title">Liste des notes des élèves</h1>
        <div class="container mb-3 mt-3">
            <table id="liste_élèves" class="table table-hover table-bordered dt-responsive nowrap hover" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom élève</th>
                        <th>Note de l'examen 1</th>
                        <th>Note de l'examen 2</th>
                        <th>Remarque</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($notes as $note)
                            <tr>
                                <td class="align-middle"><strong style="color:#557A95;">{{ $note->elève->nom }}, {{ $note->elève->prénom }}</strong></td>
                                <td class="nbrs align-middle">{{ $note->valeur }}</td>
                                <td class="nbrs align-middle">{{ $note->valeur2 }}</td>
                                <td class="align-middle">{{ $note->remarque }}</td>
                                <td>
                                    <a href="{{ route('enseignants.page_note_élève', ['note_id' => $note->id,'id' => $note->matière_id]) }}" class="btn btn-secondary">{{ __('Modifier') }}</a>
                                </td>
                            </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nom élève</th>
                        <th>Note de l'examen 1</th>
                        <th>Note de l'examen 2</th>
                        <th>Remarque</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
