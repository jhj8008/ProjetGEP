@extends('layouts.admin')

@section('page_title')
 {{ __('Ajouter un compte admin') }}
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
                <div class="card-header">{{ __('Créer un compte personnel') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admins.ajouter_admin') }}">
                        @csrf          
                        <div class="form-group row">
                            <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}" name="nom" placeholder="Nom" required>
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
                                <input type="text" class="form-control @error('prénom') is-invalid @enderror" value="{{ old('prénom') }}" name="prénom" placeholder="Prénom" required>
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
                                    <option value="M">Male</option>
                                    <option value="F">Femelle</option>
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
                            <label for="fonction" class="col-md-4 col-form-label text-md-right">{{ __('Fonction') }}</label>

                            <div class="col-md-6">
                                <select id="fonction" name="fonction" class="form-control @error('fonction') is-invalid @enderror">
                                    <option>...</option>
                                    <option value="Directeur">Directeur</option>
                                    <option value="Secrétaire">Secrétaire</option>
                                    <option value="Comptable">Comptable</option>
                                    <option value="Professeur">Professeur</option>
                                </select>
                                @error('fonction')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-mail') }}</label>

                            <div class="col-md-6">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" name="email" placeholder="E-mail" required>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Mot de passe" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirmer mot de passe') }}</label>

                            <div class="col-md-6">
                                <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirmer votre mot de passe" required>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="adresse" class="col-md-4 col-form-label text-md-right">{{ __('Adresse') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('adresse') is-invalid @enderror" value="{{ old('adresse') }}" name="adresse" placeholder="Adresse" required>
                                @error('adresse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Tél') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('tel') is-invalid @enderror" value="{{ old('tel') }}" name="tel" placeholder="N° tél" required>
                                @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Créer compte') }}
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
