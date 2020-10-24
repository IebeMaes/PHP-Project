@csrf
<div class="form-group">
    <label for="first_name">Voornaam</label>
    <input type="text" name="first_name" id="first_name"
           class="form-control @error('first_name') is-invalid @enderror"
           placeholder="Voornaam"
           minlength="3"
           required
           value="{{ old('first_name', $participant->first_name) }}">
    @error('first_name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <label for="last_name">Achternaam</label>
    <input type="text" name="last_name" id="last_name"
           class="form-control @error('last_name') is-invalid @enderror"
           placeholder="Achternaam"
           minlength="3"
           required
           value="{{ old('last_name', $participant->last_name) }}">
    @error('last_name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <label for="cellphone">Telefoon</label>
    <input type="text" name="cellphone" id="cellphone"
           class="form-control @error('cellphone') is-invalid @enderror"
           placeholder="04........"
           minlength="3"
           required
           value="{{ old('cellphone', $participant->cellphone) }}">
    @error('cellphone')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <label for="email">E-mail</label>
    <input type="email" name="email" id="email"
           class="form-control @error('email') is-invalid @enderror"
           placeholder="test@mail.com"
           minlength="3"
           required
           value="{{ old('email', $participant->email) }}">
    @error('email')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <label for="unumber">U-nummer</label>
    <input type="text" name="unumber" id="unumber"
           class="form-control @error('unumber') is-invalid @enderror"
           placeholder="u..."

           value="{{ old('unumber', $participant->unumber) }}">
    @error('unumber')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<button type="submit" class="btn btn-success">Helper opslaan</button>