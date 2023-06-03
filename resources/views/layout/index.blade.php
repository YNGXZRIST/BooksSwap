<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=1440">
    <title>BooksSwap</title>
    <!-- Подключение различных библиотек и стилей -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://booksswap.ru/{{asset( '/css/toastr.css')}}" rel="stylesheet">
    <link href="https://booksswap.ru/{{asset( '/css/tippy.css')}}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://booksswap.ru/{{ asset('/css/app.css') }}" rel="stylesheet">
    <script src="https://booksswap.ru/{{ asset('/js/app.js') }}" defer></script>
    <script src="https://booksswap.ru/{{ asset( '/js/jquery.js')}}" ></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js">
    <script  src="https://js.pusher.com/7.2/pusher.min.js"></script>


    <style>
        html body {
            font-family: 'Nunito', sans-serif;
            min-width: 1440px;

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
<body >

@include('sections.header')
<main >
    @include('sections.validate')
    @yield('content')
</main>
@include('sections.footer')
</body>

</html>

