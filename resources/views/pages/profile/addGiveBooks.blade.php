@extends('layout.index')

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"/>
<script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"></script>

@section('content')
    <div class="addGiveBooksWrapper">
        <form action="{{route('profile.submit_give_books')}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleFormControlInput1">Название книги</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="bookName"
                       placeholder="Гордость и предубеждение"
                       @if(isset($giveBookUpdate->title))
                           value="{{$giveBookUpdate->title}}"
                    @endif
                >
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput2">Автор книги</label>
                <input type="text" class="form-control" id="exampleFormControlInput2" placeholder="Джейн Остен"
                       name="bookAuthor"
                       @if(isset($giveBookUpdate->author))
                           value="{{$giveBookUpdate->author}}"
                    @endif
                >
            </div>
            <div class="form-group">
                <label for="genreBook">Жанр книги</label>
                <select class="form-control" onchange="getval(this);" name="bookGenre">
                    @foreach(\App\Models\ThemeBooksModel::select('id','name')->get() as $item)
                        <option data-id="{{$item->id}}" value="{{$item->id}}">{{$item->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlSelect12">Поджанр книги</label>
                <select class="form-control  subGenre" id="exampleFormControlSelect12" multiple name="bookSubgenre[]">
                    @foreach(App\Models\GenreModel::query()->select('id','genre_name')->where('theme_id', 1)->get()->toArray() as $item)
                        <option value="{{$item['id']}}">{{$item['genre_name']}}</option>
                    @endforeach

                </select>

            </div>

            <div class="form-group">
                <label for="exampleFormControlSelect1">Состояние книги</label>
                <select class="form-control" id="exampleFormControlSelect1" name="bookCondition">

                    @for($i=1;$i<=10; $i++)
                        <option
                            @if(isset($giveBookUpdate->condition) && $i==$giveBookUpdate->condition)
                                    selected
                            @endif
                        >{{$i}}</option>
                    @endfor


                </select>
            </div>
            <div class="form-group">
                <label for="exampleFormControlFile1">Фотографии</label>
                <input type="file" class="form-control-file" id="exampleFormControlFile1" accept=".jpg, .jpeg, .png"
                       multiple name="images[]">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Комментарий</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="bookComments"
                >@if(isset($giveBookUpdate->description)){{$giveBookUpdate->description}}@endif</textarea>
            </div>

            <div class="form-group"><label for="price">Цена</label>
                <div class="input-group mb-3">


                    <input type="text" class="form-control" id="price" aria-label="Цена" name="price"
                           @if(isset($giveBookUpdate->price))
                               value="{{$giveBookUpdate->price}}"
                        @endif
                    >
                    <div class="input-group-prepend">
                        <span class="input-group-text">₽</span>
                    </div>
                    {{--                    <div class="input-group-append">--}}
                    {{--                        <span class="input-group-text">.00</span>--}}
                    {{--                    </div>--}}
                </div>
            </div>


            <div class="form-group">

                <label>Отметьте место на карте</label>
                {{--                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="bookComments"></textarea>--}}
                <div id="leafletmap"></div>
                <input id="myInputHidden" name="coordinates" type="hidden" value="{{isset($giveBookUpdate->coordinates)?$giveBookUpdate->coordinates:''}}"/>
                <input id="myInputHidden1" name="humanAddress" type="hidden" value="{{isset($giveBookUpdate->address) ?$giveBookUpdate->address:''}}"/>
                <input id="myInputHidden2" name="city" type="hidden" value=""/>
                @if(isset($giveBookUpdate->id))
                    <input id="updateId" name="updateId" type="hidden" value="{{$giveBookUpdate->id}}"/>

                @endif


            </div>


            @csrf
            <button type="submit" class="btn submitBtn ">Опубликовать</button>
        </form>
        @if(isset($giveBookUpdate->coordinates))
            <meta name="coordinates" content="{{$giveBookUpdate->coordinates}}" />
        @endif

{{--        <meta name="recieverId" content="{{ $giveBookUpdate->address}}" />--}}
        <script>
            let markers = []
            let osmUrl = 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
            let osmLayer = new L.TileLayer(osmUrl, {
                maxZoom: 18,

            });
            let initCoord =$('meta[name="coordinates"]').attr('content')

            let pt = new L.LatLng(54.718692892428145, 20.502049656271844);
            let map = new L.Map('leafletmap', {
                center: pt,
                zoom: 14,
                layers: [osmLayer]
            });// Script for adding marker on map click
            let orangeIcon = new L.Icon({
                iconUrl: 'https://booksswap.ru/public/images/markers/marker-icon-2x-orange2.png',
                shadowUrl: 'https://booksswap.ru/public/images/markers/marker-shadow.png',
                iconSize: [25, 41],
                iconAnchor: [12, 41],
                popupAnchor: [1, -34],
                shadowSize: [41, 41]
            });
            if(initCoord!==undefined){
                let initMarker = L.marker(initCoord.split(','),
                    {   icon: orangeIcon,
                        draggable: true,
                        title: "Resource location",
                        alt: "Resource Location",
                        riseOnHover: true
                    }).addTo(map);
                markers.push(initMarker)
            }


            function onMapClick(e) {
                if (markers.length > 0) {
                    map.removeLayer(markers.pop());
                }
                let coord = [e.latlng.lat, e.latlng.lng];
                let displayName;
                let address;
                fetch(`https://nominatim.openstreetmap.org/reverse?lat=${coord[0]}&lon=${coord[1]}&format=json`, {
                    headers: {
                        'User-Agent': 'ID of your APP/service/website/etc. v0.1'
                    }
                }).then(res => res.json())
                    .then(res => {
                        displayName = res.display_name;
                        address = res.address;
                        let marker = L.marker(e.latlng, {
                            icon: orangeIcon,
                            draggable: true,
                            title: "Resource location",
                            alt: "Resource Location",
                            riseOnHover: true
                        }).addTo(map).bindPopup(displayName).openPopup();
                        marker.on("dragend", function (ev) {

                            var chagedPos = ev.target.getLatLng();
                            this.bindPopup(chagedPos.toString()).openPopup();

                        });

                        markers.push(marker)
                        $("#myInputHidden2").val(address.city);

                        $("#myInputHidden1").val(displayName);
                        $("#myInputHidden").val(coord);

                    })


            }

            map.on('click', onMapClick);


        </script>
    </div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>

    // L.marker(pt).addTo(map)
    //     .bindPopup('Кто тут ??')
    //     .openPopup();

    function getval(sel) {
        let postedData = {
            genre: sel.value
        }
        let url = 'https://booksswap.ru/getSubGenreByGenre'
        $.ajax({
            type: 'GET',
            url: url,
            data: postedData,
            dataType: 'json',
            success: function (data) {
                $(".subGenre option").remove()
                data.forEach(function (elem) {
                    $('.subGenre').append($('<option>', {
                        value: elem.id,
                        text: elem.genre_name
                    }));
                })

            }
        });
    }


</script>
<style>
    #leafletmap {
        width: 700px;
        height: 700px;
    }

    .submitBtn {
        background: #ED553B !important;
        color: white !important;
        margin: 0 auto !important;
        display: block !important;
    }

    .addGiveBooksWrapper {
        margin: auto;
        padding: 100px;
        width: 60%;
        background: linear-gradient(90deg, #25aac9, #2cc5c7, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 10s ease infinite;
        transform: translate3d(0, 0, 0);
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }
        50% {
            background-position: 100% 50%;
        }
        100% {
            background-position: 0% 50%;
        }
    }

    label {
        color: white;
        font-size: 24px;
    }
</style>
