<!DOCTYPE html>
<html>
<head>
    <title>Калькулятор</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <div class="main-cont">
        <h2>Калькулятор!</h2>
        <form id="calculatorForm">
            <input required type="text" id="num1" placeholder="Введите первое число">
            <select id="operator" >
                <option value="+">+</option>
                <option value="-">-</option>
                <option value="*">*</option>
                <option value="/">/</option>
            </select>
            <input required type="text" id="num2" placeholder="Введите второе число">
            <input type="submit" value="Посчитать">
        </form>
        <div id="result"></div>
    </div>
    <script>
        /* 
            Сначала проверяем, что DOM загружен, после по id 
            получаем форму и вешаем на неё обработку события
            отправки формы, убираем поведение по умолчанию,
            чтобы убрать перезагрузку страницы и собираем 
            данные из формы в переменные, после проверяем,
            что у нас не идёт деление на ноль и проверяем, 
            что вообще были введены цифры в корректном формате,
            после, используя ту же jquery формируем ajax запрос,
            к файлу calculate.php с данными из формы, и в случае 
            успешного ответа в div с id result выводим ответ от файла
        */
        $(document).ready(function(){
            $('#calculatorForm').submit(function(event){
                event.preventDefault();
                const num1 = $('#num1').val().replace(',', '.');
                const num2 = $('#num2').val().replace(',', '.');
                const operator = $('#operator').val();

                if(num2 == 0 && operator == '/'){
                    $('#result').html('Деление на ноль');
                } else if (!isNaN(num1) && !isNaN(num2)){
                    $.ajax({
                        type: 'POST',
                        url: 'calculate.php',
                        data: {num1: num1, num2: num2, operator: operator},
                        success: function(response){
                            $('#result').html('Результат: ' + response);
                        }
                    });
                    $('#num1, #num2').css('border', 'none');
                } else {
                    if(isNaN(num1)){
                        $('#num1').css('border', '1px solid red');
                    } else {
                        $('#num1').css('border', 'none');
                    }
                    if(isNaN(num2)){
                        $('#num2').css('border', '1px solid red');
                    } else {
                        $('#num2').css('border', 'none');
                    }
                    $('#result').html('Пожалуйста, введите числа');
                }

            });
        });
    </script>
</body>
</html>
