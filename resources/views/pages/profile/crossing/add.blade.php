@extends('layout.index')


@section('content')
    <x-my-loader id="load" message="Еще немного..."></x-my-loader>

    <div class="addGiveBooksWrapper">
        <form action="{{route('profile.submit_crossing_books')}}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="exampleFormControlInput1" style="text-align: center">Автор книги</label>
                <input required type="text" class="form-control" id="exampleFormControlInput1" name="bookAuthor"
                       placeholder="Джордж Мартин">
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput2" style="text-align: center">Название книги</label>
                <input required type="text" class="form-control" id="exampleFormControlInput2" name="bookName"
                       placeholder="Песнь льда и пламени">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">ISBN</label>
                <input  type="text" class="form-control" id="exampleFormControlTextarea1" name="bookISBN"
                       placeholder="номер книги с обратной стороны,если есть">
            </div>
            <div class="form-group">
                <label for="status">Статус книги</label>
                <select class="form-select" name="status">
                    <option value="1" selected>Оставил книгу</option>
{{--                    <option value="2">Нашел книгу</option>--}}
                    <option value="3">Взял книгу</option>
                </select>
            </div>

            <div class="form-group" >
                <label for="city">город</label>
                <div class="select_wrp">
                    <select class="js-select2" name="city">
                        @foreach(\App\Models\Cities::select('id','name')->get() as $city)
                            <option value="{{$city->name}}">{{$city->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Местонахождение</label>
                <input required type="text" class="form-control" id="exampleFormControlTextarea1" name="bookLocation"
                       placeholder="место,где нашли или оставили книгу">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Описание местонахождения</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" name="descriptionPlaces" rows="3"
                          placeholder="опишите подробнее, где взяли или положили книгу, чтобы помочь единомышленникам ее найти как можно скорее"></textarea>
            </div>
            <div class="form-group">
                <label for="bookCover">Обложка книги</label>
            <div class="custom-file" style="margin-bottom: 40px">
                <input type="file" class="custom-file-input" id="bookCover" name="bookCover" accept=".jpg, .jpeg, .png">
                <label class="custom-file-label" for="bookCover">Выберите файл</label>
            </div>
            </div>

            <button type="submit" class="btn submitBtn " >Опубликовать</button>
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
        height: 38px !important;
    }

    .js-select2 {
        width: 715px;
        height: 38px;
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
        $('.my-loader').hide();
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });

    });


</script>
