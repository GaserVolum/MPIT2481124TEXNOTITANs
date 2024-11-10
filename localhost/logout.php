<?php
// Стартуем сессию для работы с данными
session_start();

// Удаляем все данные сессии
session_unset();

// Уничтожаем сессию
session_destroy();

// Перенаправляем на главную страницу (регистрацию/вход)
header('Location: index.php');
exit();
