<div class="modal" id="modal-toevoegen">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titeldaypart"></h5>
                <button style="display: inline;" type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="aanmaakform" action="" method="post">
                    @method('')
                    @csrf
                    <div class="form-group">
                        <div class="form-group ">
                            <label for="start_hourS">Begintijd: </label>
                            <input type="time" name="start_hourS"  id="start_hourS" class="form-control @error('start_hourS') is-invalid @enderror" required>
                            @error('start_hourS')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="end_hourS" class="mr-2">Eindtijd: </label>
                            <input type="time" name="end_hourS"  id="end_hourS" class="form-control @error('end_hourS') is-invalid @enderror" required>
                            @error('end_hourS')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="form-group" hidden >
                            <label for="description"></label>
                            <input type="text" name="description"  id="description">
                        </div>


                    </div>
                    <button style="display: inline" type="submit" class="btn maaknieuw btn-success" data-descriptionb=""
                            id="newdaypart">Voeg dagdeel toe</button>
                </form>
            </div>
        </div>
    </div>
</div>
