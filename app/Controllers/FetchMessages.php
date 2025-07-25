<?php
session_start();
require_once __DIR__ . '/../Models/Message.php';

header('Content-Type: application/json');

$msgModel = new Message();
echo json_encode($msgModel->fetchAll());