@extends('layout.index')
@section('content')
    <x-my-loader id="load" message="Еще немного..."></x-my-loader>

    <div class="wrapper" style="padding-left: 20px;padding-top: 20px">

        @if(isset($crossing->cover_url))
            {{--            <div class='boxPhotos'>--}}
            <img class="boxPhotos" src="https://booksswap.ru/{{asset($crossing->cover_url ??'')}}">
            {{--            </div>--}}

        @else
            <div class="imageTradeGive" style="margin-right: 10px">

                <div style="color: white;font-size: 24px;text-align: center;font-weight: bold">
                    {{$crossing->name}}
                </div>

                <div style="color: black !important;font-size: 20px;text-align: center;">
                    {{$crossing->author}}
                </div>

            </div>
        @endif
        <div style="margin-left: 20px">
            <div class="bookTitle">
                {{$crossing->name}}
            </div>
            <div class="bookAuthor">
                {{$crossing->author}}
            </div>
            <div class="bookAdder">
                Добавлена
                <strong> {{\App\Models\User::where('id',$crossing->user_id)->first()->name}} </strong> {{\Carbon\Carbon::make($crossing->created_at)->diffForHumans()}}
                в г.{{\App\Models\Cities::where('id',$crossing->city_id)->first()->name}}
            </div>
            @if(isset($crossing->isbn))
                <div class="bookAdder">
                    ISBN:  {{$crossing->isbn}}
                </div>
            @endif
            <div class="bookAdder">
                Найдена {{count($crossing->crossings)}} раз
            </div>
            @if(count($crossing->crossings)>0)
                <div class="bookAdder">
                    Последнее местонахождение: {{$crossing->crossings[0]->location}}
                    , г. {{\App\Models\Cities::where('id',$crossing->crossings[0]->city_id)->first()->name}}
                </div>
            @endif
        </div>
        <div class="knigovorot">

          <strong style="font-size: 36px;margin-bottom: 40px">
              Книговорот
          </strong>
            <div>
                @foreach($crossing->crossings as $item)
                    <div style=" box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);margin-bottom: 20px;padding: 20px;width: 600px;">
                        @switch($item->status)
                            @case(1)
                                <div style="white-space: nowrap">Оставлена <strong> {{\App\Models\User::where('id',$item->user_id)->first()->name}}</strong>
                                    в {{\App\Models\Cities::where('id',$item->city_id)->first()->name}}
                                </div>
                                @break
                            @case(2)
                                <div style="white-space: nowrap">Найдена <strong>{{\App\Models\User::where('id',$item->user_id)->first()->name}}</strong>
                                    в {{\App\Models\Cities::where('id',$item->city_id)->first()->name}}

                                </div>
                                @break
                            @case(3)
                                <div style="white-space: nowrap">Взята <strong> {{\App\Models\User::where('id',$item->user_id)->first()->name}}</strong>
                                    в {{\App\Models\Cities::where('id',$item->city_id)->first()->name}}
                                </div>
                                @break
                        @endswitch
                        <div>местонахождение: {{$item->location}}</div>
                        @if(isset($item->location_description))
                            <div class="borderLeft">{{$item->location_description}}
                                @if(isset($item->cover_url))
                                    <img src="https://booksswap.ru/{{asset($item->cover_url) }}" class="enlarge-item"
                                         style="max-width:120px; max-height: 200px;object-fit: contain; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);">
                                @endif
                            </div>
                        @endif

                    </div>
                @endforeach
                    <div style=" box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);margin-bottom: 20px;padding: 20px;width: 600px;">
                        @switch($crossing->status)
                            @case(1)
                                <div style="white-space: nowrap">Оставлена <strong> {{$crossing->user->name}}</strong>
                                    в {{$crossing->city->name}}
                                </div>
                                @break
                            @case(2)
                                <div style="white-space: nowrap">Найдена<strong> {{$crossing->user->name}}</strong>
                                    в {{$crossing->city->name}}

                                </div>
                                @break
                            @case(3)
                                <div style="white-space: nowrap">Взята<strong> {{$crossing->user->name}}</strong>
                                    в {{$crossing->city->name}}
                                </div>
                                @break
                        @endswitch
                        <div>местонахождение: {{$crossing->location}}</div>
                        @if(isset($crossing->location_description))
                            <div class="borderLeft">{{$crossing->location_description}}</div>
                        @endif
                    </div>
            </div>

        </div>

    </div>
