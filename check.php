<?php
$succesornot = "Вы пока не зарегистрированы";
$login = $_POST['login'];
$name = $_POST['name'];
$pass = $_POST['pass'];

if(mb_strlen($login) < 5 || mb_strlen($login) > 90){
    $succesornot = "Недопустимая длина логина";
    exit();
}
else if(mb_strlen($name) < 5){
    $succesornot = "Недопустимая длина имени.";
    exit();
} // Проверяем длину имени

$pass = md5($pass); // Создаем хэш из пароля

$mysql = new mysqli('localhost', 'me_user', 'good', 'data_base');
mysqli_query($mysql,"SET NAMES 'utf8';");
mysqli_query($mysql,"SET CHARACTER SET 'utf8';");
mysqli_query($mysql,"SET SESSION collation_connection = 'utf8_general_ci';");

$result1 = $mysql->query("SELECT * FROM `users` WHERE `login` = '$login'");
if(!empty($user1)){
    echo "Данный логин уже используется!";
    exit();
}
mysqli_query($mysql,"INSERT INTO `users`(`login`, `pass`, `name`) VALUES ('$login','$pass','$name')");
header('Location: /');
exit();
