<div class="headerLogos">
    <a class="headerNameLogo">BooksSwap</a>
</div>
<nav class="header">
    {{--    @dd(Request::route()->uri)--}}
{{--    @if(Auth::user() && Request::route()->uri ==='profile')--}}
        <div class="avatar" style="background: rgba(17,17,17,0) !important;"></div>

{{--    @else--}}
{{--        <div class="avatar" style="background: rgba(252,252,252,0) !important;"></div>--}}

{{--    @endif--}}
    <div class="headerCategories">

        <a href="{{url('/')}}" class="headerCategory">главная</a>


        <a href="{{route('giveBooks.index')}}" class="headerCategory">отдаю</a>
        <a href="{{route('crossing.index')}}" class="headerCategory">книговорот</a>
        <a  href="{{route('swap.index')}}" class="headerCategory">книгообмен</a>
        <a href="{{route('pages.places')}}" class="headerCategory">места</a>
        <a href="#" class="headerCategory">о нас</a>
    </div>
    <div class="headerIcons">
        <a class="headerIcon" href="{{route('profile.index')}}">
            <svg width="24" height="24" viewBox="0 0 17 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M8.5 0C5.22325 0 2.55 2.71614 2.55 6.04545C2.55 8.12682 3.5955 9.975 5.1799 11.0658C2.14795 12.3871 0 15.4444 0 19H1.7C1.7 15.1741 4.7345 12.0909 8.5 12.0909C12.2655 12.0909 15.3 15.1741 15.3 19H17C17 15.4444 14.8521 12.388 11.8201 11.0649C12.6287 10.5103 13.2913 9.76271 13.7498 8.88767C14.2082 8.01263 14.4487 7.03676 14.45 6.04545C14.45 2.71614 11.7768 0 8.5 0ZM8.5 1.72727C10.8571 1.72727 12.75 3.65059 12.75 6.04545C12.75 8.44032 10.8571 10.3636 8.5 10.3636C6.14295 10.3636 4.25 8.44032 4.25 6.04545C4.25 3.65059 6.14295 1.72727 8.5 1.72727Z"
                    fill="#393280"/>
            </svg>

        </a>
        @if(Auth::user())
            <a class="headerIcon"  href="{{route('chat.index')}}">

                <svg fill="#2F2B71" height="24px" width="24px" version="1.1" id="Capa_1"
                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                     viewBox="0 0 217.762 217.762" xml:space="preserve" stroke="#2F2B71"><g id="SVGRepo_bgCarrier"
                                                                                            stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path
                            d="M108.881,5.334C48.844,5.334,0,45.339,0,94.512c0,28.976,16.84,55.715,45.332,72.454 c-3.953,18.48-12.812,31.448-12.909,31.588l-9.685,13.873l16.798-2.153c1.935-0.249,47.001-6.222,79.122-26.942 c26.378-1.92,50.877-11.597,69.181-27.364c19.296-16.623,29.923-38.448,29.923-61.455C217.762,45.339,168.918,5.334,108.881,5.334z M115.762,168.489l-2.049,0.117l-1.704,1.145c-18.679,12.548-43.685,19.509-59.416,22.913c3.3-7.377,6.768-17.184,8.499-28.506 l0.809-5.292l-4.741-2.485C30.761,142.547,15,119.42,15,94.512c0-40.901,42.115-74.178,93.881-74.178s93.881,33.276,93.881,74.178 C202.762,133.194,164.547,165.688,115.762,168.489z"></path>
                    </g></svg>
            </a>
        @endif

        <a class="headerIcon" href="{{route('cart.index')}}">
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
        color: white !important;
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

    .headerCategory --active {
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
        width: 0px;
        height: 86px;
        background: #ffffff;
        border-radius: 43px;
        margin-left: 15%;
        /*margin-right: 124px;*/
    }

    a {
        text-decoration: none; /* Отменяем подчеркивание у ссылки */
    }


</style>
