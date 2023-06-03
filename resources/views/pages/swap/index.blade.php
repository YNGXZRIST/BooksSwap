@extends('layout.index')

@section('content')
    @if(session('isSave'))
        <input type="hidden" id="isSave" value="true">
    @endif


    @if(\Illuminate\Support\Facades\Auth::user())
        <div style="display: flex; justify-content: flex-end">
            <button id="addSwap" class="btn addButton">Предложить обмен</button>
        </div>
    @endif
    <div class="giveBooksWrapper" style="margin-top: 20px">
        <div class="giveBooksBanner">
            <div class="giveBooksTextBanner">
                <div class="giveBooksTitle">
                    Обменивайтесь книгами
                </div>
                <div class="giveBooksText"> с другими пользователями
                </div>
            </div>

            <img src="{{asset('images/swaps/swap_gif.svg')}}" style="width: 280px;height: 280px">
        </div>

    </div>
    <div style="display: flex; justify-content: center">
        <div class="swapInfo" style="margin-top: 20px"> Этот раздел предназначен для обмена книгами между пользователями. <br>
            Здесь вы можете разместить информацию о книгах, которые вы готовы отдать другим, а также найти книги,
            которые вы хотели бы прочитать.
        </div>
    </div>

    <div class="swapsWrapper">
        @foreach($trades as $trade)
            <a href="{{route('swap.about',['id'=>$trade->id])}}" class="trade">
                <div>
                    <div style="color: black;display: flex;margin-bottom: 20px;justify-content: space-between">
                        <div>
                            {{$trade->city->name}}
                        </div>

                        <div style="color: black">
                            {{\Carbon\Carbon::make($trade->updated_at)->diffForHumans()}}
                        </div>
                    </div>

                    <div style="display: flex;align-items: center;">
                        <div class="imageTradeGive" style="margin-right: 10px">

                            <div style="color: white;font-size: 24px;text-align: center;font-weight: bold">
                                {{$trade->given_book_author	}}
                            </div>

                            <div style="color: black;font-size: 20px;text-align: center;">
                                {{$trade->given_book_name	}}
                            </div>

                        </div>
                        <img src="{{asset('images/swaps/exchange.png')}}" style="width: 200px;height: 200px;">
                        <div class="imageTradeDesired">
                            @if(isset($trade->desired_book_author) )
                                <div style="color: white;font-size: 24px;text-align: center;font-weight: bold">
                                    {{$trade->desired_book_author	}}
                                </div>
                            @endif
                            @if(isset($trade->desired_book_name) )
                                <div style="color: black;font-size: 20px;text-align: center">
                                    {{$trade->desired_book_name	}}
                                </div>
                            @endif
                            @if(!isset($trade->desired_book_author) && !isset($trade->desired_book_name))
                                <img src="{{asset('images/swaps/mystery2.svg')}}" style="width: 200px;height: 200px;">

                            @endif

                        </div>
                    </div>
                </div>


            </a>
        @endforeach
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
        width: 1000px;
        box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2);
        margin-bottom: 20px;
        border-radius: 5px;
        min-height: 300px;
        /*background: #28a745;*/
        display: flex;
        padding: 20px;
        justify-content: space-around;
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

</style>

<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="https://unpkg.com/@popperjs/core@2"></script>

<script>
    // tippy(document.querySelectorAll('.bookLike'),{
    //     content: '123',
    // });
    $(document).ready(function () {
        $('#addSwap').on("click", function () {
            window.location.href = 'https://booksswap.ru/profile/swap/add';
        });
        if ($('#isSave').length) {
            toastr.success('Обмен успешно добавлен');
            // Выполнение JS кода с использованием user_id
        }
    });

</script>
