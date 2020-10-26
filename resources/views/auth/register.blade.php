@extends('layouts.app')

@section('page_title')
{{ __('Créer un compte') }}
@endsection

@section('scripts')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    $( function() {
        $('.datepicker').datepicker({
            dateFormat: 'yy-mm-dd',
            changeMonth: true,
            changeYear: true,
            yearRange: '1996:2030',
            minDate: new Date(1996, 1 - 1, 1)
        });
    });

</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Créer compte parent') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="nom_père" class="col-md-4 col-form-label text-md-right">{{ __('Nom père complet') }}</label>

                            <div class="col-md-6">
                                <input id="nom_père" type="text" class="form-control @error('nom_père') is-invalid @enderror" name="nom_père" value="{{ old('nom_père') }}" required autocomplete="nom_père" autofocus>

                                @error('nom_père')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom mère complet') }}</label>

                            <div class="col-md-6">
                                <input id="nom_mère" type="text" class="form-control @error('nom_mère') is-invalid @enderror" name="nom_mère" value="{{ old('nom_mère') }}" required autocomplete="nom_mère" autofocus>

                                @error('nom_mère')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fonction_père" class="col-md-4 col-form-label text-md-right">{{ __('Fonction de père') }}</label>

                            <div class="col-md-6">
                                <input id="fonction_père" type="text" class="form-control @error('fonction_père') is-invalid @enderror" name="fonction_père" value="{{ old('fonction_père') }}" required autocomplete="fonction_père" autofocus>

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
                                <input id="fonction_mère" type="text" class="form-control @error('fonction_mère') is-invalid @enderror" name="fonction_mère" value="{{ old('fonction_mère') }}" required autocomplete="fonction_mère" autofocus>

                                @error('fonction_mère')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('N° de téléphone') }}</label>

                            <div class="col-md-6">
                            <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel">

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
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Valider') }}
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
