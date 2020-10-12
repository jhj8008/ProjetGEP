@extends('layouts.admin')

@section('page_title')
{{ __('Ajouter une négligence') }}
@endsection

@section('styles')
<style>
    .radio-choices {
        margin-top: 10px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="title">
            <h1>Ajouter un Retard/Absence</h1>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ajouter une négligence') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('personnels.ajouter_negligence', ['ensg_id' => $enseignant_id]) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type de négligence') }}</label>

                            <div class="col-md-6" id="type">

                                <div class="form-check-inline radio-choices">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="retard" name="type">Retard
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="absence" name="type">Absence
                                    </label>
                                </div>

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input class="form-control @error('date') is-invalid @enderror" type="date" name="date">
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="durée" class="col-md-4 col-form-label text-md-right">{{ __('Durée') }}</label>

                            <div class="col-md-6">
                                <input class="form-control @error('durée') is-invalid @enderror" type="time" name="durée">
                                @error('durée')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="période" class="col-md-4 col-form-label text-md-right">{{ __('Période') }}</label>

                            <div class="col-md-6 radio-choices" id="période">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="matin" name="période">matin
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="après-midi" name="période">après-midi
                                    </label>
                                </div>
                                @error('période')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="raison" class="col-md-4 col-form-label text-md-right">{{ __('Raison') }}</label>

                            <div class="col-md-6 radio-choices" id="raison">
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="présentée" name="raison">présentée
                                    </label>
                                </div>
                                <div class="form-check-inline">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="inconnu" name="raison">inconnu
                                    </label>
                                </div>

                                @error('raison')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
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
