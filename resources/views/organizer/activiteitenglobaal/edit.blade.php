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
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="nameedit">Naam</label>
                        <input type="text" name="name" id="nameedit"
                               class="form-control @error('first_name') is-invalid @enderror"
                               placeholder="Naam"
                               minlength="3"
                               required
                               value="">
                        {{--@error('first_name')--}}
                        {{--<div class="invalid-feedback">{{ $message }}</div>--}}
                        {{--@enderror--}}

                        <br>
                        <label for="descriptionedit">Beschrijving</label>
                        <input type="text" name="description" id="descriptionedit"
                               class="form-control @error('last_name') is-invalid @enderror"
                               placeholder="Beschrijving"
                               minlength="3"
                               required
                               value="">
                        {{--@error('Last_name')--}}
                        {{--<div class="invalid-feedback">{{ $message }}</div>--}}
                        {{--@enderror--}}

                        <br>

                        <input type="radio" id="kort" name="sort" value="Korte activiteit"> <label for="">Korte activiteit</label>
                        <br>
                        <input type="radio" id="lang" name="sort" value="Lange activiteit"> <label for="">Lange activiteit</label>
                        <br>
                        <input type="radio" id="avond" name="sort" value="Avond activiteit"> <label for="">Avond activiteit</label>
                        <br>

                        <label for="minpersonenedit">Min. personen</label>
                        <input type="number" name="minpersonen" id="minpersonenedit"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Min. aantal personen"


                               value="">

                        <label for="maxpersonenedit">Max. personen</label>
                        <input type="number" name="maxpersonen" id="maxpersonenedit"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Max. aantal personen"

                               value="">

                        <br>
                        <select name="location" id="locationedit"
                                class="custom-select @error('genre_id') is-invalid @enderror"
                                required>
                            <option value="">Locatie</option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}"
                                >{{$location->street}} {{$location->postalcode}} {{$location->town}}</option>
                            @endforeach
                        </select>
                        <br>
                        <br>
                        <input type="hidden" name="actief" value="0" />
                        <input type="checkbox" id="actiefedit" name="actief" value=1> Actief


                        <div class="invalid-feedback"></div>
                    </div>
                    <button style="display: inline" type="submit" class="btn maaknieuw btn-success">Aanpassen</button>
                </form>
            </div>
        </div>
    </div>
</div>



