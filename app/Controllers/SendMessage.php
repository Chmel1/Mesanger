<?php
session_start();

require_once __DIR__ . '/../Models/Message.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user_id'])){
    $content = trim($_POST['content'] ?? '');
    if ($content !== '') {
        $msgModel = new Message();
        $msgModel->create($_SESSION['user_id'], $content);
    }
}
?>