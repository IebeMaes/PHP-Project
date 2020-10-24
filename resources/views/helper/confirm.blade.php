<div class="modal" id="modal-bevestigen">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title">Bevestig uw inschrijving.</h5>

                <button style="display: inline;" type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="aanpasform" action="/inschrijvenhelper" method="post">
                    <div class="form-group">

                        @csrf
                        <label for="mail">E-mailadres</label>
                        <input class="form-control" required type="text" value="" name="mailconfirm" id="mailconfirm">
                        <br>
                        {{--<label for="mail">Wachtwoord</label>--}}
                        {{--<input class="form-control" required type="password" value="" name="wachtwoordconfirm" id="wachtwoordconfirm">--}}

                        <div class="row">
                            <style>
                                .vet{
                                    font-weight: bold;
                                }
                            </style>
                            <div class="col col-lg-6">
                                <p class="vet">taak</p>
                                <p id="taak"></p>
                                <br>
                                <p class="vet">Beschrijving</p>
                                <p id="beschrijving"></p>
                            </div>
                            <div class="col col-lg-6">
                                <p class="vet">Start-Einduur</p>
                                <p id="starteind"></p>
                                <br>
                                <p class="vet">Commentaar</p>
                                <p id="commentaar"></p>
                            </div>
                        </div>

                        <label class="vet" for="transport">Vervoersoptie</label>
                        <select name="transport" id="transport"
                                class="custom-select @error('genre_id') is-invalid @enderror"
                                required>

                            @foreach($transports as $transport)

                                    <option value="{{ $transport->id }}"
                                    >{{$transport->name}}</option>

                            @endforeach

                        </select>
                        <br>

                        <input class="form-control" style="display: none;" type="text" value="" name="activity_id" id="activity_id">

                        <div class="invalid-feedback"></div>
                    </div>
                    <button style="display: inline" type="submit" name="bevestigen" id="bevestigen" class="btn maaknieuw btn-success">Bevestigen</button>
                </form>
            </div>
        </div>
    </div>
</div>