<div class="modal" id="modal-locatie-bewerken">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Locatie bewerken</h5>
                <button style="display: inline;" type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="bewerkform" action="" method="post">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <div class="form-group ">
                            <label for="editnamelocation">Naam: </label>
                            <input type="text" name="editnamelocation" id="editnamelocation"
                                   class="form-control @error('editnamelocation') is-invalid @enderror"
                                   required value="">
                            @error('editnamelocation')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="edittownlocation">Gemeente: </label>
                                    <input type="text" name="edittownlocation" id="edittownlocation"
                                           class="form-control @error('edittownlocation') is-invalid @enderror"
                                           required value="">
                                    @error('edittownlocation')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>

                                <div class="col-md-4">
                                    <label for="editpostalcodelocation" class="mr-2">Postcode: </label>
                                    <input type="text" name="editpostalcodelocation" id="editpostalcodelocation"
                                           class="form-control @error('editpostalcodelocation') is-invalid @enderror"
                                           required value="">
                                    @error('editpostalcodelocation')
                                    <div class="invalid-feedback">{{$message}}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <label for="editstreetlocation" class="mr-2">Straat + huisnummer: </label>
                            <input type="text" name="editstreetlocation" id="editstreetlocation"
                                   class="form-control @error('editstreetlocation') is-invalid @enderror"
                                   required value="">
                            @error('editstreetlocation')
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
