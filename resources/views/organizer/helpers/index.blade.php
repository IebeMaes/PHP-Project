@extends('layouts.template')

@section('title', 'Helpers')

@section('main')
    <h1>Helpers</h1>
    @include('shared.alert')
    <p>
        <a href="/organizer/helpers/create" class="btn btn-outline-success">
            <i class="fas fa-plus-circle mr-1"></i>Maak een nieuwe helper
        </a>
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>

                <th>Voornaam</th>
                <th>Achternaam</th>
                <th>Telefoon</th>
                <th>E-mail</th>
                <th>U-nummer</th>
                <th>Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach($participants as $participant)
                <tr>

                    <td>{{ $participant->first_name }}</td>
                    <td>{{ $participant->last_name }}</td>
                    <td>{{ $participant->cellphone }}</td>
                    <td>{{ $participant->email }}</td>
                    <td>{{ $participant->unumber }}</td>

                    <td>
                        <form action="/organizer/helpers/{{ $participant->id }}" method="post" class="deleteForm">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/organizer/helpers/{{ $participant->id }}/edit" class="btn btn-outline-success"
                                   data-toggle="tooltip"
                                   title="Bewerk {{ $participant->first_name }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger"
                                        data-toggle="tooltip"
                                        title="Verwijder {{ $participant->first_name }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{--kjlkjlkjl--}}
    </div>
    {{ $participants->links() }}
    <div class="text-right"><a href=/organizer/staffparties ><button class="btn button">Home</button></a></div>

@endsection
@section('script_after')
    <script>
        $(function () {
            $('.deleteForm button').click(function () {

                let msg = `Deze helper verwijderen?`;
                if(confirm(msg)) {
                    $(this).closest('form').submit();
                }
            })
        });
    </script>
@endsection