<?php
// Стартуем сессию для хранения данных о пользователях
session_start();

// Массив пользователей (можно заменить на данные из файла)
$users = [
    ['username' => 'admin', 'email' => 'admin@example.com', 'password' => 'admin123'],
    ['username' => 'testuser', 'email' => 'testuser@example.com', 'password' => 'testpassword'],
];

// Сообщение об ошибке
$error = '';
$success = '';

// Регистрация пользователя
if (isset($_POST['register'])) {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Проверка на пустые поля
    if (empty($username) || empty($email) || empty($password)) {
        $error = "Все поля обязательны для заполнения.";
    } else {
        // Проверка на существование пользователя с таким email
        foreach ($users as $user) {
            if ($user['email'] === $email) {
                $error = "Пользователь с таким email уже существует.";
                break;
            }
        }

        // Если пользователя нет, то добавляем в массив
        if (empty($error)) {
            $users[] = ['username' => $username, 'email' => $email, 'password' => $password];
            $_SESSION['user'] = ['username' => $username, 'email' => $email]; // Сохраняем пользователя в сессии
            $success = "Вы успешно зарегистрированы. Теперь вы можете войти.";
        }
    }
}

// Вход пользователя
if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    
    // Проверка на пустые поля
    if (empty($email) || empty($password)) {
        $error = "Пожалуйста, заполните все поля.";
    } else {
        // Проверка на существование пользователя с таким email и правильным паролем
        foreach ($users as $user) {
            if ($user['email'] === $email && $user['password'] === $password) {
                $_SESSION['user'] = ['username' => $user['username'], 'email' => $user['email']]; // Сохраняем данные пользователя в сессии
                header('Location: welcome.php'); // Перенаправление на страницу приветствия
                exit();
            }
        }

        // Если не нашли пользователя с таким email и паролем
        $error = "Неверный email или пароль.";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация и Вход</title>
</head>
<body>

    <h1>Регистрация и Вход</h1>

    <!-- Сообщения об ошибках и успешных действиях -->
    <?php if ($error): ?>
        <p style="color: red;"><?= $error; ?></p>
    <?php endif; ?>
    <?php if ($success): ?>
        <p style="color: green;"><?= $success; ?></p>
    <?php endif; ?>

    <!-- Форма регистрации -->
    <h2>Регистрация</h2>
    <form method="POST">
        <label for="username">Имя пользователя:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit" name="register">Зарегистрироваться</button>
    </form>

    <!-- Форма входа -->
    <h2>Вход</h2>
    <form method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit" name="login">Войти</button>
    </form>

</body>
</html>
