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

    <title>Beer editor</title>

    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

</head>
<body>
<div>
    <div>
        <em style="margin-right: 5px " >Название</em>

        <em style="margin-right: 5px " >Описание</em>

        <em style="margin-right: 5px " >Тип</em>

        <em style="margin-right: 5px " >Производитель</em>

        <em style="margin-right: 5px ">Адрес производителя</em>
    </div>
    <div>
        <ul id="beerlist" style="padding: 0">
            @foreach ($tmp as $beer)
                <li style="list-style-type: none;">
                    <form method="POST">
                        <input hidden name="id" value="{{$beer->id}}">
                        <span style="margin-right: 5px " class="colt name">{{$beer->name}}</span>
                        <input name="name" style="display: none;" class="cole" type="text" value="{{$beer->name}}">
                        <span style="margin-right: 5px " class="colt description">{{$beer->description}}</span>
                        <input name="description" style="display: none;" class="cole" type="text"
                               value="{{$beer->description}}">
                        <span style="margin-right: 5px " class="colt type">{{$beer->types->name}}</span>
                        <select id="type" name="type_id" style="display: none;" class="cole">
                            @foreach($type as $typ)
                                <option value="{{$typ->id}}">{{$typ->name}}</option>
                            @endforeach
                        </select>
                        <span style="margin-right: 5px " class="colt manufacturer">{{$beer->manufacturers->name}}</span>
                        <select id="manufacts" name="manufacturer_id" style="display: none;" class="cole">
                            @foreach($manufacturer as $man)
                                <option data-address="{{$man->address}}" value="{{$man->id}}">{{$man->name}}</option>
                            @endforeach
                        </select>
                        <span id="address" style="margin-right: 5px ">{{$beer->manufacturers->address}}</span>
                        <input type="button" class="edit" value="Редактировать"/>
                        <input style="display: none" type="button" class="save" value="Сохранить"/>
                        <input type="button" class="delete" value="Удалить"/>
                    </form>
                </li>
            @endforeach
        </ul>

    </div>
    <div>
        <input style=" width: 100px;" type="button" class="add" value="Добавить"/>
    </div>
    <div id="append" style="display:none">
        <form method="POST">
            <input hidden name="id" value="">
            <span style="margin-right: 5px; display: none;" class="colt name"></span>
            <input name="name" class="cole" type="text" value="">
            <span style="margin-right: 5px; display: none;" class="colt description"></span>
            <input name="description" class="cole" type="text" value="">
            <span style="margin-right: 5px; display: none;" class="colt type"></span>
            <select id="type" name="type_id" class="cole">
                @foreach($type as $typ)
                    <option value="{{$typ->id}}">{{$typ->name}}</option>
                @endforeach
            </select>
            <span style="margin-right: 5px; display: none;" class="colt manufacturer"></span>
            <select id="manufacts" name="manufacturer_id" class="cole" id="manufacts">
                @foreach($manufacturer as $man)
                    <option value="{{$man->id}}" data-address="{{$man->address}}">{{$man->name}}</option>
                @endforeach
            </select>
            <span id="address" style="margin-right: 5px;">{{$manufacturer->first()->address}}</span>
            <input style="display: none" type="button" class="edit" value="Редактировать"/>
            <input style="display: none" type="button" class="save" value="Сохранить"/>
            <input type="button" class="create" value="Создать"/>
            <input style="display: none" type="button" class="delete" value="Удалить"/>
        </form>
    </div>
    <div>

    </div>
</div>
</body>
<script>
    $(document).ready(function () {

        $(document).on('click', ".edit", function () {
            $(this).parent().find(".colt").hide();
            $(this).parent().find(".cole").show();
            $(this).hide();
            $(this).parent().find(".save").show();
        });
        $(document).on('change', "#manufacts", function () {
            $('#address').html($(this).find('option:selected').data('address'));
        });

        $(document).on('click', ".save", function () {
            if ($(this).parent().find('input[name="name"]').val() == "") {
                return;
            }
            ;
            if ($(this).parent().find('input[name="description"]').val() == "") {
                return;
            }
            ;
            $(this).parent().find(".colt").show();
            $(this).parent().find(".cole").hide();
            $(this).hide();
            $(this).parent().find(".edit").show();

            var form = $(this).parent();
            var that = $(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "post",
                url: "/beer_e/save",
                data: form.serialize(),
                success: function () {
                    that.parent().find(".name").html(
                        that.parent().find('input[name="name"]').val()
                    );
                    that.parent().find(".description").html(
                        that.parent().find('input[name="description"]').val()
                    );
                    that.parent().find(".type").html(
                        that.parent().find('select[id="type"]').find('option:selected').text()
                    );
                    that.parent().find(".manufacturer").html(
                        that.parent().find('select[id="manufacts"]').find('option:selected').text()
                    );
                    that.parent().find(".address").html(
                        that.parent().find('input[name="address"]').val()
                    );
                },
                error: function () {

                },
            });
        });
        $(document).on('click', ".add", function () {
            if ($(this).parent().prev().children().children().last().find(".colt").html() == "") {
                return;
            }
            ;
            var cpy = $("#append").html();
            $("#beerlist").append('<li style="list-style-type: none;">' + cpy + '</li>');

        });
        $(document).on('click', ".create", function () {
            if ($(this).parent().find('input[name="name"]').val() == "") {
                return;
            }
            ;
            if ($(this).parent().find('input[name="description"]').val() == "") {
                return;
            }
            ;

            $(this).parent().find(".colt").show();
            $(this).parent().find(".cole").hide();
            $(this).hide();
            $(this).parent().find(".edit").show();
            $(this).parent().find(".delete").show();
            var form = $(this).parent();
            var that = $(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "post",
                url: "/beer_e/create",
                data: form.serialize(),
                success: function (resp) {
                    that.parent().find(".name").html(
                        that.parent().find('input[name="name"]').val()
                    );
                    that.parent().find(".description").html(
                        that.parent().find('input[name="description"]').val()
                    );
                    that.parent().find(".type").html(
                        that.parent().find('select[name="type_id"]').find('option:selected').text()
                    );
                    that.parent().find(".manufacturer").html(
                        that.parent().find('select[name="manufacturer_id"]').find('option:selected').text()
                    );
                    that.parent().find('input[name="id"]').val(resp);
                },
                error: function () {

                },
            });
        });
        $(document).on('click', ".delete", function () {
            $(this).parent().find(".colt").show();
            $(this).parent().find(".cole").hide();
            $(this).hide();
            $(this).parent().find(".edit").show();

            var form = $(this).parent();
            var that = $(this);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "post",
                url: "/beer_e/delete",
                data: form.serialize(),
                success: function () {
                    that.parent().parent().remove();
                },
                error: function () {

                },
            });
        });
    });

</script>
</html>
