<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>BooksSwap</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <script src="{{ asset('/js/app.js') }}" defer></script>
    <!-- Latest BS-Select compiled and minified CSS/JS -->
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/css/bootstrap-select.min.css">--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta2/dist/js/bootstrap-select.min.js"></script>--}}
{{--    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">--}}
{{--    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>--}}

{{--    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"--}}
{{--            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"--}}
{{--            crossorigin="anonymous"></script>--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"--}}
{{--            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"--}}
{{--            crossorigin="anonymous"></script>--}}
    <script src="https://js.pusher.com/7.2/pusher.min.js"></script>
{{--    <script>--}}
{{--        <script src="https://cdn.jsdelivr.net/npm/vue@2.7.14"></script>--}}
{{--        // Enable pusher logging - don't include this in production--}}
{{--        Pusher.logToConsole = true;--}}

{{--        var pusher = new Pusher('52f22895600e08353c7e', {--}}
{{--            cluster: 'eu'--}}
{{--        });--}}

{{--        var channel = pusher.subscribe('my-channel');--}}
{{--        channel.bind('my-event', function(data) {--}}
{{--            alert(JSON.stringify(data));--}}
{{--        });--}}
{{--    </script>--}}
    <style>
        html body {
            font-family: 'Nunito', sans-serif;


        }

        main {
            padding-left: 5%;
            padding-right: 5%;
            margin-top: 24px;
            min-height: 100vh;

        }

        .orangeLink:hover {
            color: #ED553B;
            cursor: pointer;
            text-decoration: none;
        }

        .orangeLink {
            color: #111111;
        }


    </style>
</head>
<body>

@include('sections.header')
<main>
    @include('sections.validate')
    @yield('content')
</main>
@include('sections.footer')
</body>

</html>

