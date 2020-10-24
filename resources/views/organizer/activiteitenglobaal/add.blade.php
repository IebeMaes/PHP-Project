<div class="modal" id="modal-aanmaken">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Activiteit aanmaken</h5>
                <button style="display: inline;" type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="aanmaakform" action="/organizer/activiteitenglobaal" method="post">

                    @method('')
                    @csrf
                    <div class="form-group">
                        <label for="name">Naam</label>
                        <input type="text" name="name" id="name"
                               class="form-control @error('first_name') is-invalid @enderror"
                               placeholder="Naam"
                               minlength="3"
                               required
                               value="">
                        {{--@error('first_name')--}}
                        {{--<div class="invalid-feedback">{{ $message }}</div>--}}
                        {{--@enderror--}}

                        <br>
                        <label for="last_name">Beschrijving</label>
                        <input type="text" name="description" id="description"
                               class="form-control @error('last_name') is-invalid @enderror"
                               placeholder="Beschrijving"
                               minlength="3"
                               required
                               value="">
                        {{--@error('Last_name')--}}
                        {{--<div class="invalid-feedback">{{ $message }}</div>--}}
                        {{--@enderror--}}

                        <br>

                        <input type="radio" name="sort" value="Korte Activiteit"> <label for="">Korte activiteit</label>
                        <br>
                        <input type="radio" name="sort" value="Lange Activiteit"> <label for="">Lange activiteit</label>
                        <br>
                        <input type="radio" name="sort" value="Avond Activiteit"> <label for="">Avond activiteit</label>
                        <br>

                        <label for="minpersonen">Min. personen</label>
                        <input type="number" name="minpersonen" id="minpersonen"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Min. aantal personen"


                               value="">

                        <label for="maxpersonen">Max. personen</label>
                        <input type="number" name="maxpersonen" id="maxpersonen"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Max. aantal personen"

                               value="">

                        <br>
                        <select name="location" id="location"
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
                        <input type="checkbox" id="actief" name="actief" value=1> Actief

                        <div class="invalid-feedback"></div>
                    </div>
                    <button style="display: inline" type="submit" class="btn maaknieuw btn-success">Maak activiteit</button>
                </form>
            </div>
        </div>
    </div>
</div>



