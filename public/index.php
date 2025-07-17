<?php
session_start();

if (!isset($_SESSION['user_id'])){
    header('Location: login.php');
    exit;
}

require_once 'includes/db.php';
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
?>