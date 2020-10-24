<div class="modal" id="modal-deelnemer-toevoegen">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deelnemer toevoegen</h5>
                <button style="display: inline;" type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="aanmaakformdeelnemer" action="/organizer/deelnemers" method="post">
                    @method('')
                    @csrf
                    <div class="form-group">
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="voornaam">Voornaam: </label>
                                    <input type="text" name="voornaam" id="voornaam"
                                           class="form-control @error('voornaam') is-invalid @enderror" required>
                                    @error('voornaam')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="achternaam">Achternaam: </label>
                                    <input type="text" name="achternaam" id="achternaam"
                                           class="form-control @error('achternaam') is-invalid @enderror" required>
                                    @error('achternaam')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="telefoonnummer" class="mr-2">Telefoonnummer: </label>
                            <input type="number" name="telefoonnummer" id="telefoonnummer"
                                   class="form-control @error('telefoonnummer') is-invalid @enderror" required>
                            @error('telefoonnummer')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="email" class="mr-2">Email: </label>
                            <input type="text" name="email" id="email"
                                   class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="unummer" class="mr-2">U-nummer: </label>
                            <input type="text" name="unummer" id="unummer"
                                   class="form-control @error('unummer') is-invalid @enderror" required>
                            @error('unummer')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <button style="display: inline" type="submit" class="btn btn-success"
                            id="newdeelnemer">Voeg deelnemer toe
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
