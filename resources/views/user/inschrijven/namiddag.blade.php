@extends('layouts.template')

@section('title', 'inschrijven personeelsfeest')

@section('main')

    @if ($dit ==false)
        <div class="text-center">
            <h1>Geen activiteiten</h1>
            <p>De organisator heeft nog geen activiteiten voor dit feest beschikbaar gesteld. Gelieve nog even geduld te hebben.</p>
        </div>

    @endif

    @if ($dit == true)


    <h1 class="text-center mb-1">Kies een namiddagactiviteit!</h1>
    <p class="text-center mb-5">U kan kiezen voor 1 lange activiteit, of 2 korte activiteiten.</p>
    <form action="/inschrijving/namiddag/save" id="middagform" method="post">
        @csrf
        <div class="row">

            <div class="col-lg-6 border-right">
                <h3 class="text-center">Korte activiteiten</h3>
                <div class="scrol">
                    @foreach($activities as $activity)
                        @if ($activity->daypart->description == "Korte activiteit")

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <input type="checkbox" name="kort[]" id="kort" class="center size"
                                                   value="{{$activity->id}}"
                                                   data-start="{{$activity->daypart->start_hour}}"
                                                   data-end="{{$activity->daypart->end_hour}}">
                                            <label for="kort"></label>
                                        </div>
                                        <div class="col-lg-10">
                                            <h5>{{$activity->activity->name}}</h5>
                                            <p>Duur: {{$activity->daypart->start_hour}}
                                                - {{$activity->daypart->end_hour}}</p>
                                            <p>Locatie: {{$activity->activity->location->street}}
                                                - {{$activity->activity->location->town}}</p>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif

                    @endforeach
                </div>


            </div>

            <div class="col-lg-6 border-left">
                <h3 class="text-center">Lange activiteiten</h3>

                <div class="scrol">

                    @foreach($activities as $activity)

                        @if ($activity->daypart->description == "Lange activiteit")

                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <input type="checkbox" name="lang[]" id="lang" class="center size "
                                                   value="{{$activity->id}}">
                                            <label for="lang"></label>
                                        </div>
                                        <div class="col-lg-10">
                                            <h5>{{$activity->activity->name}}</h5>
                                            <p>Duur: {{$activity->daypart->start_hour}}
                                                - {{$activity->daypart->end_hour}}</p>
                                            <p>Locatie: {{$activity->activity->location->street}}
                                                - {{$activity->activity->location->town}}</p>


                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif

                    @endforeach
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
                    <button class="btn button" id="submit">
                        Keuze opslaan
                    </button>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-lg-12">
            <div class="text-center">
                <a href="/inschrijving/avond">
                    <button class="btn button">
                        Doorgaan zonder namiddagactiviteit
                    </button>
                </a>
            </div>
        </div>
    </div>
    @endif

@endsection

@section("script_after")
    <script>

        //Overzicht afprinten
        function OverzichtPrinten() {
            window.print();
        }


        $("#middagform").submit(function (e) {

            if ($("#middagform input:checkbox:checked").length == 0) {
                e.preventDefault();
                new Noty({
                    type: 'error',
                    text: "Gelieve een activiteit aan te duiden of op de knop 'Verdergaan zonder middagactiviteit' te klikken"
                }).show();
            }
            if ($("#middagform input:checkbox:checked").length != 0) {
                $(this).submit()
            }

        });


        $("input[name='lang[]']").change(function () {
            var checked = $(this).prop("checked");
            console.log(checked);
            if (checked === true) {
                $("input[name='kort[]']").attr("disabled", true);
                $("input[name='lang[]']").attr("disabled", true);
                $(this).attr('disabled', false);
                $(this).parent().next().find('#vervoer').attr('disabled', false);

            }
            if (checked === false) {
                $("input[name='kort[]']").attr("disabled", false);
                $("input[name='lang[]']").attr("disabled", false);
            }
        });

        $("input[name='kort[]']").change(function () {
            var start = $(this).data('start');
            var end = $(this).data("end");
            // console.log("startuur: ", start);
            // console.log('einduur: ', end);
            var checked = $(this).prop('checked');
            console.log(checked);
            var maxAllowed = 4;
            var selected = [];
            $.each($("input[name='kort[]']:checked"), function () {
                selected.push($(this).data('start'), $(this).data('end'));
            });
            console.log(selected);
            if (checked === true) {
                $("input[name='lang[]']").attr("disabled", true);
                $("select[name='vervoerlang[]']").attr("disabled", true);

                // console.log("eerste - start", selected[0]);
                // console.log("eerste - eind", selected[1]);
                // console.log("tweede -start", selected[2]);
                // console.log("tweede - eind", selected[3]);


                if (selected.length > 4) {
                    $(this).prop("checked", false);
                }

                if (selected.length === 4) {
                    new Noty({
                        type: 'success',
                        text: "Gelieve goed te kijken of de activiteiten niet overlappen"
                    }).show();
                }

                if (selected.length === 2) {
                    $("input[name='kort[]']").attr("disabled", false);
                    console.log('selected', selected);
                }
                // if(selected.length == 0){
                //     $("input[name='lang[]']").attr("disabled", false);
                // }
            }
            if (selected.length === 0) {
                $("input[name='lang[]']").attr("disabled", false);

            }
            // if (checked === false) {
            //     $("input[name='kort[]']").attr("disabled", false);
            //     $("input[name='lang[]']").attr("disabled", false)
            // }
        });
    </script>
@endsection
