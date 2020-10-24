@extends('layouts.template')

@section('title', 'personeelsfeest')

@section('main')
    <h1 class="text-center">Personeelsfeest aanmaken</h1>

    <div class="row">
        <div class="col-lg-6 border-right">
            <h2>Nieuw</h2>
            <form action="/organizer/staffparties" method="post">
                @csrf
                <div class="form-group">
                    <label for="nameParty">Naam feest</label>
                    <input type="text" name="nameParty" id="nameParty"
                           class="form-control @error('nameParty') is-invalid @enderror"
                           placeholder="Naam"
                           required
                           value="{{old('nameParty', $staffparty->name)}}">
                    @error('nameParty')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="date">datum:</label>
                    <input type="date" id="date" name="date"
                           class="form-control @error('date') is-invalid @enderror"
                           required>
                    @error('date')
                    <div class="invalid-feedback">{{$message}}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="location">Locaties</label>
                    <select type="text" name="location" id="location"
                            class="form-control @error('location') is-invalid @enderror">
                        @foreach($locations as $location)
                            <option value="{{$location->id}}">{{$location->name}}, {{$location->street}}
                                , {{$location->town}}</option>
                        @endforeach
                    </select>
                    @error('location')
                    <div class="invalid-feedback"></div>
                    @enderror
                </div>

                <h3>Tijdssloten</h3>

                <div id="KorteActiviteiten">
                    <h4>Korte activiteiten</h4>
                    <div id="hiertoevoegenkort">
                        @foreach($dayparts as $daypart)
                            @if ($daypart->description == 'Korte activiteit')
                                @if ($staffparty->id == $daypart->staffparty_id)
                                <div id="{{$daypart->id}}">
                                    <input type="checkbox" name="daypart[]" id="{{$daypart->id}}"
                                           value="{{$daypart->id}}">
                                    <label class="pr-5" for="{{$daypart->id}}">{{$daypart->start_hour}}
                                        - {{$daypart->end_hour}}</label>
                                    <button type="button" class="btn btn-outline-danger deletedaypart"
                                            data-toggle="tooltip"
                                            data-id="{{$daypart->id}}"
                                            data-begin="{{$daypart->start_hour}}"
                                            data-eind="{{$daypart->end_hour}}"
                                            title="Delete daypart">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <br>
                                </div>
                                @endif
                            @endif
                        @endforeach
                    </div>
                    <a class="btn button btn-sm mb-3 adddaypart" style="color: white"
                       data-name="Kort dagdeel toevoegen" data-action="/organizer/staffparties/addshort"
                       data-description="Korte activiteit">
                        Dagdeel toevoegen
                    </a>
                </div>


                <div id="LangeActiviteiten">
                    <h4>Lange activiteiten</h4>
                    <div id="hiertoevoegenlang">
                        @foreach($dayparts as $daypart)
                            @if ($daypart->description == 'Lange activiteit')
                                @if ($staffparty->id == $daypart->staffparty_id)
                                <div id="{{$daypart->id}}">
                                    <input type="checkbox" name="daypart[]" id="{{$daypart->id}}"
                                           value="{{$daypart->id}}">
                                    <label class="pr-5" for="{{$daypart->id}}">{{$daypart->start_hour}}
                                        - {{$daypart->end_hour}}</label>
                                    <button type="button" class="btn btn-outline-danger deletedaypart"
                                            data-toggle="tooltip"
                                            data-id="{{$daypart->id}}"
                                            data-begin="{{$daypart->start_hour}}"
                                            data-eind="{{$daypart->end_hour}}"
                                            title="Delete daypart">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <br>
                                </div>
                            @endif
                            @endif
                        @endforeach
                    </div>
                    <a class="btn button btn-sm mb-3 adddaypart" style="color: white"
                       data-name="Lang dagdeel toevoegen" data-action="/organizer/staffparties/addshort"
                       data-description="Lange activiteit">
                        Dagdeel toevoegen
                    </a>
                </div>

                <div id="AvondActiviteiten">
                    <h4>Avond activiteiten</h4>
                    <div id="hiertoevoegenavond">
                        @foreach($dayparts as $daypart)
                            @if ($daypart->description == 'Avond activiteit')
                                @if ($staffparty->id == $daypart->staffparty_id)
                                <div id="{{$daypart->id}}">
                                    <input type="checkbox" name="daypart[]" id="{{$daypart->id}}"
                                           value="{{$daypart->id}}">
                                    <label class="pr-5" for="{{$daypart->id}}">{{$daypart->start_hour}}
                                        - {{$daypart->end_hour}}</label>
                                    <button type="button" class="btn btn-outline-danger deletedaypart"
                                            data-toggle="tooltip"
                                            data-id="{{$daypart->id}}"
                                            data-begin="{{$daypart->start_hour}}"
                                            data-eind="{{$daypart->end_hour}}"
                                            title="Delete daypart">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                    <br>
                                </div>
                            @endif
                            @endif
                        @endforeach
                    </div>
                    <a class="btn button btn-sm mb-3 adddaypart" style="color: white"
                       data-name="Avond dagdeel toevoegen" data-action="/organizer/staffparties/addshort"
                       data-description="Avond activiteit">
                        Dagdeel toevoegen
                    </a>
                </div>

                <div>
                    <button type="submit" class="btn btn-success">Feest aanmaken</button>
                </div>
            </form>
        </div>


        <div class="col-lg-6">
            <h2>Kopiëren</h2>
            <p>Als het feest dat je wilt aanmaken gelijkaardig is aan het vorige feest, kan je de gegevens kopiëren uit
                het vorige feest. Je kan nadien nog wijzigingen maken.</p>
            <p>Kies uit de lijst het feest waar uw de gegevens van wilt kopiëren</p>



            <form action="{{url('/organizer/staffparties/copyparty')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="staffpartyselect">Personeelsfeesten</label>
                    <select type="text" name="staffpartyselect" id="staffpartyselect"
                            class="form-control">
                        @foreach($staffparties as $staffparty)
                            <option value="{{$staffparty->id}}">{{$staffparty->name}} op: {{$staffparty->date}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn button btn-block">Feest kopiëren</button>
                </div>
            </form>
        </div>
    </div>


    @include('organizer.personeelsfeest.add_daypart')
@endsection

@section('script_after')

    <script>
        //AANMAKEN VAN EEN DAGDEEl
        $(".adddaypart").on('click', function () {
            let titel = $(this).data('name');
            let description = $(this).data('description');
            console.log(description);
            $('#titeldaypart').text(titel);
            $('#description').val(description);
            $('#newdaypart').data('descriptionb', description);
            $('#modal-toevoegen').modal('show');
        });

        $("#newdaypart").on('click', function (e) {
            e.preventDefault();
            let action = `/organizer/staffparties/addshort`;
            let descriptionmodal = $(this).data('descriptionb');
            console.log(descriptionmodal);
            let pars = $('#aanmaakform').serialize();
            console.log('pars:', pars);
            $.post(action, pars, 'json')
                .done(function (data) {
                    console.log("data", data);
                    let row = `<div id="${data.id}">
                            <input type="checkbox" name="daypart[]" id="${data.id}"
                                   value="${data.id}">
                            <label class="pr-5" for="${data.id}">${data.start_hour} -${data.end_hour} </label>
                            <button type="button" class="btn btn-outline-danger deletedaypart"
                                    data-toggle="tooltip"
                                    data-id="${data.id}"
                                    data-begin="${data.start_hour}"
                                    data-eind="${data.end_hour}"
                                    title="Delete daypart">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                            <br>
                            </div>`;
                    if (descriptionmodal === 'Korte activiteit'){
                        $("#hiertoevoegenkort").append(row);
                    }
                    if (descriptionmodal === 'Lange activiteit'){
                        $("#hiertoevoegenlang").append(row);
                    }
                    if (descriptionmodal === 'Avond activiteit'){
                        $('#hiertoevoegenavond').append(row);
                    }


                    $('#modal-toevoegen').modal('hide');
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


        //Deleten van een dagdeel//

        $('body').on('click', '.deletedaypart',  function () {
            let id = $(this).data('id');
            console.log(id);
            let beginuur = $(this).data("begin");
            console.log(beginuur);
            let einduur = $(this).data("eind");
            console.log(einduur);

            let text = `Wilt u hetvolgende dagdeel verwijderen? \n beginuur: ${beginuur} \n einduur ${einduur}`;
            let type = 'warning';
            let btnText = 'Verwijder dagdeel';
            let btnClass = 'btn-success';
            let modal = new Noty({
                timeout: false,
                layout: 'center',
                modal: true,
                type: type,
                text: text,
                buttons: [
                    Noty.button(btnText, `btn ${btnClass}`, function () {

                        deletedagdeel(id);
                        modal.close();

                    }),
                    Noty.button('Cancel', 'btn btn-secondary ml-2', function () {
                        modal.close();
                    })
                ]
            }).show();
        });


        function deletedagdeel(id) {
            let pars = {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete',
                'id': id
            };
            $.post(`/organizer/staffparty/deletedaypart`, pars, 'json')
                .done(function () {
                    console.log('gelukt', id);
                    $('#'+id).remove();
                    // $("#KorteActiviteiten").load(location.href + " #KorteActiviteiten>*", "");
                    // location.reload();

                })
                .fail(function (e) {
                    console.log('error', e);
                });

            console.log('id', id);
        }

        //EINDE DELETEN VAN EEN DAGDEEl
    </script>
@endsection
