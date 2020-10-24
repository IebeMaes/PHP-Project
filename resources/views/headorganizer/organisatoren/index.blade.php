@extends('layouts.template')

@section('title', 'organisatoren beheren')

@section('main')



    <h1>Organisatoren</h1>

    <p>
        <a href="#!" class="btn btn-outline-success" id="btn-create" data-toggle="tooltip" data-title="Klik hier om een nieuwe oganisator aan te passen">
            <i class="fas fa-plus-circle mr-1"></i>Nieuwe organisator aanmaken.
        </a>
    </p>

    {{ $users->appends(request()->except('page'))->links() }}

    <div class="table-responsive" id="overzicht">
        <table class="table">
            <thead>
            <tr>

                <th data-toggle="tooltip" data-title="Dit is de naam van de organisator.">Organisator</th>
                <th data-toggle="tooltip" data-title="Dit is het E-mailadres van de organisator.">E-mail</th>
                <th data-toggle="tooltip" data-title="Hoofdorganisatoren hebben meer machtigingen. Je kan dit aanpassen met de bewerkingsknop.">Hoofdorganisator</th>
                <th data-toggle="tooltip" data-title="Organisatoren die niet actief zijn (geen vinkje hebben) kunnen niet inloggen. Je kan organisatoren actief/inactief maken met de bewerkingsknop.">Actief</th>
                <th data-toggle="tooltip" data-title="Je kan een organisator aanpassen met de groene knop, of je kan de organisator verwijderen met de rode knop.">Acties</th>

            </tr>
            </thead>
            <tbody id="usertable">

            @foreach ($users as $user)
                <tr>

                    <td data-name="{{$user->first_name}}">{{$user->first_name}} {{$user->last_name}}</td>
                    <td data-mail="{{$user->email}}">{{$user->email}}</td>

                    @if ($user->active==0 && $user->head_organizer==0)
                        <td></td>
                        <td></td>
                    @endif
                    @if ($user->active==1 && $user->head_organizer==1)
                        <td><i class="fas fa-check"></i></td>
                        <td><i class="fas fa-check"></i></td>
                    @endif
                    @if ($user->active==0 && $user->head_organizer==1)
                        <td></td>
                        <td><i class="fas fa-check"></i></td>
                    @endif
                    @if ($user->active==1 && $user->head_organizer==0)

                        <td><i class="fas fa-check"></i></td>
                        <td></td>
                    @endif



                    <td>
                        <div class="btn-group btn-group-sm">

                            <a href="#!" class="btn btn-outline-success btn-edit"

                               data-toggle="tooltip" data-head_organizer="{{$user->head_organizer}}" data-active="{{$user->active}}" data-email="{{$user->email}}" data-last_name="{{$user->last_name}}" data-id="{{$user->id}}" data-first_name="{{$user->first_name}}" title="{{$user->first_name}} aanpassen"><i class="fas fa-edit"></i></a>


                            <a href="#!" class="btn btn-outline-danger btn-delete"
                               data-toggle="tooltip" data-id="{{$user->id}}" data-first_name="{{$user->first_name}}" title="{{$user->first_name}} verwijderen">

                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>

            @endforeach


            </tbody>
        </table>
        <p>
            <a data-toggle="tooltip" data-title="Met deze knop kan u een overzicht afprinten of opslaan als PDF." href="#!" class="btn btn-outline-success" id="btn-print" onclick="printoverzicht('overzicht')">
                <i class="fas fa-print mr-1"></i>Overzicht afprinten
            </a>
        </p>
    </div>
    @include('headorganizer.organisatoren.add')
    @include('headorganizer.organisatoren.edit')
    @include('headorganizer.organisatoren.remove')
@endsection

@section("script_after")
    <script>
        $("#btn-create").on('click',function(){
            $("#modal-aanmaken").modal('show');
        });

        $(".btn-delete").on('click',function () {
            $("#verwijderorganisator").modal('show');

            let id = $(this).data('id');

            console.log("verwijder" + id);
            $('#verwijderform').attr('action', `/headorganizer/users/{{$user->id}}`);


        });

        $(".btn-edit").on('click',function(){
            // Get data attributes from td tag
            let id = $(this).data('id');
            let first_name = $(this).data('first_name');
            let last_name = $(this).data('last_name');
            let email=$(this).data('email');
            let active=$(this).data('active');
            let head_organizer=$(this).data('head_organizer');
            console.log(first_name,last_name, id, email, active, head_organizer);

            // //script voor default checkboxes gebaseerd op waardes
            // if(active==1){
            //     $('#active').prop('checked', true);
            // }else{
            //     $('#active').prop('checked', false);
            // }
            // if(head_organizer==1){
            //     $('#hoofdorganisator').prop('checked', true);
            // }else{
            //     $('#hoofdorganisator').prop('checked', false);
            // }
            // Update the modal

            $('#titeledit').text(`${first_name} ${last_name} aanpassen`);
            $('form').attr('action', `/headorganizer/users/${id}`);

            $('#first_nameedit').val(first_name);
            $('#last_nameedit').val(`${last_name}`);
            $("#emailedit").val(`${email}`);
            // $('input[name="_method"]').val('put');
            // Show the modal

            $("#modal-aanpassen").modal('show');
        });


        //Overzicht afprinten
        function OverzichtPrinten() {
            window.print();
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