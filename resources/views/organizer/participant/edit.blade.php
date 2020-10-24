<div class="modal" id="modal-deelnemer-bewerken">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Deelnemer bewerken</h5>
                <button style="display: inline;" type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="bewerkformDeelnemer" action="" method="post">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="editvoornaam">Voornaam: </label>
                                    <input type="text" name="editvoornaam" id="editvoornaam"
                                           class="form-control @error('editvoornaam') is-invalid @enderror" required>
                                    @error('editvoornaam')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="editachternaam">Achternaam: </label>
                                    <input type="text" name="editachternaam" id="editachternaam"
                                           class="form-control @error('editachternaam') is-invalid @enderror" required>
                                    @error('editachternaam')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="edittelefoonnummer" class="mr-2">Telefoonnummer: </label>
                            <input type="number" name="edittelefoonnummer" id="edittelefoonnummer"
                                   class="form-control @error('edittelefoonnummer') is-invalid @enderror" required>
                            @error('edittelefoonnummer')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="editemail" class="mr-2">Email: </label>
                            <input type="text" name="editemail" id="editemail"
                                   class="form-control @error('editemail') is-invalid @enderror" required>
                            @error('editemail')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="editunummer" class="mr-2">U-nummer: </label>
                            <input type="text" name="editunummer" id="editunummer"
                                   class="form-control @error('editunummer') is-invalid @enderror" required>
                            @error('editunummer')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <button style="display: inline" type="submit" class="btn btn-success"
                            id="editlocation">Opslaan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
