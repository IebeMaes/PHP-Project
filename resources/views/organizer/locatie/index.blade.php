@extends('layouts.template')

@section('title', 'Locaties beheren')

@section('main')
    <h1>Locaties</h1>

    <p>
        <a href="#!" class="btn btn-outline-success" id="btn-create">
            <i class="fas fa-plus-circle mr-1"></i>Nieuwe locatie
        </a>
    </p>

    <form method="get" action="/organizer/locations" id="searchForm">
        <div class="row">
            <div class="col-sm-5 mb-2">
                <input type="text" class="form-control" name="search" id="search"
                       value="{{ request()->search }}"
                       placeholder="Zoek een locatie">
            </div>
        </div>
    </form>
    <div class="table-responsive" id="overzicht">
        <table class="table">
            <thead>
            <tr>

                <th>Naam</th>
                <th>Gemeente</th>
                <th>Postcode</th>
                <th>Straat</th>
                <th>Acties</th>

            </tr>
            </thead>
            <tbody>

            @foreach($locations as $location)
                <tr id="{{$location->id}}">
                    <td hidden>{{$location->id}}</td>
                    <td>{{$location->name}}</td>
                    <td>{{$location->town}}</td>
                    <td>{{$location->postalcode}}</td>
                    <td>{{$location->street}}</td>

                    <td>
                        <div class="btn-group btn-group-sm">
                            <a href="#!" class="btn btn-outline-success aanpassen-locatie"
                               data-toggle="tooltip" data-id="{{$location->id}}"
                               title="{{$location->name}} bewerken"><i class="fas fa-edit"></i>
                            </a>

                            <a href="#!" class="btn btn-outline-danger locatie-verwijderen"
                               data-toggle="tooltip" data-id="{{$location->id}}" title="{{$location->name}} verwijderen"
                               data-name="{{$location->name}}"><i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach


            </tbody>
        </table>
        {{ $locations->appends(request()->except('page'))->links() }}
        <p>
            <a href="#!" class="btn btn-outline-success" id="btn-print" onclick="printoverzicht('overzicht')">
                <i class="fas fa-print mr-1"></i>Overzicht afprinten
            </a>
        </p>
    </div>
@include('organizer.locatie.add')
    @include('organizer.locatie.edit')
@endsection

@section("script_after")
    <script>
        $('#search').blur(function () {
            $('#searchForm').submit();
        });

        //aanmaken van een nieuwe locatie
        $('#btn-create').on('click', function () {
           $('#modal-locatie-toevoegen').modal('show');
        });

        $('#newlocation').on('click', function (e) {
            e.preventDefault();
            let action = `/organizer/locations`;
            let descriptionmodal = $(this).data('descriptionb');
            console.log(descriptionmodal);
            let pars = $('#aanmaakform').serialize();
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
                    $('#modal-locatie-toevoegen').modal('hide');
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
            let text = `Wilt u de locatie "${name}" verwijderen?`;
            let type = 'warning';
            let btnText = 'Verwijder Locatie';
            let btnClass = 'btn-success';
            let modal = new Noty({
                timeout: false,
                layout: 'center',
                modal: true,
                type: type,
                text: text,
                buttons: [
                    Noty.button(btnText, `btn ${btnClass}`, function () {
                        deletelocatie(id);
                        modal.close();
                    }),
                    Noty.button('Annuleer', 'btn btn-secondary ml-2', function () {
                        modal.close();
                    })
                ]
            }).show();
        });
        function deletelocatie(id) {
            let pars = {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete',

            };
            $.post(`/organizer/locations/${id}`, pars, 'json')
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
            namelocation = $(this).closest('tr').find('td:nth-child(2)').text();
            console.log(namelocation);
            town = $(this).closest('tr').find('td:nth-child(3)').text();
            console.log(town);
            postalcode = $(this).closest('tr').find('td:nth-child(4)').text();
            console.log(postalcode);
            street = $(this).closest('tr').find('td:nth-child(5)').text();
            console.log(street);

            //modal invullen met voorgaande gegevens
            $('#editnamelocation').val(namelocation);
            $('#edittownlocation').val(town);
            $('#editpostalcodelocation').val(postalcode);
            $('#editstreetlocation').val(street);

            $('#bewerkform').attr('action', `/organizer/locations/${id}`);
            //
            // //ingevulde modal tonen
            $('#modal-locatie-bewerken').modal('show');
        });

        $('#editlocation').on('click', function (e) {
            e.preventDefault();
            let action = $('#bewerkform').attr('action');
            console.log(action);

            let pars = $('#bewerkform').serialize();
            console.log('pars:', pars);
            $.post(action, pars, 'json')
                .done(function (data) {
                    console.log("data", data);
                    new Noty({
                        type: data.type,
                        text: data.text
                    }).show();
                    let naammodal = $('#editnamelocation').val();
                    let townmodal = $('#edittownlocation').val();
                    let postalcodemodal = $('#editpostalcodelocation').val();
                    let streetmodal = $('#editstreetlocation').val();
                    console.log('naam modal', naammodal);

                    // Hide the modal
                    $('#modal-locatie-bewerken').modal('hide');
                    // Rebuild the table
                    $('#'+id).find('td:nth-child(2)').replaceWith(`<td>${naammodal}</td>`);
                    $('#'+id).find('td:nth-child(3)').replaceWith(`<td>${townmodal}</td>`);
                    $('#'+id).find('td:nth-child(4)').replaceWith(`<td>${postalcodemodal}</td>`);
                    $('#'+id).find('td:nth-child(5)').replaceWith(`<td>${streetmodal}</td>`);


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
