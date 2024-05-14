<?php
/*
Проверяем, что все переменные на месте, после чего
перебираем переменную operator, чтобы понять, что за 
оператор был выбран в форме, после проводим операцию и возвращаем результат
*/
if(isset($_POST['num1']) && isset($_POST['num2']) && isset($_POST['operator'])){
    $num1 = $_POST['num1'];
    $num2 = $_POST['num2'];
    $operator = $_POST['operator'];
    
    switch($operator){
        case '+':
            $result = $num1 + $num2;
            break;
        case '-':
            $result = $num1 - $num2;
            break;
        case '*':
            $result = $num1 * $num2;
            break;
        case '/':
                $result = round($num1 / $num2,3);
            break;
        default:
            $result = 'Ошибка';
            break;
    }
    
    echo $result;
}else{
    echo 'Что-то пошло не так';
}
?>
