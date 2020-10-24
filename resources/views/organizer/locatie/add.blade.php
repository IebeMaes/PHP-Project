<div class="modal" id="modal-locatie-toevoegen">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Locatie toevoegen</h5>
                <button style="display: inline;" type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="aanmaakform" action="/organizer/locations" method="post">
                    @method('')
                    @csrf
                    <div class="form-group">
                        <div class="form-group ">
                            <label for="name">Naam: </label>
                            <input type="text" name="name" id="name"
                                   class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="town">Gemeente: </label>
                                    <input type="text" name="town" id="town"
                                           class="form-control @error('town') is-invalid @enderror" required>
                                    @error('town')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="postalcode" class="mr-2">Postcode: </label>
                                    <input type="text" name="postalcode" id="postalcode"
                                           class="form-control @error('postalcode') is-invalid @enderror" required>
                                    @error('postalcode')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="street" class="mr-2">Straat + huisnummer: </label>
                            <input type="text" name="street" id="street"
                                   class="form-control @error('street') is-invalid @enderror" required>
                            @error('street')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <button style="display: inline" type="submit" class="btn btn-success"
                            id="newlocation">Voeg locatie toe
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
