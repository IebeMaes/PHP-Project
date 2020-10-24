@extends('layouts.template')

@section('title', 'Profiel')

@section('main')

    <h1 class="text-center">Mijn profiel</h1>
    <br>
    <div class="row justify-content-center">
        <div class="col-auto">
            <table class="table table-responsive">
                <tr>
                    <th>Naam</th>
                    <td id="naam">{{auth()->user()->first_name}} {{auth()->user()->last_name}}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td id="email">{{auth()->user()->email}}</td>
                </tr>
                <tr>
                    <th>Hoofdorganisator</th>
                    @if (auth()->user()->head_organizer == 1)
                        <td>Ja</td>
                    @endif
                    @if (auth()->user()->head_organizer == 0)
                        <td>Nee</td>
                    @endif

                </tr>
            </table>

            <a href="#!" class="btn btn-outline-success mb-5" style="width: 100%" id="bewerk-profiel">
                <i class="fas fa-edit mr-1"></i>Account bewerken
            </a>
        </div>
    </div>
    @include('organizer.profile.edit')
@endsection
@section('script_after')
    <script>
        $('#bewerk-profiel').on('click', function () {
            $('#bewerkprofielform').attr('action', `/organizer/profile`);
            $('#modal-profiel-bewerken').modal('show');
        });


        $('#editprofiel').on('click', function (e) {
            e.preventDefault();
            let action = $('#bewerkprofielform').attr('action');
            console.log(action);
            let pars = $('#bewerkprofielform').serialize();
            console.log('pars', pars);
            $.post(action, pars, 'json')
                .done(function (data) {
                    console.log("data", data);
                    new Noty({
                        type: data.type,
                        text: data.text
                    }).show();
                    let naammodal = $('#naamprof').val();
                    let emailmodal = $('#emailprof').val();
                    console.log('naam modal', naammodal);

                    // Hide the modal
                    $('#modal-profiel-bewerken').modal('hide');
                    // Rebuild the table
                    $('#naam').replaceWith(`<td id="naam">${naammodal}</td>`);
                    $('#email').replaceWith(`<td id="email">${emailmodal}</td>`);



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
