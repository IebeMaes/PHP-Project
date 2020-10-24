<div class="modal" id="modal-aanpassen">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h5 id="titeledit" class="modal-title">organisator aanpassen</h5>

                <button style="display: inline;" type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="aanpasform" action="" method="post">
                    @method('put')
                    @csrf
                    <div class="form-group">
                        <label for="first_name">Voornaam</label>
                        <input type="text" name="first_name" id="first_nameedit"
                               class="form-control @error('first_name') is-invalid @enderror"
                               placeholder="Voornaam"
                               minlength="3"
                               required


                               value="">


                        @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <br>
                        <label for="last_name">Achternaam</label>
                        <input type="text" name="last_name" id="last_nameedit"
                               class="form-control @error('last_name') is-invalid @enderror"
                               placeholder="Achternaam"
                               minlength="3"
                               required


                               value="">


                        @error('Last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <br>
                        <label for="email">email</label>
                        <input type="text" name="email" id="emailedit"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="email"
                               minlength="8"
                               required

                               value="">


                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror



                        {{--type hidden voor de waarde in te stellen als checkbox unchecked is--}}
                        <br>
                        <input type="hidden" name="headorganizer" value="0" />
                        <input type="checkbox" id="headorganizer" name="headorganizer" value="1"> Hoofdorganisator
                        <br>
                        <br>
                        <input type="hidden" name="active" value="0" />
                        <input type="checkbox" id="active" name="active" value=1> Actief

                        <div class="invalid-feedback"></div>
                    </div>
                    <button data-toggle="tooltip" data-title="Met deze knop past u de organisator aan met de veranderde gegevens." style="display: inline" type="submit" class="btn maaknieuw btn-success">Aanpassen</button>
                </form>
            </div>
        </div>
    </div>
</div>



