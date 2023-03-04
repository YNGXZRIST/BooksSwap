<div class="mainPageBanner">
    <div class="wrapperPage">
    <div>
        <div class="mainPageBannerTitle">
            Подарите книгам
            новую жизнь
        </div>

        <div class="mainPageBannerText">
            Ищите книги на полках города или отдавайте свои,
            чтобы их мог прочитать любой желающий

        </div>
        <div class="buttonMainPageWrapper">
            <a class="btn registerButton" href="{{route('register.index')}}">Стать участником</a>
            <button class="btn findButton">Найти книги</button>
        </div>
    </div>
        <img src="{{asset('/storage/images/woman_main.svg')}}" style="width: 300px;height: 300px;">
</div>

</div>
<style>
.wrapperPage{
    display: flex;
    align-items: center;
}
    .mainPageBanner {
        width: 80%;
        height: 450px;
        margin: auto;
        border-radius: 5px;
        /*background: url("https://1rulon.ru/wp-content/uploads/43529.jpg");*/
        /*background: rgb(27, 128, 148);*/
        background: linear-gradient(90deg, rgb(48, 180, 201) 0%, rgba(27, 128, 148, 1) 40%, rgb(26, 189, 171) 66%);
        background-size: 400% 400%;
        animation: gradient 10s ease infinite;
        transform: translate3d(0, 0, 0);
        display: flex;
        flex-direction: column;
        padding: 40px;
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
    .buttonMainPageWrapper {
        margin-top: 20px;

    }

    .mainPageBannerText {
        font-size: 34px;
        width: 100%;
        color: white;
    }

    .mainPageBannerTitle {
        font-size: 54px;

    }

    .registerButton {
        background-color: #ED553B !important;
        color: white;
    }

    .findButton {
        background: white !important;
    }
</style>
