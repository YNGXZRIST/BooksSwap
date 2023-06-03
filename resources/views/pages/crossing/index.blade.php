@extends('layout.index')
@section('content')
    @if(session('isSave'))
        <input type="hidden" id="isSave" value="true">
    @endif
    @if(\Illuminate\Support\Facades\Auth::user())
        <div style="display: flex; justify-content: flex-end">
            <button id="addCrossing" class="btn addButton">Добавить книгу</button>
        </div>
    @endif
    <div class="giveBooksWrapper" style="margin-top: 20px">
        <div class="giveBooksBanner">
            <div class="giveBooksTextBanner">
                <div class="giveBooksTitle">
                    Ищите книги
                </div>
                <div class="giveBooksText"> на полках своего города
                </div>
            </div>

            <img src="{{asset('images/swaps/swap_gif.svg')}}" style="width: 280px;height: 280px">
        </div>

    </div>
    <div class="swapsWrapper">
        @foreach($crossing as $item)

            <a class="trade" href="{{route('crossing.about',['id'=>$item->id])}}">
    <div style="display: flex">
        @if(isset($item->cover_url))
            <div class='boxPhotos'>
                <img src="{{asset($item->cover_url) }}">
            </div>


        @else
            <div class="imageTradeGive" style="margin-right: 10px">

                <div style="color: white;font-size: 24px;text-align: center;font-weight: bold">
                    {{$item->name}}
                </div>

                <div style="color: black !important;font-size: 20px;text-align: center;">
                    {{$item->author}}
                </div>

            </div>
        @endif
        <div style="display: flex;flex-direction: column; margin-left: 20px">
            <div class="bookTitle">
                {{$item->name}}
            </div>
            <div class="bookAuthor">
                {{$item->author}}
            </div>

            @if(count($item->crossings)===0)
                <div>
                    @switch($item->status)
                        @case(1)
                            <div style="white-space: nowrap">Оставлена <strong> {{$item->user->name}}</strong>
                                в {{$item->city->name}}
                            </div>
                            @break
                        @case(2)
                            <div style="white-space: nowrap">Найдена<strong> {{$item->user->name}}</strong>
                                в {{$item->city->name}}

                            </div>
                            @break
                        @case(3)
                            <div style="white-space: nowrap">Взята<strong> {{$item->user->name}}</strong>
                                в {{$item->city->name}}
                            </div>
                            @break
                    @endswitch
                    <div>местонахождение: {{$item->location}}</div>
                    @if(isset($item->location_description))
                        <div class="borderLeft">{{$item->location_description}}</div>
                    @endif
                </div>
            @else
                <div style="color: black !important;">
                    @switch($item->status)
                        @case(1)
                            <div style="white-space: nowrap;color: black !important;">Оставлена
                                <strong> {{\App\Models\User::where('id',$item->crossings[0]->user_id)->first()->name}}</strong>
                                в {{\App\Models\Cities::where('id',$item->crossings[0]->city_id)->first()->name}}
                            </div>
                            @break
{{--                        @case(2)--}}
{{--                            <div style="color: black !important;">--}}
{{--                                Найдена<strong> {{\App\Models\User::where('id',$item->crossings[0]->user_id)->first()->name}}</strong>--}}
{{--                                в {{\App\Models\Cities::where('id',$item->crossings[0]->city_id)->first()->name}}--}}

{{--                            </div>--}}
{{--                            @break--}}
                        @case(3)
                            <div style="white-space: nowrap;color: black !important;">
                                Взята <strong> {{\App\Models\User::where('id',$item->crossings[0]->user_id)->first()->name}}</strong>
                                в {{\App\Models\Cities::where('id',$item->crossings[0]->city_id)->first()->name}}
                            </div>
                            @break
                        @default
                            <div style="white-space: nowrap;color: black !important;">Оставлена
                                <strong> {{\App\Models\User::where('id',$item->crossings[0]->user_id)->first()->name}}</strong>
                                в {{\App\Models\Cities::where('id',$item->crossings[0]->city_id)->first()->name}}
                            </div>
                            @break

                    @endswitch
                    <div style="white-space: nowrap;color: black !important;">местонахождение: {{$item->crossings[0]->location}}</div>
                    @if(isset($item->crossings[0]->location_description))
                        <div class="borderLeft" >{{$item->crossings[0]->location_description}}
                            @if(isset($item->crossings[0]->cover_url))
                                <img src="{{asset($item->crossings[0]->cover_url) }}"
                                     style="width:57px; height: 100px; box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);">
                            @endif
                        </div>

                    @endif
                </div>
            @endif
        </div>
    </div>

                    <div>
                        {{\Carbon\Carbon::make($item->updated_at)->diffForHumans()}}
                    </div>

            </a>
        @endforeach

            {{ $crossing->links('pagination::bootstrap-4') }}
    </div>



@endsection
<style>


    a {
        text-decoration: none !important;
    }

    a:hover {
        text-decoration: none !important;
    }
    div{
        color: black !important;
    }
    .boxPhotos {
        z-index: 2;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        overflow:hidden;
        width:250px;
        height: 300px;
    }
    .boxPhotos img {
        position: absolute;
        width:250px;
        height: 300px;
        object-fit:contain;
    }
    .cover__back-image {
        z-index: 1;
        -o-object-fit: cover;
        object-fit: cover;
        filter: blur(6px);
        width:255px !important;
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
<script src="https://unpkg.com/@popperjs/core@2"></script>

<script>
    // tippy(document.querySelectorAll('.bookLike'),{
    //     content: '123',
    // });
    $(document).ready(function () {
        $('#addCrossing').on("click", function () {
            window.location.href = 'https://booksswap.ru/profile/crossing/add';
        });
        if ($('#isSave').length) {
            toastr.success('Книга успешно добавлена в книговорот');
            // Выполнение JS кода с использованием user_id
        }
    });

</script>
