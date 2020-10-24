@extends('layouts.template')

@section('title', 'inschrijven als helper')

@section('main')



    <h1>Taken</h1>

    <a href="#!" class="btn btn-outline-success btn-details" data-toggle="tooltip"
    >Inschrijvingen bekijken</a>

    {{ $tasks->appends(request()->except('page'))->links() }}
    <div class="table-responsive" id="overzicht">

        <table class="table">
            <thead>
            <tr>
                <th>Naam</th>
                <th>beschrijving</th>
                <th>start/einduur</th>
                <th>Commentaar</th>
                <th>Acties</th>
                <th>Inschrijvingen</th>

            </tr>
            </thead>
            <tbody id="usertable">
            @foreach ($tasks as $task)
                <tr>
                    <td>{{$task->name}}</td>
                    <td>{{$task->description}}</td>
                    <td>{{$task->start_hour}} - {{$task->end_hour}}</td>
                    <td>{{$task->note}}</td>
                    <td>
                        <a href="#!" class="btn btn-outline-success btn-confirm" data-toggle="tooltip"
                           data-id="{{$task->id}}" data-activity_id="{{$task->activity_id}}" data-note="{{$task->note}}"
                           data-end_hour="{{$task->end_hour}}" data-start_hour="{{$task->start_hour}}"
                           data-name="{{$task->name}}" data-description="{{$task->description}}">Inschrijven</a>
                    </td>

                    @php
                        {{$teller=0;}}
                    @endphp
                    @foreach($inschrijvingen as $inschrijving)

                        @if($task->id==$inschrijving->task_id)
                            @php
                                $teller+=1;
                            @endphp
                        @endif
                    @endforeach
                    <td>
                        <div>{{$teller}}</div>

                    </td>

                </tr>
            @endforeach


            </tbody>
        </table>
        <p>
            <a href="#!" class="btn btn-outline-success" id="btn-print" onclick="printoverzicht('overzicht')">
                <i class="fas fa-print mr-1"></i>Overzicht afprinten
            </a>
        </p>
    </div>

    @include('helper.confirm')
    @include('helper.details')
@endsection

@section("script_after")
    <script>

        //Overzicht afprinten
        function OverzichtPrinten() {
            window.print();
        }

        $(".btn-confirm").on('click', function () {
            $("#modal-bevestigen").modal('show');
            let id = $(this).data('id');
            $("#bevestigen").val(id);
            let activity_id = $(this).data('activity_id');
            //$("#activity_id").val(activity_id);
            $("#activity_id").attr('value',activity_id);
            console.log(activity_id);
            let name = $(this).data('name');
            let description = $(this).data('description');
            let start_hour = $(this).data('start_hour');
            let end_hour = $(this).data('end_hour');
            let note = $(this).data('note');
            $("#taak").text(name);
            $("#beschrijving").text(description);
            $("#starteind").text(start_hour + end_hour);
            $("#commentaar").text(note);
        });

        $(".btn-details").on('click',function(){
            $("#modal-details").modal('show');

        });

    </script>
@endsection