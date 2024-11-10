<?php
// Стартуем сессию, чтобы получить информацию о пользователе
session_start();

// Если пользователь не зарегистрирован, перенаправляем на страницу регистрации
if (!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добро пожаловать</title>
</head>
<body>

    <h1>Добро пожаловать, <?= htmlspecialchars($_SESSION['user']['username']); ?>!</h1>
    <p>Вы успешно зарегистрированы.</p>

</body>
</html>
