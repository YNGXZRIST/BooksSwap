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
        <a class="btn add " href="{{route('profile.add_give.index')}}"> отдать книги</a>
    </div>

    <div class="contentWrap">

        @if(count($userGiveBooks)>0)
            <div class="userGiveBooksWrapper">
                <div>Книги,которые вы отдаете</div>

                @foreach($userGiveBooks as $item)
                    <div class="userGiveBooksContainer">
                        <img class="bookImg" src="{{asset($item->mainImage->url??'images/bookNotFound.svg')}}">

                        @endforeach
                    </div>
            </div>
        @endif
    </div>
@endsection

<style>
    .bookImg {
        width: 200px;
        height: 200px;
    }

    .userGiveBooksWrapper {
        display: flex;
        flex-wrap: wrap;
        flex-direction: row;
    }

    .container {
        display: flex;
    }

    .contentWrap {
        min-width: 80%;
        background: rgba(65, 56, 56, 0.18);
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