@endsection





<style>
    .knigovorot{
        flex-direction: column;
        align-items: center;
        width: 100%;
        display: flex;
        justify-content: space-around;
    }
    .bookAdder {
        font-size: 24px;
        overflow: hidden;
        text-overflow: ellipsis;

    }

    .wrapper {
        margin-top: 40px;
        display: flex;
        min-height: 900px;
        flex-direction: row;
        flex-wrap: wrap;

        border-radius: 5px;
    }

    a {
        text-decoration: none !important;
    }

    a:hover {
        text-decoration: none !important;
    }

    div {
        color: black !important;
    }

    .boxPhotos {
        z-index: 2;
        overflow: hidden;
        max-width: 400px;
        max-height: 500px;
        object-fit: contain;
    }

    .boxPhotos img {
        max-width: 400px;
        max-height: 500px;
        object-fit: contain;
    }

    .cover__back-image {
        z-index: 1;
        -o-object-fit: cover;
        object-fit: cover;
        filter: blur(6px);
        width: 255px !important;
        height: 300px !important;
    }

    .bookAuthor {
        max-width: 450px;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 26px;
        color: grey !important;
    }

    .borderLeft {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        padding-left: 20px;
        border-left: 3px solid #25aac9;
        color: gray !important;
    }

    .imageTradeGive {
        overflow: hidden;
        text-overflow: ellipsis;
        width: 250px;
        height: 300px;
        background: linear-gradient(90deg, #25aac9, #2cc5c7, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 10s ease infinite;
        transform: translate3d(0, 0, 0);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        padding: 20px;
        border-radius: 3px;

    }

    .giveBooksWrapper {

        display: flex;
        justify-content: center;

    }

    .bookTitle {
        max-width: 590px;
        font-size: 36px;
        overflow: hidden;
        text-overflow: ellipsis;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-image: linear-gradient(90deg, #25aac9, #2cc5c7, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 5s ease infinite;
        transform: translate3d(0, 0, 0);
    }

    .imageTradeDesired {
        overflow: hidden;
        text-overflow: ellipsis;
        width: 250px;
        height: 300px;
        background: linear-gradient(90deg, #ed553b, #f88a76, #ff8972, #ff8357);
        background-size: 400% 400%;
        animation: gradient 10s ease infinite;
        transform: translate3d(0, 0, 0);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-around;
        padding: 20px;
        border-radius: 3px;
    }

    .giveBooksBanner {
        display: flex;
        justify-content: space-around;
        height: 300px;
        border-radius: 5px;
        /*width: 50%;*/
        background: linear-gradient(90deg, #25aac9, #2cc5c7, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 10s ease infinite;
        transform: translate3d(0, 0, 0);
        padding: 20px;


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

    .giveBooksTextBanner {
        max-width: 70%;
        margin-top: 60px;

    }

    .giveBooksTitle {
        font-size: 48px;
        color: white !important;
    }

    .giveBooksText {
        font-size: 24px;
        max-width: 60%;
    }

    .trade {
        width: 1000px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        margin-bottom: 20px;
        border-radius: 5px;
        min-height: 300px;
        /*background: #28a745;*/
        display: flex;
        justify-content: space-between;
        padding: 20px;
    }

    .swapsWrapper {
        margin-top: 40px;
        display: flex;
        justify-content: center;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
    }

    .swapInfo {
        color: gray !important;
        font-size: 20px;
        text-align: center;
        width: 900px;
    }

    .addButton {
        margin-top: 20px;
        background-color: #ED553B !important;
        width: 200px;
        color: white !important;
        font-size: 12px;
    }

    .addButton:hover, .addButton:focus {
        color: black !important;
    }

</style>
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<script>
    $(document).ready(function () {
        $('.my-loader').hide();
    });
</script>
