<div class="containerMain">

    <div class="sliderWrapper">
        <div class="slider slider-for" style="object-fit: cover;">
            <div>
                <img src="https://booksswap.ru/{{asset($book->mainImage->url ??'')}}" style="max-height: 400px">
            </div>
            @foreach($book->images as $item)
                <div>
                    <img src="https://booksswap.ru/{{asset($item->url??'')}}" style="max-height: 400px">
                </div>

            @endforeach

        </div>
        <div class="slider slider-nav">
            <div>
                <img src="https://booksswap.ru/{{asset($book->mainImage->url??'')}}" style="max-height: 200px">
            </div>
            @foreach($book->images as $item)
                <div>
                    <img src="https://booksswap.ru/{{asset($item->url??'')}}" style="max-height: 200px">
                </div>
            @endforeach
        </div>
    </div>
    <div class="mainContent">
        <div class="title">  "{{$book->title}}"</div>
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
                <img src="https://booksswap.ru/public/images/message.png" id="chatCreate" class="sendIcon" style="margin-left: 20px">
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
    <div style="display: flex;justify-content: space-around">
        <div></div>
        <div id="map" style="width: 600px; height:600px;" data-coordinates="{{$book->coordinates}}"></div>
    </div>
</div>
