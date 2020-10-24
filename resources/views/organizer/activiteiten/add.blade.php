<div class="modal" id="modal-aanmaken">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Activiteit toevoegen voor het personeelsfeest</h5>
                <button style="display: inline;" type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="aanmaakform" action="/organizer/activiteiten2" method="post">

                    @method('')
                    @csrf
                    <div class="form-group">


                        <label for="activity">Gelinkte activiteit</label>
                        <select name="activity" id="activity"
                                class="custom-select @error('genre_id') is-invalid @enderror"
                                required>

                            @foreach($activiteiten as $activiteit)
                                @if($activiteit->active==1)
                                    <option class="{{$activiteit->description}}" value="{{ $activiteit->id }}"
                                    >{{$activiteit->name}}</option>
                                @endif
                            @endforeach
                        </select>



                        <div class="invalid-feedback"></div>
                    </div>
                    <button style="display: inline" value="" name="toevoegen" id="toevoegen" type="submit" class="btn maaknieuw btn-success">toevoegen</button>
                </form>
            </div>
        </div>
    </div>
</div>



