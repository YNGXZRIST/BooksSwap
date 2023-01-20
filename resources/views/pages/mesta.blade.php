@extends('layout.index')
@section('content')
    <div class="mestaTitle">Список мест с книгами</div>
    <div class="mestaWrapper">
        <div class="list-group placesGroup">
            @foreach(\App\Models\SafeShelves::where('city_id',1)->get() as $item)

                <div class="d-flex w-100 justify-content-between place">
                    <h5 class="mb-1">{{$item->title}}</h5>

                </div>
                <p class="mb-1">{{$item->human_address}}</p>

            @endforeach
        </div>
        <div id="map" style="width: 600px; height:600px"></div>
    </div>

@endsection
<style>
    .placesGroup{
        overflow-y: auto;
        overflow-x: hidden;
        /*margin-left: 40px;*/
        margin-right: 40px;
        min-width: 200px;
        padding: 20px;
    }
    .place{
        margin: 20px;
        color: #ED553B;
    }
    .mestaWrapper {
        display: flex;
        justify-content: center;
        max-height: 600px;
        margin-bottom: 100px;
    }

    .mestaTitle {
        text-align: center;
        font-size: 36px;
        margin-bottom: 20px;
    }
</style>
<script src="https://api-maps.yandex.ru/2.1/?lang=ru-RU" type="text/javascript"></script>
<script type="text/javascript">


    ymaps.ready(init);

    function init() {
        var myMap = new ymaps.Map("map", {
            center: [{{\App\Models\SafeShelves::where('city_id',1)->first()->address}}],
            zoom: 16,
            controls: ['zoomControl']
        }, {
            searchControlProvider: 'yandex#search'
        });

        var myCollection = new ymaps.GeoObjectCollection();

        @foreach(\App\Models\SafeShelves::where('city_id',1)->get() as $item)
        var myPlacemark = new ymaps.Placemark([
            {{$item->address}}
        ], {
            balloonContent: '{{$item->title}}'
        }, {
            preset: 'islands#icon',
            iconColor: '#1b8094'
        });
        myCollection.add(myPlacemark);
        @endforeach
        myMap.geoObjects.add(myCollection);

        // Сделаем у карты автомасштаб чтобы были видны все метки.
        myMap.setBounds(myCollection.getBounds(), {checkZoomRange: true, zoomMargin: 9});
    }

</script>
