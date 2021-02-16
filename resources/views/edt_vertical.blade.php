@extends('layouts.app')

@section('page_title')
{{ __('Emploi du temps') }}
@endsection

@section('styles')
<link href="{{ asset('css/timetable_style.css') }}" rel="stylesheet">
<style>
.my_footer {
    position: absolute;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="edt_container">
            <div class="row">
                <div class="col-12">
                    
                        <div class="row day-columns">
                        @foreach($jours as $jour)
                            <div class="day-column">
                                <div class="day-header">{{ $jour }}</div>
                                <div class="day-content">
                                    @foreach($séances as $s)
                                        @if($s->jour == $jour)
                                            <div class="event {{ "color" . strval($s->id % 10) }}">
                                                <span class="title">{{ $s->matière->nom }}</span>
                                                <span>Prof. {{ $s->employe->nom ." " . $s->employe->prénom}}</span>
                                                <footer>
                                                    <span>salle: {{ $s->salle }}</span><br>
                                                    <span>{{ $s->heure_début . " - " . $s->heure_fin }}</span>
                                                </footer>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="day-footer">-</div>
                            </div>
                            @endforeach
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
