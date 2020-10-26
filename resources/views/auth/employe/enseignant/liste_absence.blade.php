@extends('layouts.admin')

@section('page_title')
{{ __('Liste des absences') }}
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
        <div class="container mb-3 mt-3">
            <table id="liste_élèves" class="table table-hover table-bordered dt-responsive nowrap hover" cellspacing="0" style="width:100%">
                <thead>
                    <tr>
                        <th>Nom élève</th>
                        <th>Sexe</th>
                        <th>Nbr des absences et retards</th>
                        <th>Absences et retards</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($élèves as $élève)
                        <tr>
                            <td class="align-middle"><strong style="color:#557A95;">{{ $élève->nom }}, {{ $élève->prénom }}</strong></td>
                            <td title="Sexe" class="align-middle">{{ $élève->sexe }}</td>
                            <td class="nbrs align-middle">
                                @if(count($élève->negligences) > 0) 
                                    {{ count($élève->negligences) }}
                                @else  
                                    {{ __('Aucune') }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('enseignants.profile_absence', ['classe_id' => $classe_id, 'id' => $élève->id]) }}" class="btn btn-secondary">{{ __('Continuer') }}</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Nom élève</th>
                        <th>Sexe</th>
                        <th>Nbr des absences et retards</th>
                        <th>Absences et retards</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
