@extends('layout.index')
<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.3.js"></script>
@section('content')
    <div style="display: flex; justify-content: flex-end">
        <a class="btn add " href="{{route('profile.add_give.index')}}"> отдать книги</a>
    </div>


    <div class="giveBooksWrapper">
        <div class="giveBooksBanner">
            <div class="giveBooksTextBanner">
                <div class="giveBooksTitle">
                    Забирайте книги
                </div>
                <div class="giveBooksText"> отдаваемые другими пользователями
                </div>
            </div>

            <img src="{{asset('images/giveBooksBanner.svg')}}" style="width: 280px;height: 280px">
        </div>

    </div>

    <div class="booksWrapper">
        @foreach($giveBooks ?? [] as $item)

            <div class="booksBlock" data-id="{{$item->id}}">
                @if(isset($item->mainImage->url))
                    <div class='boxPhotos'>
                        <img class="{{isset($item->mainImage->url)?'':' "bookImg not-found'}}"
                             src="{{asset($item->mainImage->url??'images/bookNotFound.svg')}}">
                    </div>
                @else
                    <div class="bookImg"
                         style="display: flex;flex-direction: column;flex-wrap: nowrap;align-items: center;justify-content: space-around;">
                        <div style="font-size: 24px;color: white;text-align: center"> {{$item->title}}</div>
                        <div style="font-size: 20px;color: black;text-align: center"> {{$item->author}}</div>
                    </div>
                @endif

                <div class="booksInfo">
                    <div class="bookTitle"> {{$item->title}}</div>
                    <div class="bookAuthor"> {{$item->author}}</div>
                    <div
                        class="bookPrice {{$item->price>0 ?' ':' free'}}"> {{$item->price>0 ? $item->price .' руб.':'Бесплатно'}} </div>
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
                            <a class="orangeLink2"
                               href="{{route('giveBooks.index',['genre'=>$genre->id])}}">{{$genre->genre_name}} </a>
                        @endforeach
                    </div>
                    <div class="bookAddress"><strong>Адрес:</strong> {{$item->address}}</div>
                    <a class="btn btn-light bookButton" href="{{route('giveBooks.aboutBook',['id'=>$item->id])}}">
                        подробнее</a>
                </div>
                <a class="bookLike" id="addToCart" data-id="{{$item->id}}">
                    <svg width="24" height="24" viewBox="0 0 24 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.33857 10.711C-0.041108 7.61463 0.752117 2.97011 4.71824 1.42194C8.68437 -0.126229 11.064 2.97011 11.8573 4.51829C12.6505 2.97011 15.8234 -0.126229 19.7895 1.42194C23.7556 2.97011 23.7556 7.61463 21.376 10.711C18.9963 13.8073 11.8573 20 11.8573 20C11.8573 20 4.71824 13.8073 2.33857 10.711Z"
                            stroke="#393280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </a>
                <div class="bookDate"> {{\Carbon\Carbon::make($item->updated_at)->diffForHumans() }}</div>

            </div>

        @endforeach
        {{ $giveBooks->links('pagination::bootstrap-4') }}
    </div>

@endsection


<script>
    $(document).ready(function (e) {
        try {
            // let items=   document.querySelectorAll('.bookLike');
            //    console.log(items.length)
            $(document).on('click', '.bookLike', function () {

                let bookId = $(this).data('id');
                let postedData = {
                    id: bookId
                }
                let url = 'https://booksswap.ru/cart/add'
                $.ajax({
                    type: 'GET',
                    url: url,
                    data: postedData,
                    dataType: 'json',
                    success: function (data) {

                        toastr.success('Книга успешно добавлена в избранное');
                    },
                    error: function () {
                        toastr.warning('Произошла ошибка. Попробуйте позже')
                    }
                });
            });
        } catch (e) {
            alert(e)
        }
        // $('addToCart').click(function (){
        //     console.log(123)
        //     let bookId=$(this).data('id');
        //     let postedData = {
        //         id: bookId
        //     }
        //     let url = 'https://booksswap.ru/cart/add'
        //     $.ajax({
        //         type: 'GET',
        //         url: url,
        //         data: postedData,
        //         dataType: 'json',
        //         success: function (data) {
        //
        //             toastr.success('Книга успешно добавлена в избранное');
        //         },
        //         error: function (){
        //             toastr.warning('Произошла ошибка. Попробуйте позже')
        //         }
        //     });
        // });
    });


</script>
<style>
    @media (max-width: 1440px) {
        .booksBlock {
            width: 1050px;
        }
    }

    .orangeLink2:hover {
        color: #ED553B;
        cursor: pointer;
        text-decoration: none;
    }

    .orangeLink2 {
        color: gray;
    }

    .add {

        margin-top: 20px;
        background: #ED553B !important;
        width: 200px;
        height: 40px;
        color: white !important;
    }

    .add:hover {
        color: black !important;
    }

    .bookAddress {

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

    .bookButton {
        background: #ED553B !important;
        color: white !important;
        margin-top: 10px;
    }

    .bookDate {
        white-space: nowrap;
        margin-top: 20px;
        margin-left: 20px;
    }

    .bookGenre {
        width: 600px;
    }

    .boxPhotos {
        z-index: 2;
        margin-bottom: 5px;
        overflow: hidden;
        width: 250px;
        height: 290px;
    }

    .boxPhotos img {
        position: absolute;
        width: 260px;
        height: 300px;
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

    .bookPrice {
        color: black;
        font-size: 26px;
    }

    .free {

    }

    .bookAuthor {
        max-width: 450px;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 26px;
        color: grey;
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
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        margin-bottom: 20px;
        border-radius: 5px;
        /*background: #28a745;*/
        display: flex;
        padding: 20px;
    }

    .booksInfo {
        margin-left: 20px;
    }

    .not-found {
        padding: 30px;
    }

    .bookImg {

        min-height: 300px;
        min-width: 250px;
        max-height: 300px;
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
        margin-bottom: 40px;
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


