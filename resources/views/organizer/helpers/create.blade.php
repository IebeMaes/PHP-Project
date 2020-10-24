@extends('layouts.template')

@section('title', 'Nieuwe helper maken')

@section('main')
    <h1>Nieuwe helper maken</h1>
    <form action="/organizer/helpers" method="post">
        @include('organizer.helpers.form')
    </form>
    <div class="text-right"><a  href="{{ URL::previous() }}" ><button class="btn button">Annuleer</button></a></div>
@endsection