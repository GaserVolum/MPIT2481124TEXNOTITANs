<?php
// Массив с зарегистрированными пользователями (логин => пароль)
$users = [
    'user1' => 'password1',
    'user2' => 'password2'
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Получаем данные из формы
    $login = trim($_POST['login']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Проверяем, что пароли совпадают
    if ($password !== $confirm_password) {
        echo "Пароли не совпадают!";
        exit;
    }

    // Проверяем, существует ли уже пользователь с таким логином
    if (array_key_exists($login, $users)) {
        echo "Пользователь с таким логином уже существует!";
        exit;
    }

    // Добавляем нового пользователя в массив
    $users[$login] = $password;

    // Успешная регистрация
    echo "Регистрация прошла успешно!";
    header("Location: index.html");  // Перенаправление на главную страницу
    exit;
}
?>
