@extends('layouts.admin')

@section('page_title')
{{ __('Message') }}
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
    <div class="row justify-content-left">

        <div class="card shadow-none mt-3 border border-light">
            <div class="card-body">
                <div class="media mb-3">
                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png" class="rounded-circle mr-3 mail-img shadow" alt="media image"  width="100" height="100">
                        <div class="media-body">
                            <span class="media-meta float-right">{{ $message->created_at }}</span>
                            <h4 class="text-primary m-0">{{ $message->nom }}</h4>
                            <small class="text-muted">From : {{ $message->email }}</small>
                        </div>

                    </div> 
                    <div class="email-object">Message: </div>
                    <div class="container email-body">
                        {!! $message->message !!}
                    </div>
                    <hr>
                </div>
            </div> 
        </div> 

        <!-- Email form -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Envoyer un email') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admins.envoyer_email') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email_to" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail du parent') }}</label>

                            <div class="col-md-7">
                                <input id="email_to" type="email" class="form-control @error('email_to') is-invalid @enderror" name="email_to" value="{{ old('email_to') }}" required autocomplete="email" autofocus>

                                @error('email_to')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group offset-md-4">
                            <div class="col-md-12">
                                <div class="form__group">
                                    <textarea id="message" name="message" class="form__field" placeholder="Votre message ..." rows="6"></textarea>
                                    <label for="message" class="form__label">Votre message</label>
                                    @error('message')
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
                                    {{ __('Envoyer') }}
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
