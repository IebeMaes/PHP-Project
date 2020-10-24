@csrf
<div class="form-group">
    <label for="name">Naam</label>
    <input type="text" name="name" id="name"
           class="form-control @error('name') is-invalid @enderror"
           placeholder="auto"
           required
           value="{{ old('name', $transportoption->name) }}">
    @error('name')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <label for="description">Beschijving</label>
    <input type="text" name="description" id="description"
           class="form-control @error('description') is-invalid @enderror"
           placeholder="eigen vervoer"
           minlength="3"
           value="{{ old('description', $transportoption->description) }}">
    @error('description')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" value="1"
               @if (old('_token'))
               @if (old('active')) checked @endif
               @else
               @if ($transportoption->active) checked @endif
               @endif
               id="active" name="active">
        <label class="form-check-label" for="active">
            actief
        </label>
    </div>

</div>
<button type="submit" class="btn btn-success">Vervoersmogelijkheid opslaan</button>
