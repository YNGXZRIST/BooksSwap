@extends('layout.index')

<div class="mainPageBanner">
    <div class="mainPageBannerTitle">
        Подарите книгам
        новую жизнь
    </div>
    <div class="mainPageBannerText">
        Ищите книги на полках города или отдавайте свои,
        чтобы их мог прочитать любой желающий
    </div>
    <div class="buttonMainPageWrapper">
        <button class="btn --registerButton">Стать участником</button>
        <button class="btn --findButton">Найти книги</button>
    </div>

</div>

<style>

    .mainPageBanner {
        width: 80%;
        height: 490px;
        margin: auto;
        border-radius: 5px;
        /*background: url("https://1rulon.ru/wp-content/uploads/43529.jpg");*/
        /*background: rgb(27,128,148);*/
        background:linear-gradient(90deg, rgba(27,128,148,1) 0%, rgba(27,128,148,1) 40%, rgba(85,128,124,1) 66%);
        display: flex;
        flex-direction: column;
        padding: 40px;
    }

    .buttonMainPageWrapper {
        margin-top: auto;

    }

    .mainPageBannerText {
        font-size: 34px;
        width: 50%;
        color: white;
    }

    .mainPageBannerTitle {
        font-size: 54px;

    }

    .--registerButton {
        background: #ED553B;
    }
    .--findButton{
        background: white;
    }
</style>
