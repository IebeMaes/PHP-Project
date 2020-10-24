@extends('layouts.template')

@section('title', 'Overzicht inschrijving')

@section('main')
    @if ($dit ==false)
        <div class="text-center">
            <h1>U heeft zich voor geen activiteiten ingeschreven</h1>
            <p>Het lijkt erop dat u geen enkele activiteit heeft aangeduidt. Indien dit niet de bedoeling was kan u teruggaan naar de beginpagina en zich opnieuw inschrijven. U kan teruggaan naar de beginpagina door om het logo van Thomas More te klikken.</p>
        </div>

    @endif


    @if ($dit == true)
        <div id="overzicht">
            <h1 class="text-center mb-1">Overzicht inschrijving</h1>
            <p class="text-center mb-5">Beste <b>{{$user->first_name}} {{$user->last_name}}</b>, we hebben de
                inschrijving goed ontvangen! Hieronder nog eens een overzicht van uw gekozen
                activiteiten.</p>

            <div class="row">
                <div class="col-lg-6 border-right">
                    <h3 class="text-center">Namiddagactiviteiten</h3>

                    @foreach($registrations as $registration)
                        @if ($registration->daypart->description == 'Korte activiteit' or $registration->daypart->description == 'Lange activiteit')
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h5>{{$registration->activity->description}}</h5>
                                            <p>Duur: {{$registration->daypart->start_hour}}
                                                - {{$registration->daypart->end_hour}}</p>
                                            <p>Locatie: {{$registration->activity->location->street}}
                                                - {{$registration->activity->location->town}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>

                <div class="col-lg-6">
                    <h3 class="text-center">Avondactiviteit</h3>
                    @foreach($registrations as $registration)
                        @if ($registration->daypart->description == 'Avond activiteit')
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <h5>{{$registration->activity->description}}</h5>
                                            <p>Duur: {{$registration->daypart->start_hour}}
                                                - {{$registration->daypart->end_hour}}</p>
                                            <p>Locatie: {{$registration->activity->location->street}}
                                                - {{$registration->activity->location->town}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <p class="align-content-center text-center mt-3">
            <a href="#!" class="btn btn-outline-success" id="btn-print" onclick="printoverzicht('overzicht')">
                <i class="fas fa-print mr-1"></i>Overzicht afprinten
            </a>
        </p>
    @endif
@endsection

@section("script_after")
    <script>

        //Overzicht afprinten
        function OverzichtPrinten() {
            window.print();
        }


    </script>
@endsection
