<?php
// Подключаем автозагрузчик Composer
require dirname(__FILE__) . '/vendor/autoload.php';

// Используем классы Ratchet
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
use Ratchet\App;

// Класс для обработки WebSocket-соединений
class VideoChatServer implements MessageComponentInterface {
    public function onOpen(ConnectionInterface $conn) {
        echo "Новое соединение: {$conn->resourceId}\n";
    }

    public function onMessage(ConnectionInterface $from, $msg) {
        // Отправляем сообщение всем подключенным клиентам, кроме отправителя
        foreach ($from->httpRequest->getHeaders() as $key => $value) {
            echo "Клиент {$from->resourceId} отправил: $msg\n";
        }
        
        // Отправляем сообщение всем клиентам
        foreach ($from->app->connections as $client) {
            if ($client !== $from) {
                $client->send($msg);
            }
        }
    }

    public function onClose(ConnectionInterface $conn) {
        echo "Закрыто соединение: {$conn->resourceId}\n";
    }

    public function onError(ConnectionInterface $conn, \Exception $e) {
        echo "Ошибка: {$e->getMessage()}\n";
        $conn->close();
    }
}

// Настройка WebSocket-сервера
$app = new App('localhost', 8080);  // Сервер будет слушать на порту 8080
$app->route('/videochat', new VideoChatServer, ['*']);
$app->run();
