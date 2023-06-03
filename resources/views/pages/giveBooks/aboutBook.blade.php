@extends('layout.index')

@section('content')
    <x-my-loader id="load" message="Еще немного..."></x-my-loader>

    <div class="containerMain">

        <div class="sliderWrapper">
            <div class="slider slider-for" style="object-fit: cover;">
                <div>
                    @if(isset($book->mainImage->url))
                        <img src="https://booksswap.ru/{{asset($book->mainImage->url ??'')}}" style="max-height: 400px">
                    @endif
                </div>
                @foreach($book->images as $item)
                    <div>
                        @if(isset($item->url))
                            <img src="https://booksswap.ru/{{asset($item->url??'')}}" style="max-height: 400px">
                        @endif

                    </div>

                @endforeach

            </div>
            <div class="slider slider-nav">
                <div>
                    @if(isset($book->mainImage->url))
                        <img src="https://booksswap.ru/{{asset($book->mainImage->url??'')}}" style="max-height: 200px">
                    @endif

                </div>
                @foreach($book->images as $item)
                    <div>
                        @if(isset($item->url))
                            <img src="https://booksswap.ru/{{asset($item->url??'')}}" style="max-height: 200px">
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
        <div class="mainContent">
            <div class="title"> "{{$book->title}}"</div>
            <div class="author"> {{$book->author}}</div>
            <div class="bookGenre">
                @foreach($book->giveBooks_genre as $key=> $genre)
                    <a class="genre orangeLink"
                       href="/">{{$genre->genre_name}} {{count($book->giveBooks_genre)===$key+1?'': ','}} </a>
                @endforeach
            </div>
            <div
                class="bookPrice {{$book->price>0 ?' ':' free'}}"> {{$book->price>0 ? $book->price .' руб.':'Бесплатно'}} </div>
            <div class="conditionText" style="display: flex;">
                Состояние:
                @switch($book->condition)
                    @case(1<=$book->condition && $book->condition<5)
                        <div class="conditionText redCondition"> {{$book->condition}} / 10</div>
                        @break
                    @case(5<=$book->condition && $book->condition<8)
                        <div class="conditionText yellowCondition">{{$book->condition}} / 10</div>
                        @break
                    @case(8<=$book->condition)
                        <div class="conditionText greenCondition"> {{$book->condition}} / 10</div>
                        @break
                @endswitch
            </div>
            <div class="userInfo">
                <div style="font-size: 24px;">город: {{ ($book->city->name??'' )}}</div>
                <div style="display: flex; align-items: flex-end">
                    <div style="font-size: 24px;color: gray" id="sender">
                        Опубликовал: {{ ($book->user->name??'' )}} </div>
                    <img src="https://booksswap.ru/public/images/message.png" id="chatCreate" class="sendIcon"
                         style="margin-left: 20px">
                </div>


            </div>
        </div>

    </div>
    <div style="display: flex;justify-content: space-around">
        @if(isset($book->description))
            <div class="description">
                Комментарий пользователя
                <div style="font-size: 24px;color: black; text-align: center">{{$book->description}}</div>
            </div>
        @else
            <div> Комментарии отсутствуют</div>
        @endif
        <div style="display: flex;justify-content: space-around;margin-top: 60px">
            <div></div>
            <div id="map" style="width: 600px; height:600px;" data-coordinates="{{$book->coordinates}}"></div>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    @if(\Illuminate\Support\Facades\Auth::user())
        <meta name="senderId" content="{{ \Illuminate\Support\Facades\Auth::user()->id}}"/>
    @endif

    <meta name="recieverId" content="{{ $book->user->id}}"/>



    <script src="https://api-maps.yandex.ru/2.1/?lang=ru-RU" type="text/javascript"></script>
    <script type="text/javascript"></script>
    <script src="https://unpkg.com/@popperjs/core@2"></script>

    <script>

        $(document).ready(function () {

            $('.slider-for').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                fade: true,
                asNavFor: '.slider-nav',
                autoplay: true,
                autoplaySpeed: 10000,
            });
            $('.slider-nav').slick({
                slidesToShow: 3,
                slidesToScroll: 1,
                asNavFor: '.slider-for',
                dots: true,
                arrows: false,
                focusOnSelect: true,
                autoplay: true,
                autoplaySpeed: 10000,
            });

            $('a[data-slide]').click(function (e) {
                e.preventDefault();
                var slideno = $(this).data('slide');
                $('.slider-nav').slick('slickGoTo', slideno - 1);
            });
            ymaps.ready(init);

            function init() {
                var myMap = new ymaps.Map("map", {
                    center: [{{$book->coordinates}}],
                    zoom: 3,
                    controls: ['zoomControl']
                }, {
                    searchControlProvider: 'yandex#search'
                });

                var myCollection = new ymaps.GeoObjectCollection();


                var myPlacemark = new ymaps.Placemark([
                    {{$book->coordinates}}
                ], {
                    balloonContent: '{{$book->address}}'
                }, {
                    preset: 'islands#icon',
                    iconColor: '#ED553B'
                });
                myCollection.add(myPlacemark);
                myMap.geoObjects.add(myCollection);

                // Сделаем у карты автомасштаб чтобы были видны все метки.
                myMap.setBounds(myCollection.getBounds(), {checkZoomRange: true, zoomMargin: 9});

                $('.my-loader').hide();
                // $('.my-loader').style.display='none';

            };
            $("#chatCreate").on("click", function () {
                let btnCreateChat = document.querySelector('#chatCreate');
                let recieverId = $('meta[name="recieverId"]').attr('content')
                let senderId = $('meta[name="senderId"]').attr('content');

                if (senderId === undefined || senderId === null) {
                    window.location.href = 'https://booksswap.ru/registration';
                    return;
                }
                let postedData = {
                    'content': 'Привет,меня заинтересовала книга" ' + document.querySelector('.title').textContent + ' "',
                    'receiver': recieverId,
                    'sender': senderId,
                }

                let url = 'https://booksswap.ru/chat/send-message';
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: 'POST',
                    url: url,
                    data: postedData,
                    dataType: 'json',
                    success: function (data) {
                        location.href = 'https://booksswap.ru/chat/#' + recieverId;
                    },
                    error: function () {
                        toastr.warning('Произошла ошибка в отправке сообщения. Попробуйте позже');

                    }


                });
            });

        });


    </script>
    <style>
        .sendIcon {
            width: 40px;
            height: 40px;
        }

        .sendIcon:hover {
            transform: scale(1.4);
            cursor: pointer;
            transition-duration: 0.3s;
        }

        .description {
            margin-top: 40px;
            color: grey;
            font-size: 36px;
        }

        .sliderWrapper {
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
            visibility: visible;
            text-align: center;
            width: 500px;
            display: block;
            margin-left: 0;
        }

        .messageButton {
            margin-top: 20px;
            background-color: #ED553B !important;
            width: 200px;
            color: white;
            font-size: 12px;
        }

        .containerMain {

            display: flex;
            flex-direction: row;
        }

        .mainContent {
            margin-left: 100px;
        }

        .title {
            font-size: 54px;
            overflow: hidden;
            text-overflow: ellipsis;
            color: grey;
        }

        .author {
            overflow: hidden;
            text-overflow: ellipsis;
            font-size: 36px;
            color: grey;
        }

        .genre {
            margin-top: 40px;
            font-size: 18px;
        }

        .bookPrice {
            margin-top: 20px;
            color: #ff725e;

            font-size: 32px;
        }

        .free {
            color: #56d2ea !important;
        }

        .conditionText {
            font-weight: bold;
            font-size: 24px;

        }

        .redCondition {
            color: #FF6347;
            margin-left: 20px;

        }

        .yellowCondition {
            color: #efca02;
            margin-left: 20px;
        }

        .greenCondition {
            color: mediumspringgreen;
            margin-left: 20px;

        }


    </style>

@endsection


