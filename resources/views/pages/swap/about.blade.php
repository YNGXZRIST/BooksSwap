@extends('layout.index')
@section('content')
    <div class="aboutSwapWrapper">
        <div style="display: flex">
            <div style="display: flex;flex-direction: column">
                <div class="imageTradeGive">
                    <div style="color: white;font-size: 36px;text-align: center;font-weight: bold">
                        {{$swap->given_book_author	}}
                    </div>
                    <div style="color: black;font-size: 28px;text-align: center;">
                        "{{$swap->given_book_name}}"
                    </div>
                </div>
                @if(\Illuminate\Support\Facades\Auth::user())
                    <button id="addSwap" class="btn messageButton"  data-bs-toggle="modal" data-bs-target="#myModal" style="font-size: 24px" >Предложить обмен</button>

                @endif
            </div>


            <div style="display: flex;justify-content: space-evenly;flex-direction: column">
                <div style="display: flex;align-items: center">
                    <div style="color: gray;font-size: 28px;text-align: center;margin-right: 20px">
                        Опубликовано
                    </div>
                    <div style="font-size: 24px;text-align: center">
                        {{\Carbon\Carbon::make($swap->updated_at)->diffForHumans()}}
                    </div>
                </div>
                <div style="display: flex;align-items: center">
                    <div style="color: gray;font-size: 28px;text-align: center;margin-right: 40px">
                        Город:
                    </div>
                    <div style="font-size: 24px;text-align: center">
                        {{$swap->city->name}}
                    </div>
                </div>
                @if(isset($swap->desired_book_author))
                <div style="display: flex;align-items: center">
                    <div style="color: gray;font-size: 28px;text-align: center;margin-right: 40px">
                        Желаемая книга:
                    </div>
                    <div style="font-size: 24px;text-align: center">
                        "{{$swap->desired_book_author}}"
                        @if(isset($swap->desired_book_name))
                            - "{{$swap->desired_book_name}}"
                        @endif
                    </div>
                </div>
                @endif
                <div style="display: flex; align-items: flex-end">
                    <div style="color: gray;font-size: 28px;text-align: center;margin-right: 40px">
                        Опубликовал:
                    </div>
                    <div style="font-size: 24px;text-align: center">
                        {{ ($swap->user->name??'' )}}
                    </div>
{{--                    class="btn messageButton"--}}
                    @if(\Illuminate\Support\Facades\Auth::user())

                    <img src="https://booksswap.ru/public/images/message.png" id="chatCreate" class="sendIcon" style="margin-left: 20px;white-space: nowrap">
                    @endif
                </div>
                @if(isset($swap->given_book_description))
                    <div style="display: flex;align-items: flex-start">
                        <div style="color: gray;font-size: 28px;text-align: center;margin-right: 40px">
                            Описание:
                        </div>
                        <div style="font-size: 24px;text-align: center">
                            {{$swap->given_book_description}}
                        </div>
                    </div>
                @endif

            </div>


        </div>

    </div>
    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header" style="border: none !important; border-bottom: 0 !important;">
{{--                    <h5 class="modal-title" id="exampleModalLabel">Модальное окно с формой</h5>--}}
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Форма -->
                    <form>
                        <div class="mb-3">
                            <textarea class="form-control" id="swapBookInfo" rows="4" name="swapBookMessage" placeholder="Введите название и автора книги,которую хотите предложить. При желании,введите дополнительное сообщение"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border: none !important; border-bottom: 0 !important;">
{{--                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>--}}
                    <button type="button" class="btn messageButton" id="sendOffer" style="margin: 0 auto" >Отправить</button>
                </div>
            </div>
        </div>
    </div>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    @if(\Illuminate\Support\Facades\Auth::user())
        <meta name="senderId" content="{{ \Illuminate\Support\Facades\Auth::user()->id}}" />
    @endif
    <meta name="recieverId" content="{{ $swap->user->id}}" />
    <meta name="bookName" content="{{$swap->given_book_author .' - " ' . $swap->given_book_name. ' "' }}" />

@endsection
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<script src="https://unpkg.com/tippy.js@6"></script>
<style>
    .sendIcon{
        width: 40px;
        height: 40px;
    }
    .sendIcon:hover{
        transform: scale(1.4);
        cursor: pointer;
        transition-duration: 0.3s;
    }
    .messageButton {
        margin-top: 20px;
        width: 400px;
        background-color: #ED553B !important;

        color: white !important;
        font-size: 12px;
    }
    .messageButton:hover{
        color: black !important;
    }
    .imageTradeGive {
        margin-right: 40px;
        overflow: hidden;
        text-overflow: ellipsis;
        min-width: 400px;
        min-height: 500px;
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

    .aboutSwapWrapper {
        margin-top: 40px;
        display: flex;
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

<script>
    $(document).ready(function () {
        let recieverId =$('meta[name="recieverId"]').attr('content')
        let senderId=$('meta[name="senderId"]').attr('content');
        let bookName=$('meta[name="bookName"]').attr('content');
        $( "#chatCreate" ).on( "click", function() {

            if(senderId===undefined|| senderId===null){
                window.location.href='https://booksswap.ru/registration';
                return;
            }
            let postedData = {
                'content': 'Привет,меня заинтересовал обмен книги ' +bookName,
                'receiver': recieverId,
                'sender':    senderId,
            }
            let url = 'https://booksswap.ru/chat/send-message';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                url: url,
                data: postedData,
                dataType: 'json',
                success: function (data) {
                location.href='https://booksswap.ru/chat/#'+ recieverId;
                }

            });
        });
        $('#sendOffer').on('click',function (event){
            let formData = $('#swapBookInfo').val();
         if(formData.length>0){
             if(senderId===undefined|| senderId===null){
                 window.location.href='https://booksswap.ru/registration';
                 return;
             }
             let url = 'https://booksswap.ru/chat/send-message';

             let postedData = {
                 'content': 'Привет,меня заинтересовал обмен книги ' +bookName + '. Предлагаю ' + formData,
                 'receiver': recieverId,
                 'sender':    senderId,
             }
             $.ajax({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
                 type: 'POST',
                 url: url,
                 data: postedData,
                 dataType: 'json',
                 success: function (data) {
                     location.href='https://booksswap.ru/chat/#'+ recieverId;
                 }

             });
         }else{
             toastr.warning('Введите сообщение')

         }

        })

    });
</script>
