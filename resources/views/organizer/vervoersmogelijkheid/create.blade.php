@extends('layouts.template')

@section('title', 'Nieuwe vervoersmogelijkheid maken')

@section('main')
    <h1>Nieuwe vervoersmogelijkheid maken</h1>
    <form action="/organizer/vervoersmogelijkheid" method="post">
        @include('organizer.vervoersmogelijkheid.form')
    </form>
    <div class="text-right"><a  href="{{ URL::previous() }}" ><button class="btn button">Annuleer</button></a></div>
@endsection