@extends('layout.index')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

@section('content')
    <div class="container">
        <div class="leftMenu">
            <img class="avatarProfile"
                 src="{{ Auth::user()->getMedia('avatars')->first() ? $avatar->getUrl('thumb') : asset('images/avatars/empty_avatar.png')}}"
                 alt="avatar">
            <div class="userName">{{$user->name??''}}</div>

        </div>
    </div>

    <div class="contentWrap">
        <div style="display: flex;justify-content: space-around;align-items: flex-start">

            @if(count($userGiveBooks)>0)
                <div class="userGiveBooksWrapper">
                    <div style="font-size: 36px;margin-bottom: 20px"> Книги,которые вы отдаете</div>
                    @foreach($userGiveBooks as $item)
                        <div class="booksBlock" data-id="{{$item['id']}}">
                            @if(isset($item->mainImage->url))
                                <div class='boxPhotos'>
                                    <img class="{{isset($item->mainImage->url)?'':' "bookImg not-found'}}"
                                         src="{{asset($item->mainImage->url??'images/bookNotFound.svg')}}">
                                </div>
                            @else
                                <div class="bookImg"
                                     style="display: flex;flex-direction: column;flex-wrap: nowrap;align-items: center;justify-content: space-around;">
                                    <div
                                        style="font-size: 24px;color: white;text-align: center"> {{$item['title']}}</div>
                                    <div
                                        style="font-size: 20px;color: black;text-align: center"> {{$item['author']}}</div>
                                </div>
                            @endif

                            <div class="booksInfo">
                                <div class="bookTitle"> {{$item['title']}}</div>
                                <div class="bookAuthor"> {{$item['author']}}</div>
                                <div
                                    class="bookPrice {{$item['price']>0 ?' ':' free'}}"> {{$item['price']>0 ? $item['price'] .' руб.':'Бесплатно'}} </div>
                                @switch($item['condition'])
                                    @case(1<=$item['condition'] && $item['condition']<5)
                                        <div class="conditionText redCondition">{{$item['condition']}} / 10</div>
                                        @break
                                    @case(5<=$item['condition'] && $item['condition']<8)
                                        <div class="conditionText yellowCondition">{{$item['condition']}} / 10</div>
                                        @break
                                    @case(8<=$item['condition'])
                                        <div class="conditionText greenCondition">{{$item['condition']}} / 10</div>
                                        @break
                                @endswitch
                                <div class="bookAddress"><strong>Адрес:</strong> {{$item['address']}}</div>
                                <div style="display: flex;flex-wrap: nowrap">
                                    <a class="btn btn-light bookButton"
                                       href="{{route('giveBooks.aboutBook',['id'=>$item['id']])}}">
                                        подробнее</a>
                                    <a class="btn btn-light bookButton"
                                       href="{{route('profile.add_give.index',['id'=>$item['id']])}}">
                                        обновить</a>
                                    <a class="btn btn-light bookButton deleteBook" data-id="{{$item['id']}}">
                                        удалить</a>
                                </div>


                            </div>

                            {{--                            <div class="bookDate"> {{\Carbon\Carbon::make($item['updated_at'])->diffForHumans() }}</div>--}}

                        </div>

                    @endforeach
                </div>

            @endif
            @if(count($userSwap)>0)

                <div class="swapsWrapper">
                    <div style="font-size: 36px;margin-bottom: 20px"> Ваши обмены</div>
                    @foreach($userSwap as $trade)
                        <div class="trade" data-id="{{$trade['id']}}">
                            <div>
                                {{--                            <div style="color: black;display: flex;margin-bottom: 20px;justify-content: space-between">--}}
                                {{--                                <div style="color: black">--}}
                                {{--                                    {{\Carbon\Carbon::make($trade['updated_at'])->diffForHumans()}}--}}
                                {{--                                </div>--}}
                                {{--                            </div>--}}

                                <div style="display: flex;align-items: center;">
                                    <div class="imageTradeGive" style="margin-right: 10px">

                                        <div style="color: white;font-size: 24px;text-align: center;font-weight: bold">
                                            {{$trade['given_book_author']	}}
                                        </div>

                                        <div style="color: black;font-size: 20px;text-align: center;">
                                            {{$trade['given_book_name']	}}
                                        </div>

                                    </div>
                                    <img src="{{asset('images/swaps/exchange.png')}}"
                                         style="width: 100px;height: 100px;">
                                    <div class="imageTradeDesired">
                                        @if(isset($trade['desired_book_author']) )
                                            <div
                                                style="color: white;font-size: 24px;text-align: center;font-weight: bold">
                                                {{$trade['desired_book_author']	}}
                                            </div>
                                        @endif
                                        @if(isset($trade['desired_book_name']) )
                                            <div style="color: black;font-size: 20px;text-align: center">
                                                {{$trade['desired_book_name']	}}
                                            </div>
                                        @endif
                                        @if(!isset($trade['desired_book_author']) && !isset($trade['desired_book_name']))
                                            <img src="{{asset('images/swaps/mystery2.svg')}}"
                                                 style="width: 100px;height: 100px;">

                                        @endif

                                    </div>

                                </div>
                                <div style="margin-left: 25%">
                                    <a class="btn btn-light bookButton"
                                       href="{{route('swap.about',['id'=>$trade['id']])}}">
                                        подробнее</a>
                                    <a class="btn btn-light bookButton"
                                       href="{{route('profile.swap_add',['id'=>$trade['id']])}}">
                                        обновить</a>
                                    <a class="btn btn-light bookButton deleteTrade" data-id="{{$trade['id']}}">
                                        удалить</a>
                                </div>

                            </div>


                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    </div>
