<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: ?page=login');
    exit;
}

ob_start();
require __DIR__ . '/../Views/chat.php';
$content = ob_get_clean();
$title = 'Чат';
require __DIR__ . '/../Views/layout.php';
