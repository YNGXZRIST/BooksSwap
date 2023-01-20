@extends('layout.index')
@section('content')
    <div class="registrationWrapper">
        <div class="registrationTitle">Почти готово!
        </div>
        <div class="registrationText">Введите код,отправленный вам на почту</div>
        <form
            action="{{route('register.confirmCode')}}" method="post">
            @csrf
            <div class="form-group">

                <input type="text" class="form-control" id="code" name="code" aria-describedby="emailHelp">
            </div>
            <button type="submit" class="btn registrationButton">Подтвердить</button>
        </form>
    </div>

@endsection
<style>
    .authWrapper {
        text-align: center;
        display: flex;
        flex-direction: row;
        margin: auto;
        width: 30%;
        /*height: 100px;*/
        /*background-color: #ED553B;*/
        /*padding: 20%;*/
        margin-top: 20px;
        /*background: linear-gradient(90deg, #25aac9, #2cc5c7, #23a6d5, #23d5ab);*/
        /*background-size: 400% 400%;*/
        /*animation: gradient 10s ease infinite;*/
        /*transform: translate3d(0, 0, 0);*/
    }

    .registrationTitle {
        font-size: 36px;
        text-align: center;
        margin-bottom: 20px;
    }
    .registrationText{
        font-size: 24px;
        text-align: center;
        margin-bottom: 20px;
    }

    .registrationWrapper {
        display: flex;
        justify-content: center;
        margin: auto;
        width: 30%;
        height: 600px;
        align-items: center;
        flex-direction: column;
        border-radius: 5px;
        background: linear-gradient(90deg, #25aac9, #2cc5c7, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 10s ease infinite;
        transform: translate3d(0, 0, 0);
    }
    .authLink:hover{
        color: #ED553B !important;
        cursor: pointer;
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

    .registrationLabel {
        font-size: 24px;
    }

    .registrationButton {
        margin-top: 20px;
        background-color: #ED553B !important;
        width: 100%;
        font-size: 24px;
    }
</style>
