@extends('layouts.template')

@section('title', 'Mailtemplates')

@section('main')
    <h1>Mailtemplates</h1>
    {{--@include('shared.alert')--}}
    <p>
        <a href="#!" class="btn btn-outline-success btn-add">
            <i class="fas fa-plus-circle mr-1"></i>Create new mailtemplate
        </a>
    </p>
    <div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th class="d-none">#</th>
                <th>Onderwerp</th>
                <th>Acties</th>
            </tr>
            </thead>
            <tbody>
            @foreach($mailtemplates as $mailtemplate)
                <tr id="rowid{{$mailtemplate->id}}">
                    <td class="d-none">{{ $mailtemplate->id }}</td>
                    <td id="rowname{{$mailtemplate->id}}">{{ $mailtemplate->name }}</td>
                    <td id="rowcontent{{$mailtemplate->id}}" class="d-none">{{$mailtemplate->mailcontent}}</td>
                    <td data-id="{{$mailtemplate->id}}">
                        <div class="btn-group btn-group-sm">
                            <a href="#!" class="btn btn-outline-success btn-edit"
                               title="Bewerk {{$mailtemplate->name}}" data-toggle="tooltip">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="#!" class="btn btn-outline-danger btn-delete"
                               title="Verwijder {{$mailtemplate->name}}" data-toggle="tooltip">
                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    @include('organizer.mailtemplates.modal')
@endsection

@section('script_after')
    <script>
        $(function () {
            let id = null;
            let exists = false;
            $('tbody').on('click', '.btn-delete', function () {
                // Get data attributes from td tag
                let id = $(this).closest('td').data('id');
                let name = $('#rowname' + id).text();
                console.log(name);
                // Set some values for Noty
                let text = `<p>Ben je zeker dat je <b>` + name + `</b> wilt verwijderen?</p>`;
                let type = 'warning';
                let btnText = 'Delete ' + name;
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
                            deleteMailtemplate(id);
                            modal.close();
                        }),
                        Noty.button('Cancel', 'btn btn-secondary ml-2', function () {
                            modal.close();
                        })
                    ]
                }).show();

            });

            $('tbody').on('click', '.btn-edit', function () {
                exists = true;
                // Get data attributes from td tag
                id = $(this).closest('td').data('id');
                let name = $('#rowname' + id).text();
                let content = $('#rowcontent' + id).text();
                // Update the modal
                $('.modal-title').text(`Edit ${name}`);
                $('form').attr('action', `/organizer/mailtemplates/${id}`);
                $('#name').val(name);
                $('#mailcontent').val(content);
                $('input[name="_method"]').val('put');
                // Show the modal
                $('#modal-mailtemplate').modal('show');
            });
            // $('.btn-edit').click(function () {
            //     exists = true;
            //     // Get data attributes from td tag
            //     id = $(this).closest('td').data('id');
            //     let name = $('#rowname' + id).text();
            //     let content = $('#rowcontent' + id).text();
            //     // Update the modal
            //     $('.modal-title').text(`Edit ${name}`);
            //     $('form').attr('action', `/Headorganizer/Mailtemplates/${id}`);
            //     $('#name').val(name);
            //     $('#mailcontent').val(content);
            //     $('input[name="_method"]').val('put');
            //     // Show the modal
            //     $('#modal-mailtemplate').modal('show');
            // });

            $('.btn-add').click(function () {
                exists = false;
                // Update the modal
                $('.modal-title').text(`Add mailtemplate`);
                $('form').attr('action', `/organizer/mailtemplates`);
                $('#name').val("");
                $('#mailcontent').val("");
                $('input[name="_method"]').val('post');
                // Show the modal
                $('#modal-mailtemplate').modal('show');
            });

            $('#modal-mailtemplate form').submit(function (e) {
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
                        $('#modal-mailtemplate').modal('hide');
                        if(exists){
                            // Rework the table
                            $('#rowname' + id).text($('#name').val());
                            $('#rowcontent' + id).text($('#mailcontent').val());
                        }
                        else{
                            id = data.object.id;
                            // Rework the table
                            let tr =
                                `<tr id="rowid` + id + `">
                                   <td class="d-none">` + id + `</td>
                                   <td id="rowname` + id + `">` + data.object.name +`</td>
                                   <td id="rowcontent` + id + `" class="d-none">`+ data.object.mailcontent + `</td>
                                   <td data-id="` + id + `">
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

        function deleteMailtemplate(id) {
            // Delete the mailtemplate from the database
            console.log('id', id);
            let pars = {
                '_token': '{{ csrf_token() }}',
                '_method': 'delete'
            };

            $.post(`/organizer/mailtemplates/${id}`, pars, 'json')
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

        // $(function () {
        //     loadTable();
        // });
        //
        // // Load genres with AJAX
        // function loadTable() {
        //     $.getJSON('/Headorganizer/Mailtemplates/qryMailtemplates')
        //         .done(function (data) {
        //             console.log('data', data);
        //             // Clear tbody tag
        //             $('tbody').empty();
        //             // Loop over each item in the array
        //             $.each(data, function (key, value) {
        //                 let tr = `<tr>
        //                        <td>${value.id}</td>
        //                        <td>${value.name}</td>
        //                        <td data-id="${value.id}"
        //                            data-name="${value.name}">
        //                             <div class="btn-group btn-group-sm">
        //                                 <a href="#!" class="btn btn-outline-success btn-edit">
        //                                     <i class="fas fa-edit"></i>
        //                                 </a>
        //                                 <a href="#!" class="btn btn-outline-danger btn-delete">
        //                                     <i class="fas fa-trash"></i>
        //                                 </a>
        //                             </div>
        //                        </td>
        //                    </tr>`;
        //                 // Append row to tbody
        //                 $('tbody').append(tr);
        //             });
        //         })
        //         .fail(function (e) {
        //             console.log('error', e);
        //         })
        // }
    </script>
@endsection