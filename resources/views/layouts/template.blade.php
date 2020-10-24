<!doctype html>
<html lang="nl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    @yield('css_after')
    <title>@yield('title', 'personeelsfeest')</title>



    <!-- Fonts -->

    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" />--}}
    {{--<link rel="stylesheet" href="{{ mix('css/app.css') }}">--}}

    {{--@section("css_after")--}}

    {{--@endsection--}}
    {{--@yield('css_after')--}}
    {{--<title>@yield('title', 'Personeelsfeest')</title>--}}

    {{--*/$functie = collect(["ontwikkelaar","tester," "])/*--}}


</head>
<body>




    @include('shared.navbar')
    <main class="container mt-3" id="main">

        @yield('main', 'Page under construction ...')

    </main>
    @include('shared.footer')

    <script src="{{ mix('js/app.js') }}"></script>
    @yield('script_after')
    @if(env('APP_DEBUG'))
        <script>
            $('form').attr('novalidate', 'true');

            function autoResizeDiv()
            {
                document.getElementById('main').style.height = window.innerHeight +'px';
            }
            window.onresize = autoResizeDiv;
            autoResizeDiv();

            function printoverzicht(el){
                var restorepage=document.body.innerHTML;
                var printcontent=document.getElementById(el).innerHTML;
                document.body.innerHTML=printcontent;
                window.print();
                document.body.innerHTML=restorepage;
            }
        </script>
    @endif
</body>

</html>
