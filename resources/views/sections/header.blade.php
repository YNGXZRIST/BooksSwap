
<div class="headerLogos">
    <a class="headerNameLogo">BooksSwap</a>
</div>
<nav class="header">
{{--@dd(Request::url())--}}
    <div class="avatar"></div>
    <div class="headerCategories">
{{--        @dd(Request::url())--}}
            <a href="{{url('/')}}" class="headerCategory">главная</a>
{{--            @if(Request::url() === 'find')--}}
{{--                <a href="#" class="headerCategory">ищу</a>--}}
{{--            @endif--}}

        <a href="#" class="headerCategory">отдаю</a>
        <a href="#" class="headerCategory">книги</a>
        <a href="{{route('pages.places')}}" class="headerCategory">места</a>
        <a href="#" class="headerCategory">о нас</a>
    </div>
    <div class="headerIcons">
        <a class="headerIcon">
            <svg width="24" height="24" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.5 0C5.22325 0 2.55 2.71614 2.55 6.04545C2.55 8.12682 3.5955 9.975 5.1799 11.0658C2.14795 12.3871 0 15.4444 0 19H1.7C1.7 15.1741 4.7345 12.0909 8.5 12.0909C12.2655 12.0909 15.3 15.1741 15.3 19H17C17 15.4444 14.8521 12.388 11.8201 11.0649C12.6287 10.5103 13.2913 9.76271 13.7498 8.88767C14.2082 8.01263 14.4487 7.03676 14.45 6.04545C14.45 2.71614 11.7768 0 8.5 0ZM8.5 1.72727C10.8571 1.72727 12.75 3.65059 12.75 6.04545C12.75 8.44032 10.8571 10.3636 8.5 10.3636C6.14295 10.3636 4.25 8.44032 4.25 6.04545C4.25 3.65059 6.14295 1.72727 8.5 1.72727Z"
                    fill="#393280"/>
            </svg>

        </a>
        <a class="headerIcon">
            <svg width="24" height="24" viewBox="0 0 24 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M2.33857 10.711C-0.041108 7.61463 0.752117 2.97011 4.71824 1.42194C8.68437 -0.126229 11.064 2.97011 11.8573 4.51829C12.6505 2.97011 15.8234 -0.126229 19.7895 1.42194C23.7556 2.97011 23.7556 7.61463 21.376 10.711C18.9963 13.8073 11.8573 20 11.8573 20C11.8573 20 4.71824 13.8073 2.33857 10.711Z"
                    stroke="#393280" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </a>
    </div>


</nav>
<style>

    .headerLogos {
        text-align: center;
        width: 100%;
        height: 56px;
        background: #1b8094;
        color: aliceblue;
    }

    .headerNameLogo {
        font-size: 36px;
    }

    .headerCategory {
        /*margin-right: 15px;*/
        font-size: 22px;
        padding-left: 10px;
        padding-right: 10px;
        border-left: 2px solid black;
        color: #111111;
    }
    .headerCategory --active{
        color: #ED553B;
    }

    .headerIcons {
        display: flex;
        margin-right: 62px;
    }

    .headerIcon {
        border-right: 2px solid black;
        margin-right: 50px;
        padding-right: 50px;
    }

    .headerIcon {
        cursor: pointer;
    }

    .headerIcon:last-child {
        margin-right: -62px;
        border: none;
    }

    .headerCategory:first-child {
        margin-left: 62px;
        border: none;
    }

    .headerCategory:last-child {
        margin-right: 0px;
    }

    .headerCategory:hover {
        color: #ED553B;
        text-decoration: none;
    }

    .headerCategories {
        display: flex;
    }


    .header {
        margin-top: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .avatar {
        width: 86px;
        height: 86px;
        background: #C4C4C4;
        border-radius: 43px;
        margin-left: 62px;
    }

    a {
        text-decoration: none; /* Отменяем подчеркивание у ссылки */
    }


</style>
