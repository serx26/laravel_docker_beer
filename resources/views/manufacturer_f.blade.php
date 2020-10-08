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

    <title>Manufacturer</title>

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
        <div id="menu" style="display:none">
            <form method="POST">
                <div id="type">
                    <span>Типы пива:</span>
                    @foreach($type as $check)
                        <input type="checkbox" class="type_filter" id="{{$check->id}}">{{$check->name}}
                    @endforeach
                </div>
                <div>
                    <input type="button" class="apply" value="Применить">
                </div>
            </form>
        </div>
        <div>
            <em  style="margin-right: 5px " >Производитель</em>

            <em style="margin-right: 5px ">Адрес производителя</em>
        </div>
        <ul id="manufacturerlist" style="padding: 0">
            @foreach ($manufacturer as $man)
                <li class="view" style="list-style-type: none;">
                    <form method="POST">

                        <span style="margin-right: 5px " class="name">{{$man->name}}</span>
                        <span style="margin-right: 5px " class="address">{{$man->address}}</span>

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
            $("#menu").show();
            $(this).hide();
            $(".close").show();
        });
        $(document).on('click', ".close", function () {
            $("#menu").hide();
            $(this).hide();
            $(".open").show();
        });
        $(document).on('click', ".apply", function () {
            let filtered_type_data = [];
            $('.type_filter').each(function () {
                if (this.checked) {
                    filtered_type_data.push($(this).attr('id'));
                }
            });
            console.log(filtered_type_data);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "get",
                url: "/manufacturer/filter",
                data: {type_filtered: filtered_type_data},
                success: function (resp) {
                    $('#manufacturerlist').html('');
                    $.each(resp, function (index, value) {
                        $('#manufacturerlist').append('<li class="view" style="list-style-type: none;">\n' +
                            '                    <form method="POST">\n' +
                            '\n' +
                            '                        <span style="margin-right: 5px " class="name">' + value.name + '</span>\n' +
                            '                        <span style="margin-right: 5px " class="address">' + value.address + '</span>\n' +
                            '\n' +
                            '                    </form>\n' +
                            '                </li>');
                    });
                },
                error: function () {

                },
            });

        });
    })

</script>
</html>
