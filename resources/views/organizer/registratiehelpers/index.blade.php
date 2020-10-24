@extends('layouts.template')

@section('title', 'Helpers')

@section('main')
    <div id="overzicht">
    <h1>Inschrijvingen helpers</h1>
    @include('shared.alert')

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>

                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Telefoon</th>
                <th>E-mail</th>

                <th>Taak</th>
                <th>Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach($participants as $participant)
                <tr id="{{$participant->registrationtask[0]->id}}">

                    <td>{{ $participant->first_name }}</td>
                    <td>{{ $participant->last_name }}</td>
                    <td>{{ $participant->cellphone }}</td>
                    <td>{{ $participant->email }}</td>
                        <td>{{$participant->registrationtask[0]->task->name}}</td>



                    <td  data-registrationtaskid="{{$participant->registrationtask[0]->id}}" data-name="{{$participant->first_name}}">

                            <div class="btn-group btn-group-sm">

                                <a href="#!" class="btn btn-outline-danger btn-delete" data-toggle="tooltip"  title="De inschrijving van helper {{$participant->first_name}} verwijderen">
                                    <i class="fas fa-trash"></i>
                                </a>
                            </div>

                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{--kjlkjlkjl--}}
    </div>
    </div>
    {{ $participants->links() }}
    <div class="text-right mb-3"><a href=/organizer/staffparties ><button class="btn button">Home</button></a>
        <a href="#!" class="btn btn-outline-success" id="btn-print" onclick="printoverzicht('overzicht')">
            <i class="fas fa-print mr-1"></i>Overzicht afprinten
        </a></div>

@endsection
@section('script_after')
    <script>
        $(function () {
            $('tbody').on('click', '.btn-delete', function () {
                // Get data attributes from td tag
                let registrationtaskid = $(this).closest('td').data('registrationtaskid');
                let name = $(this).closest('td').data('name');

                // Set some values for Noty
                let text = `<p>Verwijder de inschrijving van helper <b>${name}</b>?</p>`;
                let type = 'warning';
                let btnText = 'Verwijder inschrijving';
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
                            deleteInschrijving(registrationtaskid);
                            modal.close();
                        }),
                        Noty.button('Cancel', 'btn btn-secondary ml-2', function () {
                            modal.close();
                        })
                    ]
                }).show();
            });

        });
        function deleteInschrijving(registrationtaskid) {

            let pars = {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete'
            };
            $.post(`/organizer/registratieshelpers/${registrationtaskid}`, pars, 'json')

                .done(function (data) {
                    console.log('data', data);
                    // Rebuild the table
                    new Noty({
                        type: data.type,
                        text: data.text
                    }).show();
                    let id = registrationtaskid;
                    $('#' + id).remove();
                })
                .fail(function (e) {
                    console.log('error', e);
                });
        }
    </script>
@endsection