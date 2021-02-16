@extends('layouts.app')

@section('page_title')
{{ __('Emploi du temps') }}
@endsection

@section('styles')
<style>
@import url(https://fonts.googleapis.com/css?family=Open+Sans:300,400);

.task0 {
    background: #a20a0a;  
}
.task1 {
    background: #321f28;  
}
.task2 {
    background: #ea2c62;  
}
.task3 {
    background: #060930;  
}
.task4 {
    background: #9b59b6;  
}

.task5 {
    background: #af2d2d;  
}
.task6 {
    background: #cc0e74;  
}
.task7 {
    background: #2d6187;  
}
.task8 {
    background: #686d76;  
}
.task9 {
    background: #c56183;  
}

.blue {
  background: #3498db;
}

.purple {
  background: #9b59b6;
}

.navy {
  background: #34495e;
}

.green {
  background: #2ecc71;
}

.red {
  background: #e74c3c;
}

.orange {
  background: #f39c12;
}

.cs335, .cs426, .md303, .md352, .md313, .cs240 {
  font-weight: 300;
  cursor: pointer;
}

/*body {
  background: #e74c3c;
  padding: 20px;
}*/

*, *:before, *:after {
  margin: 0;
  padding: 0;
  border: 0;
  outline: 0;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
  box-sizing: border-box;
}

table {
  font-family: 'Open Sans', Helvetica;
  color: #efefef;
  direction:rtl;
}
table tr:nth-child(2n) {
  background: #eff0f1;
}
table tr:nth-child(2n+3) {
  background: #fff;
}
table th, table td {
  padding: 1em;
  width: 10em;
}

.days, .time {
  background: #34495e;
  text-transform: uppercase;
  font-size: 0.6em;
  text-align: center;
}

.time {
  width: 3em !important;
}

/* Add this attribute to the element that needs a tooltip */
[data-tooltip] {
  position: relative;
  z-index: 2;
  cursor: pointer;
}

/* Hide the tooltip content by default */
[data-tooltip]:before,
[data-tooltip]:after {
  visibility: hidden;
  filter: progid:DXImageTransform.Microsoft.Alpha(Opacity=0);
  opacity: 0;
  pointer-events: none;
  -moz-transition: ease 0.5s all;
  -o-transition: ease 0.5s all;
  -webkit-transition: ease 0.5s all;
  transition: ease 0.5s all;
}

/* Position tooltip above the element */
[data-tooltip]:before {
  position: absolute;
  bottom: 110%;
  left: 50%;
  margin-bottom: 5px;
  margin-left: -80px;
  padding: 7px;
  width: 160px;
  -moz-border-radius: 6px;
  -webkit-border-radius: 6px;
  border-radius: 6px;
  background-color: black;
  color: #fff;
  content: attr(data-tooltip);
  text-align: center;
  font-size: 14px;
  line-height: 1.2;
}

/* Triangle hack to make tooltip look like a speech bubble */
[data-tooltip]:after {
  position: absolute;
  bottom: 110%;
  left: 50%;
  margin-left: -5px;
  width: 0;
  border-top: 5px solid black;
  border-right: 5px solid transparent;
  border-left: 5px solid transparent;
  content: " ";
  font-size: 0;
  line-height: 0;
}

/* Show tooltip content on hover */
[data-tooltip]:hover:before,
[data-tooltip]:hover:after {
  visibility: visible;
  bottom: 90%;
  filter: progid:DXImageTransform.Microsoft.Alpha(enabled=false);
  opacity: 1;
}

.tab {
    margin-top: 5%;
    /*border: 1px solid #ddd;*/
}

.my_footer {
    position: absolute;
}
</style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
      <div class='tab'>
        <table border='1' cellpadding='0' cellspacing='0'>
          <tr class='days'>
            <th>Semaine {{ $semaine }}</th>
            <th>.</th>
            <th>.</th>
            <th>.</th>
            <th>.</th>
          </tr>
          @foreach($jours as $j)
              <tr>
                  <td class='time'>{{ $j }}</td>
                  @foreach($séances as $s)
                      @if($s->jour == $j)
                          <td class='cs426 task{{ strval($s->id % 10)[0] }} lab' data-tooltip='Prof. {{ $s->employe->nom . " " . $s->employe->prénom . " à " . $s->heure_début . " " . $s->salle}}'>{{ $s->matière->nom }}</td>
                      @endif
                  @endforeach
              </tr>
          @endforeach
        </table>
      </div>
    </div>
</div>
@endsection
