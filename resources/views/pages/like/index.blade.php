
@extends('layout.index')
@section('content')
    <div class="likeContent">

        @foreach($cartItems as $item)
@php($giveBook =App\Models\GiveBooksModel::with(['giveBooks_genre' => function ($query) {
            $query->join('genre', 'genre.id', 'genre_id');
        }])->where('id',$item->id)->first())

        <div class="booksBlock" data-id="{{$giveBook->id}}">
            <img class="bookImg" src="{{url('https://stylus.ua/thumbs/568x568/32/36/1343332.jpeg')}}">
            <div class="booksInfo">
                <div class="bookTitle"> {{$giveBook->title}}</div>
                <div class="bookAuthor"> {{$giveBook->author}}</div>

                @switch($giveBook->condition)
                    @case(1<=$giveBook->condition && $giveBook->condition<5)
                        <div class="conditionText redCondition">{{$item->condition}} / 10</div>
                        @break
                    @case(5<=$giveBook->condition && $giveBook->condition<8)
                        <div class="conditionText yellowCondition">{{$item->condition}} / 10</div>
                        @break
                    @case(8<=$giveBook->condition)
                        <div class="conditionText greenCondition">{{$giveBook->condition}} / 10</div>
                        @break
                @endswitch
                <div class="bookGenre">
                    @foreach($giveBook->giveBooks_genre as $genre)
                        <a class="orangeLink" href="/">{{$genre->genre_name}} </a>
                    @endforeach
                </div>
                <div class="bookAddress"> {{$giveBook->address}}</div>
                <button type="button" class="btn  bookButton "> подробнее</button>
            </div>
            <div class="bookLike" data-url="{{route('cart.add',['id'=>$giveBook->id])}}">
                <svg class="likeId" width="24" height="24" viewBox="0 0 24 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M2.33857 10.711C-0.041108 7.61463 0.752117 2.97011 4.71824 1.42194C8.68437 -0.126229 11.064 2.97011 11.8573 4.51829C12.6505 2.97011 15.8234 -0.126229 19.7895 1.42194C23.7556 2.97011 23.7556 7.61463 21.376 10.711C18.9963 13.8073 11.8573 20 11.8573 20C11.8573 20 4.71824 13.8073 2.33857 10.711Z"
                        stroke="#393280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </div>

            <div class="bookDate"> {{\Carbon\Carbon::make($giveBook->updated_at)->diffForHumans() }}</div>

        </div>
        @endforeach
    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>


    $('div').click(function (){
        alert(1)
        alert($(this).attr(['data-url']));
        // $.ajax({
        //     url: '/json.php',
        //     method: 'get',
        //     dataType: 'json',
        //     success: function(data){
        //         alert(data.text);    /* выведет "Текст" */
        //         alert(data.error);   /* выведет "Ошибка" */
        //     }
        // });
    })
</script>

<style>
    .likeContent {
        width: 60%;
        background: linear-gradient(90deg, #25aac9, #2cc5c7, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 10s ease infinite;
        transform: translate3d(0, 0, 0);
        min-height: 100px;
        margin: auto;
    }
    .bookAddress{

        font-size: 18px;
    }
    .bookLike {
        margin-left: auto;
        margin-right: auto;
    }
    .bookButton{
        background: #ED553B !important;
        color: white !important;
        margin-top: 20px;
        border: none;
    }
    .bookDate {
        margin-top: 20px;
        margin-left: auto;
    }

    .bookTitle {
        font-size: 36px;
    }

    .bookAuthor {
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
        max-height: 250px;
        max-width: 250px;
        border-radius: 5px;
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
