<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Beer</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
    </style>
</head>
<body>
<div>
    <input type="button" class="open" value="Фильтрация">
    <input type="button" class="close" style="display:none" value="Фильтрация">
    <div>
        <em style="margin-right: 5px " >Название</em>

        <em style="margin-right: 5px " >Описание</em>

        <em style="margin-right: 5px " >Тип</em>

        <em style="margin-right: 5px " >Производитель</em>

        <em style="margin-right: 5px ">Адрес производителя</em>
    </div>
    <div>
        <div id="menu" style="display:none">
            <form method="POST">
                <div id="type">
                    <span>Типы пива:</span>
                    @foreach($type as $check)
                        <input type="checkbox" class="type_filter" id="{{$check->name}}">{{$check->name}}
                    @endforeach
                </div>
                <div id="manufacturer">
                    <span>Производители:</span>
                    @foreach($manufacturer as $check)
                        <input type="checkbox" class="manufacturer_filter" id="{{$check->name}}">{{$check->name}}
                    @endforeach
                </div>
                <div>
                    <input type="button" class="apply" value="Применить">
                </div>
            </form>
        </div>
        <ul id="beerlist" style="padding: 0">
            @foreach ($tmp as $beer)
                <li id="{{$beer->name}}" class="view" style="list-style-type: none;">
                    <form method="POST">

                        <span style="margin-right: 5px " class="name">{{$beer->name}}</span>
                        <span style="margin-right: 5px " class="description">{{$beer->description}}</span>
                        <span style="margin-right: 5px " class="type">{{$beer->types->name}}</span>
                        <span style="margin-right: 5px " class="manufacturer">{{$beer->manufacturers->name}}</span>
                        <span style="margin-right: 5px " class="address">{{$beer->manufacturers->address}}</span>

                    </form>
                </li>
            @endforeach
        </ul>
    </div>
</div>
</body>
<script>
    $(document).ready(function () {

        $(document).on('click', ".open", function () {
            $(this).parent().find("#menu").show();
            $(this).hide();
            $(this).parent().find(".close").show();
        });
        $(document).on('click', ".close", function () {
            $(this).parent().find("#menu").hide();
            $(this).hide();
            $(this).parent().find(".open").show();
        });
        $(document).on('click', ".apply", function () {
            $('.view').show();
            console.log($('.type_filter:checked').length);
            if ($('.type_filter:checked').length != 0) {
                $('.type_filter').each(function () {
                    let a = this;
                    if (!this.checked) {
                        $('.view').each(function () {

                            if ($(this).find('span.type')[0].textContent == $(a).attr('id')) {
                                $(this).hide();
                            }
                            ;
                        })
                    }
                });
            }
            if ($('.manufacturer_filter:checked').length != 0) {
                $('.manufacturer_filter').each(function () {
                    let a = this;
                    if (!this.checked) {
                        $('.view').each(function () {

                            if ($(this).find('span.manufacturer')[0].textContent == $(a).attr('id')) {

                                $(this).hide();
                            }
                            ;
                        })
                    }
                });
            }

        });
    });

</script>
</html>
