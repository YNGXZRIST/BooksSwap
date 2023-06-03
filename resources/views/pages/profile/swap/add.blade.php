@extends('layout.index')


@section('content')

    <div class="addGiveBooksWrapper">
        <form action="{{route('profile.submit_swap_books')}}" method="post" enctype="multipart/form-data">
            @csrf
            <h2 style="text-align: center">Книга,которую отдаю</h2>
            <div class="form-group">
                <label for="exampleFormControlInput1" style="text-align: center">Автор книги</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="bookAuthor"
                       placeholder="Джордж Мартин"
                       @if(isset($swapUpdate) && isset($swapUpdate->given_book_author))
                           value="{{$swapUpdate->given_book_author}}"
                    @endif
                >
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput2" style="text-align: center">Название книги</label>
                <input type="text" class="form-control" id="exampleFormControlInput2" name="bookName"
                       placeholder="Песнь льда и пламени"
                       @if(isset($swapUpdate) && isset($swapUpdate->given_book_name))
                           value="{{$swapUpdate->given_book_name}}"
                    @endif
                >
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Описание вашей книги</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3">@if(isset($swapUpdate) && isset($swapUpdate->given_book_description)){{$swapUpdate->given_book_description}}@endif
                </textarea>
            </div>
            <h2 style="text-align: center">Книга,которую хочу</h2>
            <div class="form-group">
                <label for="exampleFormControlInput1" style="text-align: center">Автор книги</label>
                <input type="text" class="form-control" id="exampleFormControlInput1" name="bookAuthor2"
                       placeholder="Джордж Мартин"
                       @if(isset($swapUpdate) && isset($swapUpdate->desired_book_author))
                           value="{{$swapUpdate->desired_book_author}}"
                    @endif>
            </div>
            @if(isset($swapUpdate) && isset($swapUpdate->id))
                <input id="swapUpdateId" name="swapUpdateId" type="hidden" value="{{$swapUpdate->id}}">
            @endif
            <div class="form-group">
                <label for="exampleFormControlInput2" style="text-align: center">Название книги</label>
                <input type="text" class="form-control" id="exampleFormControlInput2" name="bookName2"
                       placeholder="Песнь льда и пламени"
                       @if(isset($swapUpdate) && isset($swapUpdate->desired_book_name))
                           value="{{$swapUpdate->desired_book_name}}"
                    @endif>
            </div>

            <div class="form-group" style="margin-bottom: 40px">
                <h2 style="text-align: center;margin-bottom: 20px">Ваш город</h2>
                <div class="select_wrp">
                    <select class="js-select2" name="city">
                        @foreach(\App\Models\Cities::select('id','name')->get() as $city)
                            <option value="{{$city->name}}"
                                    @if(isset($swapUpdate) && isset($swapUpdate->city_id) && $swapUpdate->city_id == $city->id)
                                     selected
                                @endif
                            >{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <button type="submit" class="btn submitBtn ">Опубликовать</button>

        </form>
    </div>

@endsection
<style>
    .select2-selection--single {
        height: 38px !important;
    }

    .submitBtn {
        background: #ED553B !important;
        color: white !important;
        margin: 0 auto !important;
        display: block !important;
    }

    .select_wrp {
        width: 300px;
        height: 28px;
    }

    .js-select2 {
        width: 715px;
        height: 28px;
    }

    .swapInfo {
        color: gray;
        font-size: 24px;
        text-align: center;
    }

    .addGiveBooksWrapper {
        margin: auto;
        padding: 100px;
        width: 60%;
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

    .select2-selection {
        height: 38px;
        border-radius: 4px;
    }
</style>
<script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>
<script defer src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function () {
        try {
            $('.js-select2').select2({
                // placeholder: "Выберите город",
                maximumSelectionLength: 2,
                language: "ru",
                tags: true
            });
        } catch (e) {
            alert(e)
        }
    });
    // window.addEventListener('DOMContentLoaded',function (){
    //     $('.js-select2').select2({
    //         placeholder: "Выберите город",
    //         maximumSelectionLength: 2,
    //         language: "ru"
    //     });
    // },false);
    //     $(document).ready(function() {
    //     $('.js-select2').select2({
    //         placeholder: "Выберите город",
    //         maximumSelectionLength: 2,
    //         language: "ru"
    //     });
    // });
    // function autocompleteCity() {
    //
    //     let input = document.getElementById('city');
    //     let datalist = document.getElementById('cities');
    //     let xhr = new XMLHttpRequest();
    //     xhr.onreadystatechange = function() {
    //         if (xhr.readyState === 4 && xhr.status === 200) {
    //
    //             var cities = JSON.parse(xhr.responseText);
    //             datalist.innerHTML = "";
    //             console.log(cities)
    //             cities.forEach(function(city) {
    //                 let option = document.createElement("option");
    //                 option.value = city;
    //                 datalist.appendChild(option);
    //             });
    //         }
    //     };
    //
    //     xhr.open("GET", "/getCities/" + input.value, true);
    //     xhr.send();
    // }


</script>
