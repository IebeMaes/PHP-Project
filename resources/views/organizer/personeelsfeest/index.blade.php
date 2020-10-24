@extends('layouts.template')

@section('title', 'personeelsfeest')

@section('main')
    <h1>Overzicht Personeelsfeesten</h1>
    <div class="uitlijnen">
        <a href="/organizer/staffparties/create">
            <button class="btn btn-success">Nieuw personeelsfeest aanmaken</button>
        </a>
        <a href="/organizer/helpers">
            <button class="btn button">Helpers beheren</button>
        </a>
        <a href="/organizer/vervoersmogelijkheid">
            <button class="btn button">Vervoer Beheren</button>
        </a>
        <a href="/organizer/mailtemplates">
            <button class="btn button">Mailtemplate Beheren</button>
        </a>
        <a href="/organizer/locations">
            <button class="btn button">Locaties Beheren</button>
        </a>
        <button class="btn  btn-warning rounded" id="Ondersteuning">
            <i class="fas fa-question"></i>
        </button>
    </div>


    <div class="card-columns pt-4">
        @foreach($staffparties as $staffparty)
            <div class="card" style="width: 22rem;">
                <div class="card-body">
                    <form action="/organizer/staffparties/{{ $staffparty->id }}" method="post" class="deleteform">
                        @method('delete')
                        @csrf
                        <button class="btn btn-light"
                                data-toggle="tooltip"
                                data-id="{{$staffparty->id}}"
                                data-name="{{$staffparty->name}}">
                            <span>x</span>
                        </button>
                    </form>


                    <h5 class="card-title text-center"><b>{{$staffparty->name}}</b></h5>
                    <h6 class="card-subtitle mb-2">{{$staffparty->date}}</h6>
                    <h6 class="card-subtitle mb-2">{{$staffparty->location->name}}</h6>

                    <div class="text-center"><a href="#" class="card-link">
                            <button class="btn btn-success">Uitnodigen</button>
                        </a>
                        <a href="/organizer/staffparties/{{$staffparty->id}}/edit" class="card-link">
                            <button class="btn btn-light btn-outline-dark">Bewerken</button>
                        </a>
                    </div>
                    <hr>
                    <div class="text-left "><a href="{{URL::to('/organizer/activiteiten/'.$staffparty->id)}}" class="card-link">
                            <button class="btn button">Activiteiten beheren</button>
                        </a>
                        <a href="{{URL::to('/organizer/taken/'.$staffparty->id)}}" class="card-link">
                            <button class="btn button">Taken beheren</button>
                        </a>
                    </div>
                    <div class="pt-2 text-left">
                        <a href="{{URL::to('/organizer/registratieshelpers/'.$staffparty->id)}}" class="card-link">
                            <button class="btn button">Inschrijvingen helpers</button>
                        </a>
                        <a href="{{URL::to('/organizer/registraties/'.$staffparty->id)}}" class="card-link">
                            <button class="btn button">Inschrijvingen</button>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @include('organizer.personeelsfeest.ondersteuning')
@endsection

@section('script_after')
    <script>
        $(".deleteform button").on('click',  function(e){
            e.preventDefault();
            let naam = $(this).data('name');
            console.log(naam);
            let id = $(this).data('id');
            console.log(id);

            let text = `Wilt u  ${naam} verwijderen?`;
            let type = 'warning';
            let btnText = 'Verwijder personeelsfeest';
            let btnClass = 'btn-success';
            let modal = new Noty({
                timeout: false,
                layout: 'center',
                modal: true,
                type: type,
                text: text,
                buttons: [
                    Noty.button(btnText, `btn ${btnClass}`, function () {

                        deleteParty(id);
                        modal.close();

                    }),
                    Noty.button('Annuleer', 'btn btn-secondary ml-2', function () {
                        modal.close();
                    })
                ]
            }).show();
        });


        function deleteParty(id) {
            let pars = {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete'
            };
            $.post(`/organizer/staffparties/${id}`, pars, 'json')
                .done(function () {
                    console.log('gelukt', id);
                    location.reload();

                })
                .fail(function (e) {
                    console.log('error', e);
                });

            console.log('id', id);
        }

    $("#Ondersteuning").on('click', function () {
        $("#modal-ondersteuning").modal('show');
    });
    </script>
@endsection

