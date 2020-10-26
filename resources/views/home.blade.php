@extends('layouts.app')

@section('page_title')
{{ __('Home') }}
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('Vous êtes maintenant connecté à votre compte!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
