@extends('layouts.template')
@section('title', 'personeelsfeest')
@section('main')
    <div class="text-center">
        @if(Session::has('flash_message'))
            <div id="success" class="alert alert-success">
                {{ Session::get('flash_message') }}
                {{ Session::forget('flash_message') }}
                {{ Session::save() }}
            </div>
        @endif
            @if(Session::has('error_message'))
                <div id="error" class="alert alert-danger">
                    {{ Session::get('error_message') }}
                    {{ Session::forget('error_message') }}
                    {{ Session::save() }}
                </div>
            @endif

        <h3 class="mt-4 mb-3 font-weight-bold">Welkom op het</h3>
        <h1 class="text-uppercase">Personeelsfeest portaal</h1>
            <p>Dit is een proefproject!</p>
        <p>Thomas More kijkt er naar uit om hun werknemers te verwelkomen op het jaarlijkse personeelsfeest <br> Klik op 'Inschrijven' om je in te schrijven voor de volgende editie</p>
        <a class="d-block mb-3" href="/inschrijving"><button class="button">Inschrijven als personeelslid</button></a>
        <a class="d-block mb-3" href="/inschrijvenhelper"><button class="button">Inschrijven als helper</button></a>


        <img  class="img-fluid d-block" src="assets/party.JPG" alt="sfeerfoto mensen die hun glazen klinken">
        <img  class="img-fluid" src="assets/bbqwijndessert.JPG" alt="sfeerfoto met bbq, dessert en wijn.">

    </div>
    <hr>

@endsection

@section('title')

@section('main')
    <h2>Welkom op het</h2>
    <h1>Personeelsfeest portaal</h1>
    <p>Thomas More kijkt er naar uit om hun werknemers te verwelkomen op het jaarlijkse personeelsfeest <br> Klik op 'Inschrijven' om je in te schrijven voor de volgende editie</p>
    <a href=""><button>Inschrijven</button></a>
    <img src="" alt="sfeerfoto mensen die hun glazen klinken">
    <img src="" alt="sfeerfot etenbuffetgit">
@endsection
@section("script_after")
    <script>
        $( document ).ready(function() {


            setTimeout(function() {
                $("#success").css("display","none");
                $("#error").css("display","none");
            }, 5000);

        });
    </script>
@endsection
