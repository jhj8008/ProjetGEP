@extends('layouts.admin')

@section('page_title')
{{ __('Inscription des élèves') }}
@endsection

@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<style>
    .subform-title{
        font-family: 'Quicksand', sans-serif;
        font-weight: bold;
        text-align: center;
    }

    .my_footer {
        position: absolute;
    }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Ajouter élève') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('personnels.ajouter_élève', ['id' => $parent_id]) }}">
                            @csrf
                            <div class="form-group">
                            
                                <div class="form-group row">
                                    <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom ') }}</label>

                                    <div class="col-md-6">
                                        <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autocomplete="nom" placeholder="Nom" autofocus>

                                        @error('nom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="prénom" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>

                                    <div class="col-md-6">
                                        <input id="prénom" type="text" class="form-control @error('prénom') is-invalid @enderror" name="prénom" value="{{ old('prénom') }}" required placeholder="Prénom" autocomplete="prénom" autofocus>

                                        @error('prénom')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="sexe" class="col-md-4 col-form-label text-md-right">{{ __('Sexe') }}</label>

                                    <div class="col-md-6">
                                        <select id="sexe" name="sexe" class="form-control @error('sexe') is-invalid @enderror">
                                            <option>...</option>
                                            <option value="M">Garçon</option>
                                            <option value="F">Fille</option>
                                        </select>
                                        @error('sexe')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="date_de_naissance" class="col-md-4 col-form-label text-md-right">{{ __('Date de naissance') }}</label>

                                    <div class="col-md-6">
                                        <input class="form-control @error('date_de_naissance') is-invalid @enderror" type="date" value="{{ old('date_de_naissance') }}" name="date_de_naissance">
                                        @error('date_de_naissance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="niveau_scolaire" class="col-md-4 col-form-label text-md-right">{{ __('Niveau scolaire') }}</label>

                                    <div class="col-md-6">

                                        <select id="niveau_scolaire" name="niveau_scolaire" class="form-control niveau_scolaire @error('niveau_scolaire') is-invalid @enderror">
                                            <option>Niveau</option>
                                            <option value="CP1">CP1</option>
                                            <option value="CP2">CP2</option>
                                            <option value="CE1">CE1</option>
                                            <option value="CE2">CE2</option>
                                            <option value="CM1">CM1</option>
                                            <option value="CM2">CM2</option>
                                        </select>
                                        @error('niveau_scolaire')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Ajouter') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
