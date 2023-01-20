@extends('layout.index')
@section('content')
    <div class="registrationWrapper">
        <div class="registrationTitle">Присоединяйтесь к буккроссингу
        </div>
        <form action="{{route('register.registration')}}" method="get">
            @csrf
            <div class="form-group">
                <label for="email" class="registrationLabel">Адрес электронной почты</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"
                       placeholder="booksswap@booksswap">
            </div>
            <div class="form-group">
                <label for="username" class="registrationLabel">Имя пользователя</label>
                <input type="text" class="form-control" name="username" id="exampleName" placeholder="Иванов Иван">

            </div>
            <div class="form-group">
                <label for="password" class="registrationLabel">Пароль</label>
                <input type="password" name="password" class="form-control" id="password" placeholder="********">
            </div>
            <button type="submit" class="btn registrationButton">Зарегистрироваться</button>
        </form>
    </div>
    <div class="authWrapper">
        <div>Уже зарегистрированы?</div>
        <a class="authLink">
            Войти
        </a>
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
