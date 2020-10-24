@extends('layouts.template')

@section('title', 'Vervoersmogelijkheid')

@section('main')
    <h1>Vervoersmogelijkheid</h1>
    @include('shared.alert')
    <p>
        <a href="/organizer/vervoersmogelijkheid/create" class="btn btn-outline-success">
            <i class="fas fa-plus-circle mr-1"></i>Maak een nieuwe vervoersmogelijkheid
        </a>
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>

                <th>Naam</th>
                <th>Beschrijving</th>
                <th class="text-center">Actief</th>

                <th>Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach($transportoptions as $transportoption)
                <tr>

                    <td>{{ $transportoption->name }}</td>
                    <td>{{ $transportoption->description}}</td>
                    @if ($transportoption->active == 1)
                        <td class="text-center"><i class="fas fa-check"></i></td>

                    @else
                        <td></td>
                    @endif


                    <td>
                        <form action="/organizer/vervoersmogelijkheid/{{ $transportoption->id }}" method="post" class="deleteForm">
                            @method('delete')
                            @csrf
                            <div class="btn-group btn-group-sm">
                                <a href="/organizer/vervoersmogelijkheid/{{ $transportoption->id }}/edit" class="btn btn-outline-success"
                                   data-toggle="tooltip"
                                   title="Bewerk {{ $transportoption->name }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button type="button" class="btn btn-outline-danger"
                                        data-toggle="tooltip"
                                        title="Verwijder {{ $transportoption->name }}">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="text-right"><a href=/organizer/staffparties ><button class="btn button">Home</button></a></div>
@endsection
@section('script_after')
    <script>
        $(function () {
            $('.deleteForm button').click(function () {

                let msg = `Deze vervoersmogelijkheid verwijderen?`;
                if(confirm(msg)) {
                    $(this).closest('form').submit();
                }
            })
        });
    </script>
@endsection