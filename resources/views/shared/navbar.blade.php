<nav class="navbar navbar-expand-md w-100" style="background-color: #EB4A2D">
    <a href="/">
        <img style="width:150px;height:100px" src="/assets/logo.png" alt="Logo van Thomas More">
    </a>

    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="collapsNav">
            <ul class="navbar-nav ml-auto">
                @guest
                    <li class="nav-item">
                        <a class="nav-link text-white font-weight-bold text-decoration-none" id="navbutton" href="/login"><i class="fas fa-sign-in-alt m-1"></i>Aanmelden</a>
                    </li>

                @endguest
                @auth
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white font-weight-bold text-decoration-none" id="navbutton" href="#!" data-toggle="dropdown">
                            {{ auth()->user()->first_name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="/organizer/staffparties"><i class="fas fa-glass-cheers m-1"></i>Personeelsfeesten</a>
                            <a class="dropdown-item" href="/organizer/activiteitenglobaal"><i class="fas fa-table-tennis m-1"></i>Activiteiten beheren</a>


                            <a class="dropdown-item" href="/organizer/mailtemplates"><i class="fas fa-envelope m-1"></i>Mail beheren</a>

                            <a class="dropdown-item" href="/organizer/locations"><i class="fas fa-map-marker-alt m-1"></i>Locaties beheren</a>
                            <a class="dropdown-item" href="/organizer/vervoersmogelijkheid"><i class="fas fa-car m-1"></i>Vervoer beheren</a>

                            <a class="dropdown-item" href="/organizer/helpers"><i class="fas fa-user-check m-1"></i>Helpers beheren</a>


                            <a class="dropdown-item" href="/organizer/password"><i class="fas fa-key m-1"></i>Wachtwoord wijzigen</a>
                            @if(auth()->user()->head_organizer)
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/headorganizer/users"><i class="fas fa-user-alt m-1"></i>Organisatoren beheren</a>
                                <a class="dropdown-item" href="/organizer/deelnemers"><i class="fas fa-user-alt m-1"></i>Deelnemers beheren</a>



                            @endif
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/organizer/profile/me"><i class="fas fa-user-edit m-1"></i>Gebruikersaccount</a>
                            <a class="dropdown-item" href="/logout"><i class="fas fa-sign-out-alt m-1"></i>Afmelden</a>
                        </div>
                    </li>
                @endauth
            </ul>
        </div>
    </div>

    {{--@guest--}}
    {{--<a style="right:5px; top:40px;position: absolute;text-decoration: none ;color:white;font-weight: bold; ;font-size: 18px" href="/login">Inloggen als organisator</a>--}}
    {{--@endguest--}}

    {{--@auth--}}
        {{--<div class="btn-group dropleft" style="right:5px; top:40px;position: absolute;text-decoration: none ;color:white;font-weight: bold; ;font-size: 18px" >--}}
            {{--<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                {{--{{ auth()->user()->first_name }}--}}
            {{--</button>--}}
            {{--<div class="dropdown-menu">--}}
                {{--<i class="fas fa-table-tennis"></i><a class="dropdown-item" href="#">Activiteiten beheren</a>--}}
                {{--<i class="fas fa-tasks"></i><a class="dropdown-item" href="#">Taken beheren</a>--}}
                {{--<i class="fas fa-map-marker-alt"></i><a class="dropdown-item" href="#">Locaties beheren</a>--}}
                {{--<i class="fas fa-car"></i><a class="dropdown-item" href="#">Vervoer beheren</a>--}}
                {{--<i class="fas fa-user-check"></i><a class="dropdown-item" href="#">Personeelsleden uitnodigen</a>--}}
                {{--<div class="dropdown-divider"></div>--}}
                {{--<i class="fas fa-sign-out-alt"></i><a class="dropdown-item" href="#">Uitloggen</a>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--@if(auth()->user()->head_organiser)--}}
            {{--<div class="btn-group dropleft" style="right:5px; top:40px;position: absolute;text-decoration: none ;color:white;font-weight: bold; ;font-size: 18px" >--}}
                {{--<button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                    {{--{{ auth()->user()->first_name }}--}}
                {{--</button>--}}
                {{--<div class="dropdown-menu">--}}
                    {{--<i class="fas fa-table-tennis"></i><a class="dropdown-item" href="#">Activiteiten beheren</a>--}}
                    {{--<i class="fas fa-tasks"></i><a class="dropdown-item" href="#">Taken beheren</a>--}}
                    {{--<i class="fas fa-map-marker-alt"></i><a class="dropdown-item" href="#">Locaties beheren</a>--}}
                    {{--<i class="fas fa-car"></i><a class="dropdown-item" href="#">Vervoer beheren</a>--}}
                    {{--<i class="fas fa-user-check"></i><a class="dropdown-item" href="#">Personeelsleden uitnodigen</a>--}}
                    {{--<div class="dropdown-divider"></div>--}}
                    {{--<i class="fas fa-user-alt"></i><a class="dropdown-item" href="#">Organisators beheren</a>--}}
                    {{--<i class="fas fa-people-carry"></i><a class="dropdown-item" href="#">Helpers beheren</a>--}}
                    {{--<i class="fas fa-glass-cheers"></i><a class="dropdown-item" href="#">personeelsfeest beheren</a>--}}
                    {{--<i class="fas fa-envelope"></i><a class="dropdown-item" href="#">Mail beheren</a>--}}
                    {{--<div class="dropdown-divider"></div>--}}
                    {{--<i class="fas fa-sign-out-alt"></i><a class="dropdown-item" href="#">Uitloggen</a>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--@endif--}}
    {{--@endauth--}}
</nav>
