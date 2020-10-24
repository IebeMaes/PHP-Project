@extends('layouts.template')

@section('title', 'Taken')

@section('main')
    <h1>Taken</h1>
    {{--@include('shared.alert')--}}
    <p>
        <a class="btn btn-outline-success btn-add">
            <i class="fas fa-plus-circle mr-1"></i>Maak een nieuwe taak
        </a>
        {{--<select class="">--}}
            {{--@foreach($activities as $activity)--}}
                {{--<option value="{{ $activity->name }}">{{$activity->name}}</option>--}}
            {{--@endforeach--}}
        {{--</select>--}}
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>

                <th>Naam</th>
                <th>Beschrijving</th>
                <th>Hoort bij</th>
                <th>Opmerking</th>
                <th>Min aantal helpers</th>
                <th>Max aantal helpers</th>
                <th>Startuur</th>
                <th>Einduur</th>
                <th>Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach( $tasks as $task)


                <tr id="rowid{{$task->id}}">
                    <td class="d-none">{{ $task->id }}</td>
                    <td id="rowname{{$task->id}}">{{ $task->name }}</td>
                    <td id="rowdesc{{$task->id}}">{{ $task->description}}</td>
                    <td id="rowactivity{{$task->id}}">{{ $task->activity->name}}</td>
                    <td id="rownote{{$task->id}}">{{ $task->note }}</td>
                    <td id="rowmin{{$task->id}}">{{$task->min_number}}</td>
                    <td id="rowmax{{$task->id}}">{{$task->max_number}}</td>
                    <td id="rowstart{{$task->id}}">{{date('H:i',strtotime($task->start_hour))}}</td>
                    <td id="rowend{{$task->id}}">{{date('H:i',strtotime($task->end_hour))}}</td>
                    <td id="datasource{{$task->id}}" data-id="{{$task->id}}" data-activity="{{$task->activity->id}}">
                        <div class="btn-group btn-group-sm">
                            <a href="#!" class="btn btn-outline-success btn-edit"
                            title="Bewerk {{$task->name}}" data-toggle="tooltip">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#!" class="btn btn-outline-danger btn-delete"
                               title="Verwijder {{$task->name}}" data-toggle="tooltip">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>


                    </td>
                </tr>
            @endforeach

            </tbody>
            {{--{{ $tasks->links() }}--}}
        </table>

    </div>

    <div class="text-right"><a href=/organizer/staffparties ><button class="btn button">Home</button></a></div>

    @include('organizer.taken.modal')

