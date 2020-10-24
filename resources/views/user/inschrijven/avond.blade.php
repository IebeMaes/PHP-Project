@extends('layouts.template')

@section('title', 'inschrijven personeelsfeest')

@section('main')
    <h1 class="text-center mb-1">Avondactiviteit</h1>
    <p class="text-center mb-5">De avondactiviteit bestaat uit een maaltijd die gevolgd wordt door een fuif. Beide
        vinden plaats op de campus</p>
    <form action="/inschrijving/avond/save" id="avondform" method="post">
        @csrf
        <div class="row">

            <div class="col-lg-6 border-right">
                <h3 class="text-center">Eetmogelijkheden</h3>
                <div class="scrol">
                    @foreach($activities as $activity)
                        @if ($activity->daypart->description == "Avond activiteit")

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <input type="checkbox" name="avond" id="avond" class="center size" value="{{$activity->id}}"
                                                   data-name="{{$activity->activity->name}}">
                                            <label for="avond"></label>
                                        </div>
                                        <div class="col-lg-10">
                                            <h5>{{$activity->activity->name}}</h5>
                                            <p>Duur: {{$activity->daypart->start_hour}} - {{$activity->daypart->end_hour}}</p>
                                            <p>Locatie: {{$activity->activity->location->street}} - {{$activity->activity->location->town}}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif

                    @endforeach
                </div>


            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="opmerkingavond" class="col-form-label-lg">Opmerkingen bij <b><span
                                id="opmerking"></span></b></label>
                    <textarea class="form-control" id="opmerkingavond" name="opmerkingavond" rows="3" placeholder="Allergiën..."></textarea>
                </div>
            </div>
        </div>
        <div class="row p-5">
            <div class="col-lg-12">
                <div class="text-center">
                    <h3>Kies je vervoer bij deze activiteit(en)</h3>
                    <label for="vervoer">Vervoersopties</label>
                    <select name="vervoer" id="vervoer">
                        @foreach ($vervoersmogelijkheden as $vervoersmogelijkheid)
                            <option value="{{$vervoersmogelijkheid->id}}">{{$vervoersmogelijkheid->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="row p-5">
            <div class="col-lg-12">
                <div class="text-center">
                    <button class="btn button">
                        Keuze opslaan
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center">
                <a href="/inschrijving/bevestiging">
                    <button class="btn button">
                        Doorgaan zonder avondactiviteit
                    </button>
                </a>
            </div>
        </div>
    </div>

@endsection

@section("script_after")
    <script>

        //Overzicht afprinten
        function OverzichtPrinten() {
            window.print();
        }

        $("#avondform").submit(function (e) {

            if ($("#avondform input:checkbox:checked").length == 0) {
                e.preventDefault();
                new Noty({
                    type: 'error',
                    text: "Gelieve een activiteit aan te duiden of op de knop 'Verdergaan zonder avondactiviteit' te klikken"
                }).show();
            }
            if ($("#avondform input:checkbox:checked").length != 0) {
                $(this).submit()
            }

        });



        $("input[name='avond']").change(function () {
            $("#opmerking").text("");
            var checked = $(this).prop('checked');
            console.log(checked);

            if (checked === true) {
                $("input[name='avond']").attr("disabled", true);
                $(this).attr("disabled", false);
                var name = $(this).data('name');
                $("#opmerking").text(name);

            }
            if (checked === false) {
                $("input[name='avond']").attr("disabled", false);

            }
        });
    </script>
@endsection
