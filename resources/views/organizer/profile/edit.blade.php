<div class="modal" id="modal-profiel-bewerken">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Profiel bewerken</h5>
                <button style="display: inline;" type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="bewerkprofielform" action="" method="post">
                    @method('')
                    @csrf
                    <div class="form-group">
                        <div class="form-group ">
                            <label for="naamprof">Naam: </label>
                            <input type="text" name="naamprof" value="{{old('naamprof', auth()->user()->first_name) . ' ' . auth()->user()->last_name}}"  id="naamprof" class="form-control @error('naamprof') is-invalid @enderror" required >
                            @error('naamprof')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="form-group ">
                            <label for="emailprof" class="mr-2">Email: </label>
                            <input type="text" name="emailprof" value="{{old('naamprof', auth()->user()->email)}}" id="emailprof" class="form-control @error('emailprof') is-invalid @enderror" required>
                            @error('emailprof')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <button style="display: inline" type="submit" class="btn maaknieuw btn-success"
                            id="editprofiel">Opslaan</button>
                </form>
            </div>
        </div>
    </div>
</div>
