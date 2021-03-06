@extends('layouts.admin')

@section('page_title')
{{ __('Ajouter une matière') }}
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
                <div class="card-header">{{ __('Ajouter une matière') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('personnels.ajouter_matière') }}">
                        @csrf          
                        <div class="form-group row">
                            <label for="nom" class="col-md-4 col-form-label text-md-right">{{ __('Nom de la matière') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" value="{{ old('nom') }}" name="nom" required>
                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <!--<input type="text" class="form-control @error('description') is-invalid @enderror" value="{{ old('limite') }}" name="limite" required>-->
                                <input class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}">
                                <!--<textarea class="form-control @error('description') is-invalid @enderror" value="{{ old('description') }}" name="description"></textarea>-->
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="coefficient" class="col-md-4 col-form-label text-md-right">{{ __('Coefficient') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('coefficient') is-invalid @enderror" value="{{ old('coefficient') }}" name="coefficient" required>
                                @error('coefficient')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nbr_heures" class="col-md-4 col-form-label text-md-right">{{ __('Nbr des heures') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nbr_heures') is-invalid @enderror" value="{{ old('nbr_heures') }}" name="nbr_heures" required>
                                @error('nbr_heures')
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
