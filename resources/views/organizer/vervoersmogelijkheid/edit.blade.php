@extends('layouts.template')

@section('title', 'bewerk vervoersmogelijkheid')

@section('main')
    <h1>Bewerk vervoersmogelijkheid: {{ $transportoption->name}}</h1>
    <form action="/organizer/vervoersmogelijkheid/{{ $transportoption->id }}" method="post">
        @method('put')
        @include('organizer.vervoersmogelijkheid.form')
    </form>
    <div class="text-right"><a  href="{{ URL::previous() }}" ><button class="btn button">Annuleer</button></a></div>

@endsection