@extends('layouts.template')

@section('title', 'activiteiten beheren')

@section('main')



    <h1>Activiteiten</h1>

    <p>
        <a href="#!" class="btn btn-outline-success" id="btn-create">
            <i class="fas fa-plus-circle mr-1"></i>Nieuwe activiteit aanmaken.
        </a>
    </p>



    {{ $activities->appends(request()->except('page'))->links() }}

    <div class="table-responsive" id="overzicht">
        <table class="table">
            <thead>
            <tr>

                <th>Activiteit</th>
                <th>Beschrijving</th>
                <th>Soort</th>
                <th>Min/Max personen</th>

                <th>Actief</th>
                <th>Acties</th>
            </tr>
            </thead>
            <tbody id="activiteittable">

            @foreach($activities as $activity)
                <tr>
                    <td data-name="{{$activity->name}}">{{$activity->name}}</td>
                    <td>{{$activity->description}}</td>
                    <td>{{$activity->sort}}</td>
                    <td>{{$activity->min_number}} - {{$activity->max_number}}</td>

                    @if ($activity->active==0)
                        <td></td>
                    @endif
                    @if ($activity->active==1)
                        <td><i class="fas fa-check"></i></td>
                    @endif

                    <td>
                        <div class="btn-group btn-group-sm">

                            <a href="#!" class="btn btn-outline-success btn-edit"

                               data-toggle="tooltip" data-id="{{$activity->id}}" data-name="{{$activity->name}}" data-description="{{$activity->description}}" data-sort="{{$activity->sort}}" data-min_number="{{$activity->min_number}}" data-max_number="{{$activity->max_number}}" data-location_id="{{$activity->location_id}}" data-active="{{$activity->active}}" title="{{$activity->name}} aanpassen"><i class="fas fa-edit"></i></a>


                            <a href="#!" class="btn btn-outline-danger btn-delete"
                               data-toggle="tooltip" data-id="{{$activity->id}}" data-name="{{$activity->name}}" title="{{$activity->name}} verwijderen">

                                <i class="fas fa-trash"></i>
                            </a>
                        </div>
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

    @include('organizer.activiteitenglobaal.remove')
    @include('organizer.activiteitenglobaal.add')
    @include('organizer.activiteitenglobaal.edit')
@endsection

@section("script_after")
    <script>
        $("#btn-create").on('click',function(){
            $("#modal-aanmaken").modal('show');
        });

        $(".btn-delete").on('click',function () {
            $("#verwijderactiviteit").modal('show');

            let id = $(this).data('id');
            let name = $(this).data('name');
            console.log("verwijder" + id + " + " + name);
            $('#verwijderform').attr('action', `/organizer/activiteitenglobaal/${id}`);



        });

        $(".btn-edit").on('click',function(){
            // Get data attributes from td tag
            let id = $(this).data('id');
            let name = $(this).data('name');
            let description = $(this).data('description');
            let min_number=$(this).data('min_number');
            let max_number=$(this).data('max_number');
            let location_id=$(this).data('location_id');
            let active=$(this).data('active');
            let sort=$(this).data('sort');
            console.log( id);

            //script voor default checkboxes gebaseerd op waardes
            if(active==1){
                $('#actiefedit').prop('checked', true);
            }else{
                $('#actiefedit').prop('checked', false);
            }

            if(sort=="Korte activiteit"){
                $("#kort").prop('checked',true);
            }else if(sort=="Lange activiteit"){
                $("#lang").prop('checked',true);
            }else{
                $("#avond").prop('checked',true);
            }

            // Update the modal

            $('.modal-title').text(`${name} aanpassen`);
            $('#aanpasform').attr('action', `/organizer/activiteitenglobaal/${id}`);

            $('#nameedit').val(name);
            $('#descriptionedit').val(description);
            $("#minpersonenedit").val(min_number);
            $("#maxpersonenedit").val(max_number);
            $("#locationedit").val(location_id);

            $('input[name="_method"]').val('put');
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