<div class="modal" id="modal-aanpassen">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">personeelslid aanpassen</h5>
                <button style="display: inline;" type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="aanpasform" action="/users" method="post">
                    @method('put')
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


                        <br>
                        <label for="email">U-nummer</label>
                        <input type="text" name="unummer" id="unummer"
                               class="form-control"
                               placeholder="U-nummer"
                               minlength="8"
                               required
                               value="">

                        <br>
                        <label for="email">Tel. nummer</label>
                        <input type="text" name="telnummer" id="telnummer"
                               class="form-control"
                               placeholder="telnummer"
                               minlength="8"
                               required
                               value="">
                        <br>



                    <button style="display: inline" type="submit" class="btn maaknieuw btn-success">Aanpassen</button>
                </form>
            </div>
        </div>
    </div>
</div>



