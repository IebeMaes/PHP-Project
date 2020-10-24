@extends('layouts.template')

@section('title', 'Deelnemers beheren')

@section('main')
    <h1>Locaties</h1>

    <p>
        <a href="#!" class="btn btn-outline-success" id="btn-create-deelnemer">
            <i class="fas fa-plus-circle mr-1"></i>Nieuwe deelnemer
        </a>
    </p>

    <div class="table-responsive" id="overzicht">
        <table class="table">
            <thead>
            <tr>

                <th>Naam</th>
                <th>telefoonnummer</th>
                <th>email</th>
                <th>U - nummer</th>
                <th>Acties</th>

            </tr>
            </thead>
            <tbody>

            @foreach($participants as $participant)
                <tr id="{{$participant->id}}">
                    <td hidden>{{$participant->id}}</td>
                    <td>{{$participant->first_name}} {{$participant->last_name}}</td>
                    <td>{{$participant->cellphone}}</td>
                    <td>{{$participant->email}}</td>
                    <td>{{$participant->unumber}}</td>

                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#!" class="btn btn-outline-success aanpassen-locatie"
                               data-toggle="tooltip" data-id="{{$participant->id}}"
                               title="{{$participant->first_name}} {{$participant->last_name}} bewerken"><i class="fas fa-edit"></i>
                            </a>

                            <a href="#!" class="btn btn-outline-danger locatie-verwijderen"
                               data-toggle="tooltip" data-id="{{$participant->id}}" title="{{$participant->first_name}} {{$participant->last_name}} verwijderen"
                               data-name="{{$participant->first_name}}" data-last="{{$participant->last_name}}"><i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach


            </tbody>
        </table>
        {{ $participants->appends(request()->except('page'))->links() }}
        <p>
            <a href="#!" class="btn btn-outline-success" id="btn-print" onclick="printoverzicht('overzicht')">
                <i class="fas fa-print mr-1"></i>Overzicht afprinten
            </a>
        </p>
    </div>
    @include('organizer.participant.add')
    @include('organizer.participant.edit')
@endsection

@section("script_after")
    <script>

        //aanmaken van een nieuwe locatie
        $('#btn-create-deelnemer').on('click', function () {
            $('#modal-deelnemer-toevoegen').modal('show');
        });

        $('#newdeelnemer').on('click', function (e) {
            e.preventDefault();
            let action = `/organizer/deelnemers`;
            let pars = $('#aanmaakformdeelnemer').serialize();
            console.log('pars:', pars);
            $.post(action, pars, 'json')
                .done(function (data) {
                    console.log("data", data);
                    new Noty({
                        type: data.type,
                        text: data.text
                    }).show();

                    setTimeout(function(){
                        location.reload();
                    }, 4000);
                    $('#modal-deelnemer-toevoegen').modal('hide');
                })
                .fail(function (e) {
                    console.log('error', e);
                    console.log('error message', e.responseJSON.errors);
                    let msg = '<ul>';
                    $.each(e.responseJSON.errors, function (key, value) {
                        msg += `<li>${value}</li>`;
                    });
                    msg += '</ul>';
                    new Noty({
                        type: 'error',
                        text: msg
                    }).show();
                });
        });



        //verwijderen van een locatie
        $(".locatie-verwijderen").on('click', function (e) {
            let id = $(this).data('id');
            console.log(id);
            let name = $(this).data('name');
            let last = $(this).data('last');
            let text = `Wilt u de deelnemer "${name} ${last}" verwijderen?`;
            let type = 'warning';
            let btnText = 'Verwijder deelnemer';
            let btnClass = 'btn-success';
            let modal = new Noty({
                timeout: false,
                layout: 'center',
                modal: true,
                type: type,
                text: text,
                buttons: [
                    Noty.button(btnText, `btn ${btnClass}`, function () {
                        deletedeelnemer(id);
                        modal.close();
                    }),
                    Noty.button('Annuleer', 'btn btn-secondary ml-2', function () {
                        modal.close();
                    })
                ]
            }).show();
        });
        function deletedeelnemer(id) {
            let pars = {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete',

            };
            $.post(`/organizer/deelnemers/${id}`, pars, 'json')
                .done(function (data) {
                    console.log(data);
                    console.log('gelukt', id);
                    new Noty({
                        type: data.type,
                        text: data.text
                    }).show();
                    $('#'+id).remove();

                })
                .fail(function (e) {
                    console.log('error', e);
                });
            console.log('id', id);
        }


        //bewerken van een locatie

        $('.aanpassen-locatie').on('click', function () {
            //gegevens ophalen uit de juiste table row
            id = $(this).closest('tr').find('td:nth-child(1)').text();
            console.log(id);
            naam = $(this).closest('tr').find('td:nth-child(2)').text();
            console.log(naam);
            voornaam = naam.substr(0, naam.indexOf(' '));
            achternaam = naam.substr(naam.indexOf(' ')+1);
            console.log(voornaam);
            console.log(achternaam);
            cellphone = $(this).closest('tr').find('td:nth-child(3)').text();
            console.log(cellphone);
            email = $(this).closest('tr').find('td:nth-child(4)').text();
            console.log(email);
            unummer = $(this).closest('tr').find('td:nth-child(5)').text();
            console.log(unummer);

            //modal invullen met voorgaande gegevens
            $('#editvoornaam').val(voornaam);
            $('#editachternaam').val(achternaam);
            $('#edittelefoonnummer').val(cellphone);
            $('#editemail').val(email);
            $('#editunummer').val(unummer);

            $('#bewerkformDeelnemer').attr('action', `/organizer/deelnemers/${id}`);
            //
            // //ingevulde modal tonen
            $('#modal-deelnemer-bewerken').modal('show');
        });

        $('#editlocation').on('click', function (e) {
            e.preventDefault();
            let action = $('#bewerkformDeelnemer').attr('action');
            console.log(action);

            let pars = $('#bewerkformDeelnemer').serialize();
            console.log('pars:', pars);
            $.post(action, pars, 'json')
                .done(function (data) {
                    console.log("data", data);
                    new Noty({
                        type: data.type,
                        text: data.text
                    }).show();
                    let voornaammodal = $('#editvoornaam').val();
                    let achternaammodal = $('#editachternaam').val();
                    let telefoonnummermodal = $('#edittelefoonnummer').val();
                    let emailmodal = $('#editemail').val();
                    let unummermodal = $('#editunummer').val();


                    // Hide the modal
                    $('#modal-deelnemer-bewerken').modal('hide');

                    $('#'+id).find('td:nth-child(2)').replaceWith(`<td>${voornaammodal} ${achternaammodal}</td>`);
                    $('#'+id).find('td:nth-child(3)').replaceWith(`<td>${telefoonnummermodal}</td>`);
                    $('#'+id).find('td:nth-child(4)').replaceWith(`<td>${emailmodal}</td>`);
                    $('#'+id).find('td:nth-child(5)').replaceWith(`<td>${unummermodal}</td>`);


                })
                .fail(function (e) {
                    console.log('error', e);
                    console.log('error message', e.responseJSON.errors);
                    let msg = '<ul>';
                    $.each(e.responseJSON.errors, function (key, value) {
                        msg += `<li>${value}</li>`;
                    });
                    msg += '</ul>';
                    new Noty({
                        type: 'error',
                        text: msg
                    }).show();
                });
        });
    </script>
@endsection
