<?php
session_start();

require_once __DIR__ . '/../Models/Message.php';

header('Content-Type: application/json');

// Проверяем, что запрос — POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Неверный метод запроса']);
    exit;
}

// Проверка на авторизацию
if (!isset($_SESSION['user_id'])) {
    http_response_code(401); // Unauthorized
    echo json_encode(['error' => 'Пользователь не авторизован']);
    exit;
}

// Проверка, что поле content отправлено
$content = trim($_POST['content'] ?? '');
if ($content === '') {
    http_response_code(400); // Bad Request
    echo json_encode(['error' => 'Сообщение пустое']);
    exit;
}

// Сохраняем сообщение
$msgModel = new Message();
$success = $msgModel->create($_SESSION['user_id'], $content);

// Ответ клиенту
echo json_encode(['success' => $success]);
