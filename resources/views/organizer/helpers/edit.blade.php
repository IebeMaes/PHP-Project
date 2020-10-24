@extends('layouts.template')

@section('title', 'bewerk helper')

@section('main')
    <h1>Bewerk helper: {{ $participant->first_name}}</h1>
    <form action="/organizer/helpers/{{ $participant->id }}" method="post">
        @method('put')
        @include('organizer.helpers.form')
    </form>
    <div class="text-right"><a  href="{{ URL::previous() }}" ><button class="btn button">Annuleer</button></a></div>
@endsection