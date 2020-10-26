@extends('layouts.admin')

@section('page_title')
 {{ __('Modifier une fiche personnelle') }}
@endsection

@section('styles')
<style>
    .title{
        font-family: 'Exo';
        text-align: center;
    }
    .col-form-label{
        font-weight: bold;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modifier une fiche personnelle') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admins.modifier_fiche_admin', ['id' => $fiche->id]) }}">
                        @csrf          
                        <div class="form-group row">
                            <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" value="{{ $fiche->employe->nom }}" name="nom" required>
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
                                <input type="text" class="form-control @error('prénom') is-invalid @enderror" value="{{ $fiche->employe->prénom }}" name="prénom" required>
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
                                    <option value="M" @if($fiche->employe->sexe == 'M') selected @endif>Male</option>
                                    <option value="F" @if($fiche->employe->sexe == 'F') selected @endif>Femelle</option>
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
                                <input class="form-control @error('date_de_naissance') is-invalid @enderror" type="date" value="{{ $fiche->employe->date_de_naissance }}" name="date_de_naissance">
                                @error('date_de_naissance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ville" class="col-md-4 col-form-label text-md-right">{{ __('Ville') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('ville') is-invalid @enderror" value="{{ $fiche->ville }}" name="ville" required>
                                @error('ville')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nationalité" class="col-md-4 col-form-label text-md-right">{{ __('Nationalité') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nationalité') is-invalid @enderror" value="{{ $fiche->nationalité }}" name="nationalité" required>
                                @error('nationalité')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="num_carte_sejour" class="col-md-4 col-form-label text-md-right">{{ __('N° de carte de séjour') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('num_carte_sejour') is-invalid @enderror" value="{{ $fiche->num_carte_sejour }}" name="num_carte_sejour" required>
                                @error('num_carte_sejour')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="num_carte_travail" class="col-md-4 col-form-label text-md-right">{{ __('N° de carte de travail') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('num_carte_travail') is-invalid @enderror" value="{{ $fiche->num_carte_travail }}" name="num_carte_travail" required>
                                @error('num_carte_travail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="code_postale" class="col-md-4 col-form-label text-md-right">{{ __('Code postale') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('code_postale') is-invalid @enderror" value="{{ $fiche->code_postale }}" name="code_postale" required>
                                @error('code_postale')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="situation_familiale" class="col-md-4 col-form-label text-md-right">{{ __('Situation familiale') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('situation_familiale') is-invalid @enderror" value="{{ $fiche->situation_familiale }}" name="situation_familiale" required>
                                @error('situation_familiale')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="num_sécurité_sociale" class="col-md-4 col-form-label text-md-right">{{ __('N° de sécurité sociale') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('num_sécurité_sociale') is-invalid @enderror" value="{{ $fiche->num_sécurité_sociale }}" name="num_sécurité_sociale" required>
                                @error('num_sécurité_sociale')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="adresse" class="col-md-4 col-form-label text-md-right">{{ __('Adresse') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('adresse') is-invalid @enderror" value="{{ $fiche->employe->adresse }}" name="adresse" required>
                                @error('adresse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Téléphone') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('tel') is-invalid @enderror" value="{{ $fiche->employe->tel }}" name="tel" required>
                                @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" value="{{ $fiche->employe->email }}" name="email" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fonction" class="col-md-4 col-form-label text-md-right">{{ __('Emploi') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('fonction') is-invalid @enderror" value="{{ $fiche->employe->fonction }}" name="fonction" required>
                                @error('fonction')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="qualification" class="col-md-4 col-form-label text-md-right">{{ __('Qualification') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('qualification') is-invalid @enderror" value="{{ $fiche->qualification }}" name="qualification" required>
                                @error('qualification')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="contrat" class="col-md-4 col-form-label text-md-right">{{ __('Contrat') }}</label>

                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <select id="contrat" name="contrat" class="form-control @error('contrat') is-invalid @enderror">
                                        <option>...</option>
                                        <option value="CDD" @if($fiche->contrat == 'CDD') selected @endif>CDD</option>
                                        <option value="CDI" @if($fiche->contrat == 'CDI') selected @endif>CDI</option>
                                        <option value="Contract d'apprentissage" @if($fiche->contrat == "Contract d'apprentissage") selected @endif>Contract d'apprentissage</option>
                                        <option value="Contrat de professionnalisation" @if($fiche->contrat == "Contrat de professionnalisation") selected @endif>Contrat de professionnalisation</option>
                                    </select>
                                </div>

                                @error('contrat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="durée" class="col-md-4 col-form-label text-md-right">{{ __('Durée en mois') }}</label>

                            <div class="col-md-6">
                                <input type="number" class="form-control @error('durée') is-invalid @enderror" value="{{ $fiche->durée }}" name="durée">
                                @error('durée')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="salaire_mensuel" class="col-md-4 col-form-label text-md-right">{{ __('Salaire mensuel') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('salaire_mensuel') is-invalid @enderror" value="{{ $fiche->salaire_mensuel }}" name="salaire_mensuel" required>
                                @error('salaire_mensuel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_entrée" class="col-md-4 col-form-label text-md-right">{{ __('Date d\'entrée ') }}</label>

                            <div class="col-md-6">
                                <input class="form-control @error('date_entrée') is-invalid @enderror" type="date" value="{{ $fiche->date_entrée }}" name="date_entrée">
                                @error('date_entrée')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_sortie" class="col-md-4 col-form-label text-md-right">{{ __('Date de sortie') }}</label>

                            <div class="col-md-6">
                                <input class="form-control @error('date_sortie') is-invalid @enderror" value="{{ $fiche->date_sortie }}" type="date" name="date_sortie">
                                @error('date_sortie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="situation_avant_enbauche" class="col-md-4 col-form-label text-md-right">{{ __('Situation avant l\'embauche ') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('situation_avant_enbauche') is-invalid @enderror" value="{{ $fiche->situation_avant_enbauche }}" name="situation_avant_enbauche" required>
                                @error('situation_avant_enbauche')
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
