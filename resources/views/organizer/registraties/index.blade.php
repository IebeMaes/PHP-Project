@extends('layouts.template')

@section('title', 'Registraties')

@section('main')
    <div id="overzicht">
    @foreach ($edities as $editie)
        <h1>Informatie inschrijvingen {{$editie->name}}</h1>
    @endforeach

    @include('shared.alert')

    <h3>Aantal personen ingeschreven: {{$count}}</h3>
    <br>
    <div class="container">
        <div class="row">
        <div class="col-lg-6 col-sm-12">
            <h4 class="font-weight-bold mb-4">Korte activiteiten</h4>

            @foreach($daypart_activities as $daypart_activity)

                @if($daypart_activity->activity->sort == 'Korte activiteit')

                    <div class="row">
                        <div class="col-lg-6">
                            <p><span class="font-weight-bold">{{$daypart_activity->activity->name}}: </span>{{date('H:i',strtotime($daypart_activity->daypart->start_hour))}} - {{date('H:i',strtotime($daypart_activity->daypart->end_hour))}}</p>
                            @php
                                $i = 0
                            @endphp
                            @foreach ($registrations2 as $registration)

                                @if ($registration->daypart_activity_id == $daypart_activity->id)
                                    @php
                                        $i++
                                    @endphp


                                @endif
                            @endforeach
                            <p class="mb-1">Aantal inschrijvingen: <span class="font-weight-bold">{{$i}}</span></p>
                        </div>
                        <div class="col-lg-6">
                            <a href=/organizer/registratiesdetail/{{ $daypart_activity->id }}"><button class="btn button">meer info</button></a>
                        </div>
                    </div>


                    <hr>
                @endif
            @endforeach
        </div>
        <div class="col-lg-6 col-sm-12">
            <h4 class="font-weight-bold mb-4">Lange activiteiten</h4>

            @foreach($daypart_activities as $daypart_activity)

                @if($daypart_activity->activity->sort == 'Lange activiteit')

                    <div class="row">
                        <div class="col-lg-6">
                            <p><span class="font-weight-bold">{{$daypart_activity->activity->name}}: </span>{{date('H:i',strtotime($daypart_activity->daypart->start_hour))}} - {{date('H:i',strtotime($daypart_activity->daypart->end_hour))}}</p>
                            @php
                                $i = 0
                            @endphp
                            @foreach ($registrations2 as $registration)

                                @if ($registration->daypart_activity_id == $daypart_activity->id)
                                    @php
                                        $i++
                                    @endphp


                                @endif
                            @endforeach
                            <p class="mb-1">Aantal inschrijvingen: <span class="font-weight-bold">{{$i}}</span></p>
                        </div>
                        <div class="col-lg-6">
                            <a href=/organizer/registratiesdetail/{{ $daypart_activity->id }}"><button class="btn button">meer info</button></a>
                        </div>
                    </div>


                    <hr>
                @endif
            @endforeach
        </div>
        </div>
    </div>



    <div class="col-lg-6 col-sm-12">

    <h4 class="font-weight-bold my-4">Avond activiteit</h4>

        @foreach($daypart_activities as $daypart_activity)

            @if($daypart_activity->activity->sort == 'Avond activiteit')

                <div class="row">
                    <div class="col-lg-6">
                        <p><span class="font-weight-bold">{{$daypart_activity->activity->name}}: </span>{{date('H:i',strtotime($daypart_activity->daypart->start_hour))}} - {{date('H:i',strtotime($daypart_activity->daypart->end_hour))}}</p>
                        @php
                            $i = 0
                        @endphp
                        @foreach ($registrations2 as $registration)

                            @if ($registration->daypart_activity_id == $daypart_activity->id)
                                @php
                                    $i++
                                @endphp


                            @endif
                        @endforeach
                        <p class="mb-1">Aantal inschrijvingen: <span class="font-weight-bold">{{$i}}</span></p>
                    </div>
                    <div class="col-lg-6">
                        <a href=/organizer/registratiesdetail/{{ $daypart_activity->id }}"><button class="btn button">meer info</button></a>
                    </div>
                </div>


                <hr>
            @endif
        @endforeach

        </div>
    </div>
    <div class="text-right mb-3"><a href=/organizer/staffparties ><button class="btn button">Home</button></a>
        <a href="#!" class="btn btn-outline-success" id="btn-print" onclick="printoverzicht('overzicht')">
            <i class="fas fa-print mr-1"></i>Overzicht afprinten
        </a></div>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>

                <th>Naam</th>
                <th>Achternaam</th>
                <th>E-mail</th>
                <th>Activiteit</th>
                <th>Delete</th>

            </tr>
            </thead>
            <tbody>
            <form method="get" action="/organizer/registraties/{{$editie->id}}" id="searchForm">

                <input type="text" class="form-control" name="registratie" id="registratie"
                       value="{{ request()->registratie }}" placeholder="Zoek op naam, achternaam of e-mail">



            </form>
            @foreach( $registrations as $registration)
                <tr id="{{$registration->id}}">

                    <td>{{ $registration->participant->first_name}}</td>
                    <td>{{ $registration->participant->last_name}}</td>
                    <td>{{ $registration->participant->email}}</td>
                    <td>{{ $registration->daypart_activity->activity->name}}</td>
                    <td data-registrationid="{{$registration->id}}" data-name="{{$registration->daypart_activity->activity->name}}">
                        <a href="#!" class="btn btn-outline-danger btn-delete"
                        data-toggle="tooltip"  title="Deze inschrijving verwijderen">

                        <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    {{ $registrations->links() }}


@endsection
@section('script_after')
    <script>
        $(function () {
            $('tbody').on('click', '.btn-delete', function () {
                // Get data attributes from td tag
                let registratieid = $(this).closest('td').data('registrationid');
                let name = $(this).closest('td').data('name');

                // Set some values for Noty
                let text = `<p>Verwijder de inschrijving <b>${name}</b>?</p>`;
                let type = 'warning';
                let btnText = 'Verwijder Inschrijving';
                let btnClass = 'btn-success';

                let modal = new Noty({
                    timeout: false,
                    layout: 'center',
                    modal: true,
                    type: type,
                    text: text,
                    buttons: [
                        Noty.button(btnText, `btn ${btnClass}`, function () {
                            // Delete genre and close modal
                            deleteRegistatie(registratieid);
                            modal.close();
                        }),
                        Noty.button('Cancel', 'btn btn-secondary ml-2', function () {
                            modal.close();
                        })
                    ]
                }).show();
            });

        });
        function deleteRegistatie(registratieid) {

            let pars = {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete'
            };
            $.post(`/organizer/registraties/${registratieid}`, pars, 'json')
                .done(function (data) {
                    console.log('data', data);
                    // Rebuild the table
                    new Noty({
                        type: data.type,
                        text: data.text
                    }).show();
                    let id = registratieid;
                    $('#' + id).remove();
                })
                .fail(function (e) {
                    console.log('error', e);
                });
        }
        function printoverzicht(el){
            var restorepage=document.body.innerHTML;
            var printcontent=document.getElementById(el).innerHTML;
            document.body.innerHTML=printcontent;
            window.print();
            document.body.innerHTML=restorepage;
        }
    </script>
@endsection