@endsection

<style>
    a {
        text-decoration: none !important;
    }

    a:hover {
        text-decoration: none !important;
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
        color: white
    }

    .giveBooksText {
        font-size: 24px;
        max-width: 60%;
    }

    .trade {
        align-items: center;

        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        margin-bottom: 20px;
        border-radius: 5px;
        min-height: 400px;
        /*background: #28a745;*/
        display: flex;
        padding: 20px;
        justify-content: space-around;
        width: 110%;
        max-height: 400px;
    }

    .swapsWrapper {
        width: 600px;

        display: flex;
        justify-content: center;
        flex-direction: column;
        flex-wrap: nowrap;
        align-items: center;
    }

    .swapInfo {
        color: gray;
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

    .orangeLink2:hover {
        color: #ED553B;
        cursor: pointer;
        text-decoration: none;
    }

    .orangeLink2 {
        color: gray;
    }

    .bookAddress {

        line-height: 1.5em;
        height: 3em;
        overflow: hidden;
        white-space: pre-wrap;
        text-overflow: ellipsis;
        max-width: 150px;
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
        margin-left: -33px;
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
        max-width: 140px;
        font-size: 24px;
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
        width: 100%;
        min-height: 400px;
        max-height: 400px;
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

    .bookImg {
        width: 200px;
        height: 200px;
    }

    .userGiveBooksWrapper {
        display: flex;
        flex-wrap: wrap;
        flex-direction: column;
        align-items: center;
        width: 600px;
    }

    .container {
        display: flex;
    }

    .contentWrap {
        min-width: 80%;
    }

    .add {

        margin-top: 20px;
        background: #ED553B !important;
        width: 200px;
        height: 40px;
    }

    .add:hover {
        color: white;
    }

    .leftMenu {
        display: flex;
        flex-direction: column;
        width: 300px;
        margin: 20px;
        align-items: center;
    }

    .avatarProfile {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin: auto;
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

    .userName {
        font-size: 30px;
        text-align: center;
    }

    .updateAvatar {
        width: 100px;
        margin-top: 20px;
    }

    .updateAvatar .btn-tertiary {
        color: #555;
        padding: 0;
        line-height: 40px;
        width: 300px;
        margin: auto;
        display: block;
        border: 2px solid #555
    }

    .updateAvatar.btn-tertiary:hover, .updateAvatar .btn-tertiary:focus {
        color: #888;
        border-color: #888
    }

    .updateAvatar .input-file {
        width: .1px;
        height: .1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1
    }

    .updateAvatar .input-file + .js-labelFile {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        padding: 0 10px;
        cursor: pointer
    }

    .updateAvatar .input-file + .js-labelFile .icon:before {
        content: "\f093"
    }

    .updateAvatar .input-file + .js-labelFile.has-file .icon:before {
        content: "\f00c";
        color: #5AAC7B
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.3.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<script>
    $(document).on('click', '.deleteBook', function () {

        let bookId = $(this).data('id');
        alert(bookId)
        let postedData = {
            id: bookId
        }
        let url = 'https://booksswap.ru/profile/giveBooks/remove'
        $.ajax({
            type: 'GET',
            url: url,
            data: postedData,
            dataType: 'json',
            success: function (data) {

                toastr.success('Книга успешно удалена');
                $('.booksBlock').filter(`[data-id="${bookId}"]`).remove();
            },
            error: function () {
                toastr.warning('Произошла ошибка. Попробуйте позже')
            }
        });
    });
    $(document).on('click', '.deleteTrade', function () {

        let bookId = $(this).data('id');
        alert(bookId)
        let postedData = {
            id: bookId
        }
        let url = 'https://booksswap.ru/profile/swap/remove'
        $.ajax({
            type: 'GET',
            url: url,
            data: postedData,
            dataType: 'json',
            success: function (data) {

                toastr.success('Книгообмен успешно удален');
                $('.trade').filter(`[data-id="${bookId}"]`).remove();
            },
            error: function () {
                toastr.warning('Произошла ошибка. Попробуйте позже')
            }
        });
    });
</script>
