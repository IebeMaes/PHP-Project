<div class="modal" id="modal-aanpassen">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title">Activiteit aanpassen</h5>

                <button style="display: inline;" type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="aanpasform" action="" method="post">
                    <div class="form-group">
                    @method('put')
                    @csrf


                    <br>


                        <br>
                    <label for="activityedit">Gelinkte activiteit</label>
                    <select name="activityedit" id="activityedit"
                            class="custom-select @error('genre_id') is-invalid @enderror"
                            required>

                        @foreach($activiteiten as $activiteit )
                            @if($activiteit->active==1)
                                <option class="{{$activiteit->sort}}" value="{{ $activiteit->id }}"
                                >{{$activiteit->name}}</option>
                                @endif

                        @endforeach
                    </select>
                        <br>



                        <div class="invalid-feedback"></div>
                    </div>
                    <button style="display: inline" type="submit" class="btn maaknieuw btn-success">Aanpassen</button>
                </form>
            </div>
        </div>
    </div>
</div>



