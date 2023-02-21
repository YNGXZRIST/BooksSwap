
    <script>
        // Ignore this in your implementation
        window.isMbscDemo = false;
    </script>


    <script src="https://code.jquery.com/jquery-1.11.2.min.js"></script>

    <!-- Mobiscroll JS and CSS Includes -->
    <link rel="stylesheet" href="{{asset('css/mobiscroll.jquery.min.css')}} ">
    <script src="{{asset('js/mobiscroll.jquery.min.js')}}"></script>

    <style type="text/css">


        button {
            display: inline-block;
            margin: 5px 5px 0 0;
            padding: 10px 30px;
            outline: 0;
            border: 0;
            cursor: pointer;
            background: #5185a8;
            color: #fff;
            text-decoration: none;
            font-family: arial, verdana, sans-serif;
            font-size: 14px;
            font-weight: 100;
        }

        input {
            width: 100%;
            margin: 0 0 5px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 0;
            font-family: arial, verdana, sans-serif;
            font-size: 14px;
            box-sizing: border-box;
            -webkit-appearance: none;
        }

        .mbsc-page {
            /*padding: 1em;*/
        }


    </style>


{{--<div mbsc-page class="demo-multiple-select form-group" style="max-height: 200px">--}}
{{--    <div  class="form-group">--}}
{{--        <label>Поджанр книги</label>--}}
{{--        <label>--}}
{{--            <input mbsc-input id="demo-multiple-select-input"  data-dropdown="true" data-input-style="outline" data-label-style="stacked" data-tags="true" />--}}
{{--        </label>--}}
{{--        <select class="form-control" id="demo-multiple-select" multiple>--}}
{{--            <option value="1">Books</option>--}}
{{--            <option value="2">Movies, Music & Games</option>--}}
{{--            <option value="3">Electronics & Computers</option>--}}
{{--            <option value="4">Home, Garden & Tools</option>--}}
{{--            <option value="5">Health & Beauty</option>--}}
{{--            <option value="6">Toys, Kids & Baby</option>--}}
{{--            <option value="7">Clothing & Jewelry</option>--}}
{{--            <option value="8">Sports & Outdoors</option>--}}
{{--        </select>--}}
{{--    </div>--}}
{{--</div>--}}

<script>

    mobiscroll.setOptions({
        locale: mobiscroll.localeRu,                                             // Specify language like: locale: mobiscroll.localePl or omit setting to use default
        // theme: 'ios',                                                            // Specify theme like: theme: 'ios' or omit setting to use default
        themeVariant: 'light'                                                // More info about themeVariant: https://docs.mobiscroll.com/5-22-0/select#opt-themeVariant
    });

    $(function () {
        // Mobiscroll Select initialization
        $('#demo-multiple-select').mobiscroll().select({
            inputElement: document.getElementById('demo-multiple-select-input')  // More info about inputElement: https://docs.mobiscroll.com/5-22-0/select#opt-inputElement
        });
    });
</script>
