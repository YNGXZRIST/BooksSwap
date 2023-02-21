@extends('layout.index')
@section('content')
    <div class="giveBooksWrapper">
        <div class="giveBooksBanner">
            <div class="giveBooksTextBanner">
                <div class="giveBooksTitle">
                    Забирайте книги
                </div>
                <div class="giveBooksText"> оставленные другими пользователями
                </div>
            </div>

            <img src="{{asset('images/giveBooksBanner.svg')}}" style="width: 280px;height: 280px">
        </div>

    </div>
    <div class="booksWrapper">
        {{--        @dd($giveBooks)--}}
        {{--        @include('sections.filter')--}}
        @foreach($giveBooks as $item)

            <div class="booksBlock" data-id="{{$item->id}}">
                <img class="bookImg" src="{{asset($item->mainImage->url??'images/bookNotFound.svg')}}">
                <div class="booksInfo">
                    <div class="bookTitle"> {{$item->title}}</div>
                    <div class="bookAuthor"> {{$item->author}}</div>

                    @switch($item->condition)
                        @case(1<=$item->condition && $item->condition<5)
                            <div class="conditionText redCondition">{{$item->condition}} / 10</div>
                            @break
                        @case(5<=$item->condition && $item->condition<8)
                            <div class="conditionText yellowCondition">{{$item->condition}} / 10</div>
                            @break
                        @case(8<=$item->condition)
                            <div class="conditionText greenCondition">{{$item->condition}} / 10</div>
                            @break
                    @endswitch
                    <div class="bookGenre">
                        @foreach($item->giveBooks_genre as $genre)
                            <a class="orangeLink" href="/">{{$genre->genre_name}} </a>
                        @endforeach
                    </div>
                    <div class="bookAddress"> {{$item->address}}</div>
                   <button type="button" class="btn btn-light bookButton "> подробнее</button>
                </div>
                <a class="bookLike" href="{{route('cart.add',['id'=>$item->id])}}">
                    <svg width="24" height="24" viewBox="0 0 24 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.33857 10.711C-0.041108 7.61463 0.752117 2.97011 4.71824 1.42194C8.68437 -0.126229 11.064 2.97011 11.8573 4.51829C12.6505 2.97011 15.8234 -0.126229 19.7895 1.42194C23.7556 2.97011 23.7556 7.61463 21.376 10.711C18.9963 13.8073 11.8573 20 11.8573 20C11.8573 20 4.71824 13.8073 2.33857 10.711Z"
                            stroke="#393280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <div class="bookDate"> {{\Carbon\Carbon::make($item->updated_at)->diffForHumans() }}</div>

            </div>

        @endforeach
    </div>

@endsection
<style>
    .bookAddress{

        line-height: 1.5em;
        height: 3em;
        overflow: hidden;
        white-space: pre-wrap;
        text-overflow: ellipsis;
      max-width: 450px;
        font-size: 16px;
    }
    .bookLike {
        margin-left: auto;
        margin-right: auto;
    }
.bookButton{
    background: #ED553B !important;
    color: white !important;
    margin-top: 10px;
}
    .bookDate {
        white-space: nowrap;
        margin-top: 20px;
        margin-left: 20px;
    }

    .bookTitle {
        max-width: 450px;
        font-size: 36px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .bookAuthor {
        max-width: 450px;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 26px;
    }

    .conditionText {
        font-weight: bold;
        font-size: 24px;

    }

    .redCondition {
        color: #FF6347;


    }

    .yellowCondition {
        color: #efca02;
    }

    .greenCondition {
        color: mediumspringgreen;

    }

    .booksBlock {
        /*background: #28a745;*/
        display: flex;
        padding: 20px;
    }

    .booksInfo {
        margin-left: 20px;
    }

    .bookImg {
        min-height: 250px;
        min-width: 250px;
        max-height: 250px;
        max-width: 250px;
        border-radius: 5px;
        background: linear-gradient(90deg, #25aac9, #2cc5c7, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 10s ease infinite;
        transform: translate3d(0, 0, 0);
    }

    .booksWrapper {
        margin-top: 20px;
        min-height: 100px;
        width: 70%;
        margin-left: auto;
        margin-right: auto;
    }


    .bookLike {
        margin-top: 20px;
    }

    .bookLike svg {
        transition: 0.1s;
    }

    .bookLike svg:hover {
        transform: scale(1.4);
        cursor: pointer;
    }

    .giveBooksWrapper {

        display: flex;
        justify-content: center;

    }

    .giveBooksText {
        font-size: 24px;
        max-width: 60%;
    }

    .giveBooksTitle {
        font-size: 48px;
        color: white
    }

    .giveBooksTextBanner {
        max-width: 70%;
        margin-top: 60px;

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
</style>