@endsection
@section('script_after')
    <script>
        $(function () {

            $('tbody').on('click', '.btn-delete', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let name = $('#rowname' + id).text();
                let aid;
                console.log(id);
                console.log(name);
                // Set some values for Noty
                let text = `<p>Wil je <b>` + name + `</b> zeker verwijderen?</p>`;
                let type = 'warning';

                let btnText = 'Verwijder taak';

                let btnClass = 'btn-success';

                let modal = new Noty({
                    timeout: false,
                    layout: 'center',
                    modal: true,
                    type: type,
                    text: text,

                    width: '500px',
                    buttons: [
                        Noty.button(btnText, `btn ${btnClass}`, function () {
                            $('#rowid' + id).remove();
                            deletetask(id);

                            modal.close();
                        }),
                        Noty.button('Cancel', 'btn btn-secondary ml-2', function () {
                            modal.close();
                        })
                    ]
                }).show();


            });
            function deletetask(id) {
                // Delete the genre from the database
                let pars = {
                    '_token': '{{ csrf_token() }}',
                    '_method': 'delete'
                };

                $.post(`/organizer/taken/${id}`, pars, 'json')
                    .done(function(data) {
                        console.log(data);
                        new Noty({
                            type: data.type,
                            text: data.text,
                        }).show();
                    }).fail(function (e) {
                    console.log('error', e);
                });
            }
            $('tbody').on('click', '.btn-edit', function () {
                exists = true;
                // Get data attributes from td tag
                id = $(this).closest('td').data('id');
                aid = $(this).closest('td').data('activity');
                console.log('aid', aid);
                let name = $('#rowname' + id).text();

                // Update the modal
                $('.modal-title').text(`Bewerk ${name}`);
                $('form').attr('action', `/organizer/taken/${id}`);
                $('#name').val(name);
                $('#description').val($('#rowdesc' + id).text());
                $('#activity').val($('#datasource' + id).data('activity'));
                $('#comment').val($('#rownote' + id).text());
                $('#minhelper').val($('#rowmin' + id).text());
                $('#maxhelper').val($('#rowmax' + id).text());
                $('#beginuur').val($('#rowstart' + id).text());
                $('#einduur').val($('#rowend' + id).text());
                $('input[name="_method"]').val('put');
                // Show the modal
                $('#modal-tasks').modal('show');
            });
            $('.btn-add').click(function () {
                console.log('test');
                exists = false;
                // Update the modal
                $('.modal-title').text(`Taak toevoegen`);
                $('form').attr('action', `/organizer/taken`);
                $('#name').val("");
                $('#description').val("");
                $('#activity').val("");
                $('#comment').val("");
                $('#minhelper').val("");
                $('#maxhelper').val("");
                $('#beginuur').val("");
                $('#einduur').val("");
                $('input[name="_method"]').val('post');
                // Show the modal
                $('#modal-tasks').modal('show');
            });
            $('#modal-tasks form').submit(function (e) {
                e.preventDefault();
                // Get the action property (the URL to submit)
                let action = $(this).attr('action');
                // Serialize the form and send it as a parameter with the post
                let pars = $(this).serialize();

                console.log(pars);

                // Post the data to the URL
                $.post(action, pars, 'json')
                    .done(function (data) {
                        console.log(data);
                        // Noty success message
                        new Noty({
                            type: data.type,
                            text: data.text
                        }).show();
                        // Hide the modal
                        $('#modal-tasks').modal('hide');
                        if(exists){
                            // Rework the table
                            $('#rowname' + id).text($('#name').val());
                            $('#rowdesc' + id).text($('#description').val());
                            console.log($('#datasource' + id).data('activity'));
                            $('#datasource' + id).data('activity', $('#activity').val());
                            console.log($('#datasource' + id).data('activity'));
                            $('#rowactivity' + id).text($('#activity option:selected').text());
                            $('#rownote' + id).text($('#comment').val());
                            $('#rowmin' + id).text($('#minhelper').val());
                            $('#rowmax' + id).text($('#maxhelper').val());
                            $('#rowstart' + id).text($('#beginuur').val());
                            $('#rowend' + id).text($('#einduur').val());
                        }
                        else{
                            id = data.object.id;
                            let activityid = $('#activity').val();
                            console.log(activityid);
                            // Rework the table
                            let tr =
                                `<tr id="rowid` + id + `">
                                   <td class="d-none">` + id + `</td>
                                   <td id="rowname` + id + `">` + data.object.name +`</td>
                                   <td id="rowdesc` + id + `">` + data.object.description +`</td>
                                   <td id="rowactivity` + id + `">` + $('#activity option:selected').text() +`</td>
                                   <td id="rownote` + id + `">` + $('#comment').val() +`</td>
                                   <td id="rowmin` + id + `">` + $('#minhelper').val() +`</td>
                                   <td id="rowmax` + id + `">` + $('#maxhelper').val() +`</td>
                                   <td id="rowstart` + id + `">` + $('#beginuur').val() +`</td>
                                   <td id="rowend` + id + `">` + $('#einduur').val() +`</td>
                                   <td data-id="` + id + `" data-activity="` + activityid + `">
                                   <div class="btn-group btn-group-sm">
                                      <a href="#!" class="btn btn-outline-success btn-edit">
                                         <i class="fas fa-edit"></i>
                                      </a>
                                      <a href="#!" class="btn btn-outline-danger btn-delete">
                                         <i class="fas fa-trash"></i>
                                      </a>
                                   </div>
                                   </td>
                                </tr>`;
                            $('tbody').append(tr);
                        }
                    })
                    .fail(function (e) {
                        console.log('error', e);
                        // e.responseJSON.errors contains an array of all the validation errors
                        console.log('error message', e.responseJSON.errors);
                        // Loop over the e.responseJSON.errors array and create an ul list with all the error messages
                        let msg = '<ul>';
                        $.each(e.responseJSON.errors, function (key, value) {
                            msg += `<li>${value}</li>`;
                        });
                        msg += '</ul>';
                        // Noty the errors
                        new Noty({
                            type: 'error',
                            text: msg
                        }).show();
                    });
            });

        });
       
    </script>
@endsection