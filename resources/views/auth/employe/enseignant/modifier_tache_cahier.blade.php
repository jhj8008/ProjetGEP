@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="title">
            <h1>Page des informations de négligence</h1>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modifier une négligence') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('enseignants.modifier_tache', ['matId' => $matId,'classe_id' => $classe_id, 'tache_id' => $tache_id]) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input class="form-control @error('date') is-invalid @enderror" type="date" name="date" value="{{ $tache_ct->date_publication }}">
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="a_faire" class="col-md-4 col-form-label text-md-right">{{ __('À faire') }}</label>

                            <div class="col-md-6">
                                <input class="form-control @error('a_faire') is-invalid @enderror" type="text" name="a_faire" value="{{ $tache_ct->a_faire }}">
                                @error('a_faire')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="fait" class="col-md-4 col-form-label text-md-right">{{ __('Fait') }}</label>

                            <div class="col-md-6">
                                <input class="form-control @error('fait') is-invalid @enderror" type="text" name="fait" value="{{ $tache_ct->fait }}">
                                @error('période')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cours" class="col-md-4 col-form-label text-md-right">{{ __('Cours') }}</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('séance') is-invalid @enderror" value="{{ $tache_ct->cours }}" name="cours">
                                @error('cours')
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
