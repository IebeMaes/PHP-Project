@extends('layouts.template')

@section('title', 'personeelsleden beheren')

@section('main')
    <h1>Personeelsleden</h1>

    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Personeelslid</th>
                <th>E-mail</th>
                <th>U-nummer</th>
                <th>Tel. nummer</th>
                <th>Acties</th>
            </tr>
            </thead>
            <tbody id="usertable">

            @foreach ($users as $user)

                <tr>
                    <td data-id="{{$user->id}}">{{$user->id}}</td>
                    <td data-name="{{$user->first_name}}">{{$user->first_name}} {{$user->last_name}}</td>
                    <td data-mail="{{$user->email}}">{{$user->email}}</td>
                    <td data-unummer="{{$user->unumber}}">{{$user->unumber}}</td>
                    <td data-telnummer="{{$user->cellphone}}">{{$user->cellphone}}</td>

                    <td>
                        <div class="btn-group btn-group-sm">

                            <a href="#!" class="btn btn-outline-success btn-edit"
                               data-toggle="tooltip" data-cellphone="{{$user->cellphone}}" data-unumber="{{$user->unumber}}" data-email="{{$user->email}}" data-last_name="{{$user->last_name}}" data-id="{{$user->id}}" data-first_name="{{$user->first_name}}" title="Edit {{$user->first_name}} {{$user->last_name}}"><i class="fas fa-edit"></i></a>


                            <a href="#!" class="btn btn-outline-danger btn-delete"
                               data-toggle="tooltip" data-id="{{$user->id}}" data-first_name="{{$user->first_name}}" title="Delete {{$user->first_name}} {{$user->last_name}}">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>

            @endforeach


            </tbody>
        </table>
    </div>

    @include('organisatoren.gebruiker_aanpassen')
    @include('organisatoren.gebruiker_verwijderen')
@endsection

@section("script_after")
    <script>
        $("#btn-create").on('click',function(){
            $("#modal-aanmaken").modal('show');
        });

        $(".btn-delete").on('click',function () {
            $("#verwijderorganisator").modal('show');

            let id = $(this).data('id');
            $('#verwijderform').attr('action', `/organizers/${id}`);
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


            // Update the modal
            $('.modal-title').text(`Edit ${first_name} ${last_name}`);
            $('form').attr('action', `/organizers/${id}`);
            $('#first_name').val(first_name);
            $('#last_name').val(`${last_name}`);
            $("#email").val(`${email}`);
            $('input[name="_method"]').val('put');
            // Show the modal

            $("#modal-aanpassen").modal('show');
        });

    </script>
@endsection