<?php

$login = $_POST['login'];
$pass = $_POST['pass'];

$pass = md5($pass); // Создаем хэш из пароля

$mysql = new mysqli('localhost', 'me_user', 'good', 'data_base');


$result = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login' AND `pass` = '$pass'");
var_dump($mysql->error);
try{
    $user =  $result->fetch_assoc(); // Конвертируем в массив
}

catch(Exception $e){
    echo "Ошибка в логине или пароле, попробуйте снова";
    exit();
}

if(count((array)$user) == 0){
    echo "Такой пользователь не найден.";
    exit();
    }
else if(count((array)$user) == 1){
    echo "Логин или пароль введены неверно";
    exit();
}

setcookie('user', $user['name'], time() + 3600, "/");

$mysql->close();

header('Location: page.php');


