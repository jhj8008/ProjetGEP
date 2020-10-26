@extends('layouts.admin')

@section('page_title')
{{ __('Modifier profile élève') }}
@endsection

@section('styles')
<style>
    .title{
        font-family: 'Exo';
        text-align: center;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modifier profile') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('personnels.modifier_profile', ['id' => $élève_id, 'parent_id' => $parent_id]) }}">
                        @csrf
                        <div class="justify-content-center">
                            <div class="title">
                                <h3 class="subtitle">Informations de l'élève</h3>
                            </div>
                        </div>          
                        <div class="form-group row">
                            <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" value="{{ $élève->nom }}" name="nom" required>
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
                                <input type="text" class="form-control @error('prénom') is-invalid @enderror" value="{{ $élève->prénom }}" name="prénom" required>
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
                                    <option value="M" @if($élève->sexe == 'M') selected @endif>Male</option>
                                    <option value="F" @if($élève->sexe == 'F') selected @endif>Femelle</option>
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
                                <input class="form-control @error('date_de_naissance') is-invalid @enderror" type="date" name="date_de_naissance" value="{{ $élève->date_de_naissance }}">
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
                                <select name="niveau_scolaire" class="form-control @error('niveau_scolaire') is-invalid @enderror">
                                    <option>...</option>
                                    <option value="CP1" @if($élève->niveau_scolaire == 'CP1') selected @endif>CP1</option>
                                    <option value="CP2" @if($élève->niveau_scolaire == 'CP2') selected @endif>CP2</option>
                                    <option value="CE1" @if($élève->niveau_scolaire == 'CE1') selected @endif>CE1</option>
                                    <option value="CE2" @if($élève->niveau_scolaire == 'CE2') selected @endif>CE2</option>
                                    <option value="CM1" @if($élève->niveau_scolaire == 'CM1') selected @endif>CM1</option>
                                    <option value="CM2" @if($élève->niveau_scolaire == 'CM2') selected @endif>CM2</option>
                                </select>
                                @error('niveau_scolaire')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="classe" class="col-md-4 col-form-label text-md-right">{{ __('Classe') }}</label>

                            <div class="col-md-6">
                                <select name="classe" class="form-control @error('classe') is-invalid @enderror">
                                    <option>...</option>
                                    @foreach($classes as $classe)
                                        <option value="{{ $classe->nom_classe }}" @if($classe->id == $élève->classe_id) selected @endif>{{ $classe->nom_classe }}</option>
                                    @endforeach
                                </select>
                                @error('classe')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="justify-content-center">
                            <div class="title">
                                <h3 class="subtitle">Informations des parents</h3>
                            </div>
                        </div>          

                        <div class="form-group row">
                            <label for="nom_père" class="col-md-4 col-form-label text-md-right">{{ __('Nom père') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nom_père') is-invalid @enderror" value="{{ $info_parent->nom_père }}" name="nom_père" required>
                                @error('nom_père')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nom_mère" class="col-md-4 col-form-label text-md-right">{{ __('Nom mère') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nom_mère') is-invalid @enderror" value="{{ $info_parent->nom_mère }}" name="nom_mère" required>

                                @error('nom_mère')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fonction_père" class="col-md-4 col-form-label text-md-right">{{ __('Fonction du père') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('fonction_père') is-invalid @enderror" value="{{ $info_parent->fonction_père }}" name="fonction_père" required>

                                @error('fonction_père')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fonction_mère" class="col-md-4 col-form-label text-md-right">{{ __('Fonction de mère') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('fonction_mère') is-invalid @enderror" value="{{ $info_parent->fonction_mère }}" name="fonction_mère" required>

                                @error('fonction_mère')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Numéro de Tel') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('tel') is-invalid @enderror" value="{{ $info_parent->tel }}" name="tel" required>

                                @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ $info_parent->email }}" name="email" required>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Modifier') }}
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
