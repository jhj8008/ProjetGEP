@extends('layouts.admin')

@section('styles')
<style>
    .rmq{
        font-size: 15px;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="title container">
            <h1>Modifier note</h1>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Modifier la note') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('enseignants.modifier_note', ['id' => $note->matière_id, 'note_id' => $note->id]) }}">
                        @csrf
                        <div class="form-group row">
                            <label for="valeur" class="col-md-4 col-form-label text-md-right">{{ __('Note exam 1') }}</label>
                            <div class="col-md-6">
                                <input class="form-control @error('valeur') is-invalid @enderror" type="text" name="valeur" value="{{ $note->valeur }}">
                                @error('valeur')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="valeur2" class="col-md-4 col-form-label text-md-right">{{ __('Note exam 2') }}</label>
                            <div class="col-md-6">
                                <input class="form-control @error('valeur2') is-invalid @enderror" type="text" name="valeur2" value="{{ $note->valeur2 }}">
                                @error('valeur2')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="remarque" class="col-md-4 col-form-label text-md-right">{{ __('Remarque') }}</label>

                            <div class="col-md-6">
                                <textarea class="form-control @error('remarque') is-invalid @enderror form-control-lg mb-3 rmq" type="text" rows="3" name="remarque">
                                    {{ $note->remarque }}
                                </textarea>
                                @error('remarque')
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
