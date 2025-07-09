<?php
$host = 'localhost';
$dbname = 'messenger';
$username = 'postgres';
$password = 'Chmel1346856';
$port = '5432';

try{
    $dsn = "pgsql:host = $host; port = $port; dbname = $dbname; user = $user; password = $password";
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->exec("SET SESSION CHARACTERSISTICS AS TRANSACTION ISOLATION LEVEL READ COMMITTED");


}catch(PDOException $e){
    error_log("Database connection failed: " . $e->getMessage());
    die("Database connection error. Please try again later.");
}
?>