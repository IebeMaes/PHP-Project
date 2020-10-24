@extends('layouts.template')

@section('title', 'Registratiesdetail')

@section('main')
    <div id="overzicht">
    <h1>Inschrijvingen: {{$daypart_activity->activity->name}}</h1>
    <h3 class="mb-4">Van: {{date('H:i',strtotime($daypart_activity->daypart->start_hour))}} Tot: {{date('H:i',strtotime($daypart_activity->daypart->end_hour))}}</h3>
    <p>Aantal inschrijvingen met pendelbus: <span class="font-weight-bold">{{$count}}</span></p>
@foreach($datas as $data)
    {{--@if ($data->daypart_activity_id == $daypart_activity->id)--}}

        <p class="mb-0">Deelnemer: <span class="font-weight-bold">{{$data->participant->first_name}}</span></p>
        <small class="mt-0 mb-2">Vervoer: {{$data->chosentransport->transportoption->name}}</small>

        <hr>
    {{--@endif--}}

@endforeach
    </div>
    <div class="text-right mb-3"><a href="{{ URL::previous() }}" ><button class="btn button">Terug</button></a>

    <a href="#!" class="btn btn-outline-success" id="btn-print" onclick="printoverzicht('overzicht')">
        <i class="fas fa-print mr-1"></i>Overzicht afprinten
    </a>

@endsection
@section('script_after')
    <script>
        $(function () {
function printoverzicht(el){
var restorepage=document.body.innerHTML;
var printcontent=document.getElementById(el).innerHTML;
document.body.innerHTML=printcontent;
window.print();
document.body.innerHTML=restorepage;
}
        });
    </script>
    @endsection