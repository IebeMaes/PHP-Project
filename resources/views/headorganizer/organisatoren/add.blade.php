<div class="modal" id="modal-aanmaken">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Organisator aanmaken</h5>
                <button style="display: inline;" type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="aanmaakform" action="/headorganizer/users" method="post">

                    @method('')
                    @csrf
                    <div class="form-group">
                        <label for="first_name">Voornaam</label>
                        <input type="text" name="first_name" id="first_name"
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
                        <input type="text" name="last_name" id="last_name"
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
                        <input type="text" name="email" id="email"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="email"
                               minlength="8"
                               required
                               value="">
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <br>
                        <label for="wachtwoord">Wachtwoord</label>
                        <input type="password" name="wachtwoord" id="wachtwoord"
                               class="form-control @error('wachtwoord') is-invalid @enderror"
                               placeholder="Wachtwoord"
                               minlength="8"
                               required
                               value="">
                        @error('wachtwoord')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{--type hidden voor de waarde in te stellen als checkbox unchecked is--}}
                        <br>
                        <input type="hidden" name="hoofdorganisator" value="0" />

                        <input type="checkbox" id="hoofdorganisator" name="hoofdorganisator" value=1> Hoofdorganisator

                        <br>
                        <br>
                        <input type="hidden" name="actief" value="0" />
                        <input type="checkbox" id="actief" name="actief" value=1> Actief

                        <div class="invalid-feedback"></div>
                    </div>
                    <button data-toggle="tooltip" data-title="Met deze knop maakt u een nieuwe organisator aan met de ingevulde gegevens." style="display: inline" type="submit" class="btn maaknieuw btn-success">Maak organisator</button>
                </form>
            </div>
        </div>
    </div>
</div>



