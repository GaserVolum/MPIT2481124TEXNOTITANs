// Получаем элемент video по id
const videoElement = document.getElementById('videoElement');

// Проверяем, поддерживает ли браузер getUserMedia
if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    // Запрашиваем доступ к камере
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function(stream) {
            // Передаем полученный поток в элемент video
            videoElement.srcObject = stream;
        })
        .catch(function(error) {
            console.error("Ошибка доступа к камере:", error);
            alert("Не удалось получить доступ к камере. Убедитесь, что браузер имеет разрешение на использование камеры.");
        });
} else {
    alert("Ваш браузер не поддерживает доступ к камере.");
}
