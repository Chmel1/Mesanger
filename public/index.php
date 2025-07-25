<?php 
session_start();
require __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/../config/config.php';
$db = $config['db'];

$dsn = "pgsql:host={$db['host']};port={$db['port']};dbname={$db['dbname']}";
try{
    $pdo = new PDO($dsn, $db['username'], $db['password'],[
     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC   
    ]);
}catch (PDOException $e) {
    die("Ошибка подключения к базе данных.");
}

$page = $_GET['page'] ?? 'chat';

switch ($page) {
    case 'login':
        require __DIR__ . '/../app/Controllers/Login.php';
        break;
    case 'register':
        require __DIR__ . '/../app/Controllers/Register.php';
        break;
    case 'chat':
        require __DIR__ . '/../app/Controllers/Chat.php';
        break;
    case 'logout':
    session_start();
    session_destroy();
    header('Location: ?page=login');
    exit;
    default:
        echo "404 Not Found";

}

?>