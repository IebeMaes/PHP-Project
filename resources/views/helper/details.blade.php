<div class="modal" id="modal-details">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title">Inschrijvingen</h5>

                <button style="display: inline;" type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="aanpasform" action="#!" method="">
                    <div class="form-group">





                        <div class="row" id="inschrijvingenlijst">
                            <style>
                                .vet{
                                    font-weight: bold;
                                }
                            </style>

                            <div class="col col-lg-6">

                                @foreach ($tasks as $task)
                                    <p class="vet">{{$task->name}}</p>
                                    <ul>
                                        @foreach($inschrijvingen as $inschrijving)
                                            @if($task->id==$inschrijving->task_id)
                                                <li>{{$inschrijving->first_name}} {{$inschrijving->last_name}}</li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @endforeach

                            </div>

                            <div class="col col-lg-6">
                                <a href="#!" class="btn btn-outline-success" id="btn-print" onclick="printoverzicht('inschrijvingenlijst')">
                                    <i class="fas fa-print mr-1"></i>Overzicht afprinten
                                </a>

                            </div>
                        </div>







                    </div>

                </form>
            </div>
        </div>
    </div>
</div>