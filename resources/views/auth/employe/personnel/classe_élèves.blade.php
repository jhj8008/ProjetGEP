<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="icon" href="{{ URL::asset('imgs/school.png') }}" type="image/x-icon"/>
    <title>Liste des élèves</title>
    <style>
        @font-face {
            font-family:Rockwell;
            src: url('/fonts/rockb.ttf') format('ttf');
            font-style: normal;
            font-weight: normal;
        }
        html, body {
            background-color: #fff;
            margin: 0;
            scroll-behavior: smooth;
            overflow: auto;
        }

        body{
            position: relative;
            display: grid;
            margin-bottom: 0 !important;
        }
        .logoText{
            text-align: center;
            font-family: Monoton;
            font-size: 35px !important;
            letter-spacing: 0.1rem;
        }
        .card{
            font-family: Rockwell;
            margin-bottom: 1.5rem;
        }

        .infos-élève{
            margin-top: 20px;
            margin-left: 1.5rem;
        }

        .title{
            font-family: Rockwell;
            color: #636b6f;
            margin-left: 100px;
        }
        th{
            font-size: 15px;
        }

        td {
            font-size: 13px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row logoText">
        GEP
    </div>
    <div class="card">
        <div class="card-header">
            <span class="float-right"><strong>Classe: </strong>{{ $classe_nom }}</span>
        </div>
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-hover" style="table-layout:fixed;">
                    <thead>
                        <tr>
                            <th class="center">#</th>
                            <th class="center">Prénom et nom</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($élèves as $élève)
                            <tr>
                                <td class="center"> {{ $élève->id }}</td>
                                <td class="center"> {{ $élève->prénom . ' ' . $élève->nom }} </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="title">
            <strong>Année scolaire: </strong> 2020/2021
        </div>
    </div>
</div>
</body>
</html>
