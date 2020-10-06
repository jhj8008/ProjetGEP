@extends('layouts.admin')

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
                <div class="card-header">{{ __('Modifier classe') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('personnels.modifier_classe', ['id' => $classe->id]) }}">
                        @csrf          
                        <div class="form-group row">
                            <label for="nom_classe" class="col-md-4 col-form-label text-md-right">{{ __('Nom de la classe') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('nom_classe') is-invalid @enderror" value="{{ $classe->nom_classe }}" name="nom_classe" required>
                                @error('nom_classe')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="limite" class="col-md-4 col-form-label text-md-right">{{ __('Nombre limite des élèves') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('limite') is-invalid @enderror" value="{{ $classe->limite }}" name="limite" required>
                                @error('limite')
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
