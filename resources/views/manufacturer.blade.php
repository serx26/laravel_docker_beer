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

    <title>Manufacturer editor</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
    </style>
</head>
<body>
<div>
    <div>
        <em style="margin-right: 5px " >Производитель</em>

        <em style="margin-right: 5px ">Адрес производителя</em>
    </div>
    <div>
        <ul id="manlist" style="padding: 0">
            @foreach ($tmp as $man)
                <li style="list-style-type: none;">
                    <form method="POST">
                        <input hidden name="id" value="{{$man->id}}">
                        <span  style="margin-right: 5px " class="colt name">{{$man->name}}</span>
                        <input name="name" style="display: none;" class="cole" type="text" value="{{$man->name}}">
                        <span style="margin-right: 5px "  class="colt address">{{$man->address}}</span>
                        <input name="address" style="display: none;" class="cole" type="text" value="{{$man->address}}">
                        <input type="button"  class="edit" value="Редактировать"/>
                        <input style="display: none" type="button"  class="save" value="Сохранить"/>
                        <input type="button"  class="delete" value="Удалить"/>
                    </form>
                </li>
            @endforeach
        </ul>

    </div>
    <div>
        <input  style=" width: 100px;" type="button"  class="add" value="Добавить"/>
    </div>
    <div id = "append" style="display:none">
        <form method="POST">
            <input hidden name="id" value="">
            <span  style="margin-right: 5px; display: none;" class="colt name"></span>
            <input name="name" class="cole" type="text" value="">
            <span style="margin-right: 5px; display: none;"  class="colt address"></span>
            <input name="address"  class="cole" type="text" value="">
            <input style="display: none" type="button"  class="edit" value="Редактировать"/>
            <input style="display: none" type="button"  class="save" value="Сохранить"/>
            <input type="button"  class="create" value="Создать"/>
            <input style="display: none" type="button"  class="delete" value="Удалить"/>
        </form>
    </div>
    <div>

    </div>
</div>
</body>
<script>
    $( document ).ready(function() {

        $(document).on('click', ".edit", function () {
            $(this).parent().find(".colt").hide();
            $(this).parent().find(".cole").show();
            $(this).hide();
            $(this).parent().find(".save").show();
        });

        $(document).on('click', ".save", function () {
            if ($(this).parent().find('input[name="name"]').val() == ""){
                return;
            };if ($(this).parent().find('input[name="address"]').val() == ""){
                return;
            };
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
                url: "/manufacturer_e/save",
                data: form.serialize(),
                success: function(){
                    that.parent().find(".name").html(
                        that.parent().find('input[name="name"]').val()
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
            if ($(this).parent().prev().children().children().last().find(".colt").html() == ""){
                return;
            };
            var cpy = $("#append").html();
            $("#manlist").append('<li style="list-style-type: none;">' + cpy + '</li>');

        });
        $(document).on('click', ".create", function () {
            if ($(this).parent().find('input[name="name"]').val() == ""){
                return;
            };if ($(this).parent().find('input[name="address"]').val() == ""){
                return;
            };

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
                url: "/manufacturer_e/create",
                data: form.serialize(),
                success: function(resp){
                    that.parent().find(".name").html(
                        that.parent().find('input[name="name"]').val()
                    );
                    that.parent().find(".address").html(
                        that.parent().find('input[name="address"]').val()
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
                url: "/manufacturer_e/delete",
                data: form.serialize(),
                success: function(){
                    that.parent().parent().remove();
                },
                error: function () {

                },
            });
        });
    });

</script>
</html>
