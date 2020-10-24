@extends('layouts.template')

@section('title', 'activiteiten beheren')

@section('main')



    <h1>Activiteiten</h1>




    {{ $activities->appends(request()->except('page'))->links() }}



    <div class="table-responsive" id="overzicht">
        <table class="table">
            <thead>
            <tr>

                <th>Dagdeel</th>
                <th>Activiteit</th>
                <th>Beschrijving</th>
                <th>Min/Max personen</th>
                <th>Locatie</th>
                {{--<th>Actief</th>--}}
                <th>Actie(s)</th>
            </tr>
            </thead>
            <tbody id="activiteittable">

            @foreach($activities as $activity)
                <tr>
                    <td style="display: none">{{$activity->linkid}}</td>
                    <td>{{$activity->start_hour}} / {{$activity->end_hour}}</td>
                    <td>{{$activity->activityname}}</td>
                    <td>{{$activity->activitydescription}}</td>

                    <td>{{$activity->min_number}} - {{$activity->max_number}}</td>
                    <td>{{$activity->street}} {{$activity->postalcode}} {{$activity->town}}</td>
                    {{--@if ($activity->active==0)--}}
                        {{--<td></td>--}}
                    {{--@endif--}}
                    {{--@if ($activity->active==1)--}}
                        {{--<td><i class="fas fa-check"></i></td>--}}
                    {{--@endif--}}

                    <td>
                        <div class="btn-group btn-group-sm">

                            <a href="#!" class="btn btn-outline-success btn-edit"

                               data-toggle="tooltip" data-linkid="{{$activity->linkid}}" data-sort="{{$activity->sort}}" data-description="{{$activity->description}}" data-end_hour="{{$activity->end_hour}}" data-start_hour="{{$activity->start_hour}}" data-daypartid="{{$activity->daypartid}}" data-name="{{$activity->name}}" title="Dit dagdeel aanpassen"><i class="fas fa-edit"></i></a>


                            {{--<a href="#!" class="btn btn-outline-danger btn-delete"--}}
                               {{--data-toggle="tooltip" data-daypartid="{{$activity->daypartid}}" data-name="{{$activity->name}}" title="Dit dagdeel verwijderen">--}}

                                {{--<i class="fas fa-trash"></i>--}}
                            {{--</a>--}}
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

@include('organizer.activiteiten.remove')
@include('organizer.activiteiten.add')
    @include('organizer.activiteiten.edit')
@endsection

@section("script_after")
    <script>
        $("#btn-create").on('click',function(){
            $("#modal-aanmaken").modal('show');

            let sort=$(this).data('sort');
            console.log(sort);

            if(sort=="Korte activiteit"){
                $(".Lange").css('display','none');
                $(".Avond").css('display','none');
                $(".Korte").css('display','inline');
            }else if(sort=="Lange activiteit"){
                $(".Korte").css('display','none');
                $(".Avond").css('display','none');
                $(".Lange").css('display','inline');
            }else{
                $(".Korte").css('display','none');
                $(".Lange").css('display','none');
                $(".Avond").css('display','inline');
            }
        });

        $(".btn-delete").on('click',function () {
            $("#verwijderactiviteit").modal('show');

            let daypartid = $(this).data('daypartid');
            let name = $(this).data('name');
            let feest={{$personeelsfeestid}}
            console.log("verwijder" + daypartid + " + " + name);
            $('#verwijderform').attr('action', `/organizer/activiteiten2/${daypartid}`);



        });

        $(".btn-edit").on('click',function(){
            // Get data attributes from td tag
            let daypartid = $(this).data('daypartid');
            let linkid=$(this).data('linkid');
            let start_hour = $(this).data('start_hour');
            let end_hour = $(this).data('end_hour');
            let description=$(this).data('description');
            let sort=$(this).data('sort');
            console.log(sort);

            if(sort=="Korte activiteit"){
                $(".Lange").css('display','none');
                $(".Avond").css('display','none');
                $(".Korte").css('display','inline');
            }else if(sort=="Lange activiteit"){
                $(".Korte").css('display','none');
                $(".Avond").css('display','none');
                $(".Lange").css('display','inline');
            }else{
                $(".Korte").css('display','none');
                $(".Lange").css('display','none');
                $(".Avond").css('display','inline');
            }

            let gelinkteactivity=$(this).data('gelinkteactivity');

            console.log(linkid);
            // Update the modal

            $('.modal-title').text(`activiteit aanpassen`);
            if(linkid==""){
                $('form').attr('action', `/organizer/activiteiten2`);

                // $('#beginedit').val(start_hour);
                // $('#eindedit').val(`${end_hour}`);
                $("#activityedit").val(`${gelinkteactivity}`);
                $("#toevoegen").val(`${daypartid}`);
                //$('input[name="_method"]').val('put');
                // Show the modal

                $("#modal-aanmaken").modal('show');
            }else{
                $('form').attr('action', `/organizer/activiteiten2/${linkid}`);

                // $('#beginedit').val(start_hour);
                // $('#eindedit').val(`${end_hour}`);
                $("#activityedit").val(`${gelinkteactivity}`);

                $('input[name="_method"]').val('put');
                // Show the modal

                $("#modal-aanpassen").modal('show');
            }

            // $('form').attr('action', `/organizer/activiteiten2/${linkid}`);
            //
            // $('#beginedit').val(start_hour);
            // $('#eindedit').val(`${end_hour}`);
            // $("#activityedit").val(`${gelinkteactivity}`);
            //
            // $('input[name="_method"]').val('put');
            // Show the modal
            //
            // $("#modal-aanpassen").modal('show');
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