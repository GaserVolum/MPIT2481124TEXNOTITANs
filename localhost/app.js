// app.js

const startButton = document.getElementById('startButton');
const localVideo = document.getElementById('localVideo');
const remoteVideo = document.getElementById('remoteVideo');

let localStream;
let peerConnection;

const servers = {
  iceServers: [
    { urls: 'stun:stun.l.google.com:19302' } // STUN сервер
  ]
};

// Обработка начала звонка
startButton.addEventListener('click', startCall);

async function startCall() {
  try {
    // Получаем доступ к камере и микрофону
    localStream = await navigator.mediaDevices.getUserMedia({ video: true, audio: true });

    // Отображаем локальное видео
    localVideo.srcObject = localStream;

    // Создаем RTCPeerConnection
    peerConnection = new RTCPeerConnection(servers);

    // Отправляем локальный поток в PeerConnection
    localStream.getTracks().forEach(track => peerConnection.addTrack(track, localStream));

    // Получаем удаленное видео
    peerConnection.ontrack = (event) => {
      remoteVideo.srcObject = event.streams[0];
    };

    // Отправляем ICE кандидаты
    peerConnection.onicecandidate = (event) => {
      if (event.candidate) {
        // Здесь обычно отправляется кандидат на сервер, чтобы передать второму пользователю
        console.log('ICE Candidate:', event.candidate);
      }
    };

    // Создаем предложение для подключения
    const offer = await peerConnection.createOffer();
    await peerConnection.setLocalDescription(offer);

    // Здесь обычно мы отправляем предложение другому пользователю через сервер (например, с помощью WebSocket)
    // Для простоты это можно пропустить, но в реальной реализации нужно передавать это другому пользователю.

    console.log('Offer:', offer);
  } catch (err) {
    console.error('Ошибка при получении медиа-данных:', err);
  }
}
