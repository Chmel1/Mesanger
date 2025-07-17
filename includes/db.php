<?php
$host = 'localhost';
$dbname = 'messenger';
$username = 'postgres';
$password = 'Chmel1346856';
$port = '5432';

try{
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);

    $pdo->exec("SET NAMES 'UTF8'");
    // Можно задать уровень изоляции транзакций
    $pdo->exec("SET SESSION CHARACTERISTICS AS TRANSACTION ISOLATION LEVEL READ COMMITTED");

}catch(PDOException $e){
    error_log("Database connection failed: " . $e->getMessage());
    die("Database connection error. Please try again later.");
}
?>