@extends('layouts.admin')

@section('page_title')
{{ __('Nouveau Post') }}
@endsection

@section('styles')
<style>
    .email-body{
        font-family: 'Montserrat';
        font-size: 16px;
        color: #394867;
    }

    .email-object {
        font-family: 'Poppins';
        font-weight: bold;
        font-size: 14px;
    }

    .form__group {
        position: relative;
        padding: 15px 0 0;
        margin-top: 10px;
    }

    .form__field {
        font-family: inherit;
        width: 100%;
        border: 0;
        border-bottom: 1px solid #d2d2d2;
        outline: 0;
        font-size: 16px;
        color: #212121;
        padding: 7px 0;
        background: transparent;
        transition: border-color 0.2s;
    }

    .form__field::placeholder {
        color: transparent;
    }

    .form__field:placeholder-shown ~ .form__label {
        font-size: 16px;
        cursor: text;
        top: 20px;
    }

    label,.form__field:focus ~ .form__label {
        position: absolute;
        top: 0;
        display: block;
        transition: 0.2s;
        font-size: 12px;
        color: #9b9b9b;
    }

    .form__field:focus ~ .form__label {
        color: #009788;
    }

    .form__field:focus {
        padding-bottom: 6px;
        border-bottom: 2px solid #009788;
    }

    .col-form-label {
        font-weight: bold;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Ajouter un post') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('parents.ajouter_post') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="titre" class="col-md-4 col-form-label text-md-right">{{ __('Titre') }}</label>

                            <div class="col-md-7">
                                <input id="titre" type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{ old('titre') }}" required>

                                @error('titre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group offset-md-4">
                            <div class="col-md-12">
                                <div class="form__group">
                                    <textarea id="description" name="description" class="form__field" placeholder="Votre commentaire ..." rows="6">{{ old('description') }}</textarea>
                                    <label for="description" class="form__label">Votre message</label>
                                    @error('description')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
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
