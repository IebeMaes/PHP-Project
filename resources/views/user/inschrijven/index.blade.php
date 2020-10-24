@extends('layouts.template')

@section('title', 'inschrijven personeelsfeest')

@section('main')
    <div class="container">
        <div class="row justify-content-lg-center">
        <h1>Gelieve uw e-mail adres in te vullen.</h1>

            <div class="col-lg-6 pt-5">
                <form action="inschrijving/namiddag" method="post" >
                    @csrf
                    <div class="form-group text-center">
                        <label for="emailinschrijving">E-mail adres</label>
                        <input type="text" name="emailinschrijving" id="emailinschrijving"
                               class="form-control @error('emailinschrijving') is-invalid @enderror"
                               required>
                        @error('emailinschrijving')
                        <div class="invalid-feedback">{{$message}}</div>
                        @enderror

                    <button type="submit" class="btn btn-success mt-3">Doorgaan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>





@endsection

@section("script_after")
    <script>

        //Overzicht afprinten
        function OverzichtPrinten() {
            window.print();
        }



    </script>
@endsection
