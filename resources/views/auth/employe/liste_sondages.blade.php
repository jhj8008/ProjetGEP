@extends('layouts.admin')

@section('page_title')
{{ __('Sondages du forum') }}
@endsection

@section('styles')
<style>
    .action-btns{
        /*position: absolute;*/
        margin-top: 10px;
        float:left;
        margin-bottom: 20px;
    }

    .action-btns > .btn:hover {
        -webkit-transform: scale(1.1);
        -moz-transform: scale(1.1);
        -o-transform: scale(1.1);
    }
    .action-btns > .btn {
        -webkit-transform: scale(0.8);
        -moz-transform: scale(0.8);
        -o-transform: scale(0.8);
        -webkit-transition-duration: 0.5s;
        -moz-transition-duration: 0.5s;
        -o-transition-duration: 0.5s;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row float-left action-btns">
            <a href="{{ route('employés.form_ajouter_sondage') }}" class="btn btn-primary a-btn-slide-text">
                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                <span><strong>Ajouter un sondage</strong></span>            
            </a>
        </div>
        @foreach($polls as $poll)
            <voting poll_id="{{ $poll->id }}" poll_desc="{{ $poll->desc }}" v-bind:poll_candidates="{{ json_encode($poll->candidates) }}"></voting>
        @endforeach
    <div>
</div>
@endsection
