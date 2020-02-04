<html xmlns="http://www.w3.org/1999/html">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <link rel="stylesheet" href="view/chosen/chosen.css">

    <style>
        form label {
            display: inline-block;
            width: 100px;
        }

        form div {
            margin-bottom: 10px;
        }

        .error {
            color: red;
            margin-left: 5px;
        }

        label.error {
            display: inline;
        }
    </style>
</head>
<body>
<br>
<br>
<?php echo !empty($alarm)?$alarm:''; ?>
<br>
<br>
<br>
<form id="form" action="#" method="POST">

    <label for="fio">Фио</label><input type="text" name="fio" id="fio"><br><br>

    <label for="email">Email</label><input type="text" name="email" id="email"><br><br>

    <div>
        <select onchange="getCity(this.value)" id="region" class="chosen-select">
            <option value="">Нужно выбрать</option>
            <?php foreach ($region as $r){ ?>
            <option value="<?php echo $r['reg_id'] ?>"><?php echo $r['name']; ?></option>
            <?php } ?>
        </select>
     </div>

    <br>
    <br>

    <select id="city" onchange="getArea(this.value)" class="chosen-select">
        <option value="">-----</option>
    </select>

    <br>
    <br>

    <select name="address" id="area"  class="chosen-select">
        <option value="">-----</option>
    </select>

    <br>
    <br>

    <input type="submit" name="button" id="send" value="Отправить">

</form>

<script>
    function getCity(id) {

        $.ajax({
            type: "GET",   // Тип запроса
            url: "/route=register/city",   // Путь к сценарию, обработающему запрос
            dataType: "json",   // Тип данных, в которых сервер должен прислать ответ
            data: "?id="+id,  // Строка POST-запроса
            error: function (data) {    // Обработчик, который будет запущен в случае неудачного запроса
                console.log(data);
                alert("При выполнении запроса произошла ошибка :(");  // Сообщение о неудачном запросе
            },
            success: function (data) {
                $('#city').find('option').remove();
                $('#area').find('option').remove();
                $('#city').append('<option value="">Нужно выбрать</option>');
                for (var i = 0; i < data.length; i++) {
                    $('#city').append('<option value="' + data[i].id + '">' + data[i].name + '</option>');
                }
                $('#city').trigger('chosen:updated');
            }
        });
    }

    function getArea(id) {
        $.ajax({
            type: "GET",   // Тип запроса
            url: "/route=register/area",   // Путь к сценарию, обработающему запрос
            dataType: "json",   // Тип данных, в которых сервер должен прислать ответ
            data: "?id="+id,  // Строка POST-запроса
            error: function (data) {    // Обработчик, который будет запущен в случае неудачного запроса
                console.log(data);
                alert("При выполнении запроса произошла ошибка :(");  // Сообщение о неудачном запросе
            },
            success: function (data) {
                $('#area').find('option').remove();
                console.log(data);
                $('#area').append('<option value="">Нужно выбрать</option>');
                for (var i = 0; i < data.length; i++) {
                    $('#area').append('<option value="' + data[i].address + '">' + data[i].address + '</option>');
                }
                $('#area').trigger('chosen:updated');
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        $('#form').submit(function(e) {
            var fio = $('#fio').val();
            var email = $('#email').val();
            var region = $('#region').val();
            var city = $('#city').val();
            var area = $('#area').val();
            var alarm = false;

            $(".error").remove();

            if (fio.length< 3) {
                $('#fio').after('<span class="error">Это поле нужно заполнить</span>');
                alarm = true;
            }
            if (email.length< 1) {
                $('#email').after('<span class="error">Это поле нужно заполнить</span>');
                alarm = true;
            } else {
                var regEx = /^\w+([\.-]?\w+)*@(((([a-z0-9]{2,})|([a-z0-9][-][a-z0-9]+))[\.][a-z0-9])|([a-z0-9]+[-]?))+[a-z0-9]+\.([a-z]{2}|(com|net|org|edu|int|mil|gov|arpa|biz|aero|name|coop|info|pro|museum))$/i;
                var validEmail = regEx.test(email);
                if (!validEmail) {
                    $('#email').after('<span class="error">Не правильно!!</span>');
                    alarm = true;
                }
            }
            if(region == 0){
                $('#region').after('<span class="error">Нужно выбрать область</span>');
                alarm = true;
            }
            if(city == 0){
                $('#city').after('<span class="error">Нужно выбрать город</span>');
                alarm = true;
            }
            if(area == 0){
                $('#area').after('<span class="error">Нужно выбрать район</span>');
                alarm = true;
            }

            if(alarm === true){
                e.preventDefault();
            }

        });
    });
</script>
<script src="view/chosen/chosen.jquery.js" type="text/javascript"></script>
<script src="view/chosen/docsupport/prism.js" type="text/javascript" charset="utf-8"></script>
<script src="view/chosen/docsupport/init.js" type="text/javascript" charset="utf-8"></script>