<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulletin de {{ $élève->nom }}, {{ $élève->prénom }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="icon" href="{{ URL::asset('imgs/school.png') }}" type="image/x-icon"/>
    <title>{{ config('app.name', 'GEP') }}</title>
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
        {{ config('app.name') }}
    </div>
    <div class="row justify-content-center">
        <div class="title">
            <h3>Bulletin des notes</h3>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <span class="float-right"> <strong>Date de publication:</strong> {{ $date }}</span>
        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <div class="infos-élève">
                        <div>
                            <strong>Nom: </strong>{{ $élève->nom }} {{ $élève->prénom }}
                        </div>
                        <div>
                            <strong>Sexe: </strong>
                            @if($élève->sexe == 'M')
                                {{ __('Garçon') }}
                            @else
                                {{ __('Fille') }}
                            @endif
                        </div>
                        <div><strong>Niveau: </strong>{{ $élève->niveau_scolaire }}</div>
                        <div>
                            <strong>Classe: </strong>{{ $élève->classe->nom_classe }}
                        </div>
                        <div><strong>Numéro: </strong>{{ $élève->id }}</div>
                        <div><strong>Nombre des élèves: </strong>{{ $nbr_élève }}</div>
                    </div>
                </div>
            </div>

            <div class="table-responsive-sm">
                <table class="table table-striped" style="table-layout:fixed;">
                    <thead>
                        <tr>
                            <th class="center">Matière</th>
                            <th class="left">Note de l'examen 1</th>
                            <th class="left">Note de l'examen 2</th>
                            <th>Coefficient</th>
                            <th class="left">Coefficient x (N1 + N2 / 2)</th>
                            <th>Remarque</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($notes as $note)
                            <tr>
                                <td class="center"> {{ $note->matière->nom }}</td>
                                <td class="left"> {{ $note->valeur }}</td>
                                <td class="left"> {{ $note->valeur2 }}</td>
                                <td> {{ $note->matière->coefficient }}</td>
                                <td class="left">{{ $coef_note[$note->id] }}</td>
                                <td> {{ $note->remarque }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5"></div>

                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear" style="table-layout:fixed;">
                        <tbody>
                            <tr>
                                <td class="left">
                                <strong>Total Coefficient x (N1 + N2 / 2)</strong>
                                </td>
                                <td class="right">{{ $sum_coef_note }}</td>
                            </tr>
                            <tr>
                                <td class="left">
                                <strong>Total des coefficients</strong>
                                </td>
                                <td class="right">{{ $sum_coef }}</td>
                            </tr>
                            <tr>
                                <td class="left">
                                <strong>Moyenne générale</strong>
                                </td>
                                <td class="right">{{ $moyenne }}</td>
                            </tr>
                            <tr>
                                <td class="left">
                                <strong>Nombre des absences</strong>
                                </td>
                                <td class="right">
                                <strong>{{ $nbr_absence }}</strong>
                                </td>
                            </tr>
                            <tr>
                                <td class="left">
                                <strong>Nombre des retards</strong>
                                </td>
                                <td class="right">
                                <strong>{{ $nbr_retard }}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="title">
            <strong>Directeur d'établissement: </strong> Moustapha Alami
        </div>
    </div>
</div>
</body>
</html>
