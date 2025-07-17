<?php
class User{
    private $pdo;

    public function __construct(){
        $config = require __DIR__ . '/../../config/config.php';
        $db = $config['db'];
        $dsn = "pgsql:host={$db['host']};port={$db['port']};dbname={$db['dbname']}";
    
        $this->pdo = new PDO($dsn, $db['username'], $db['password'],[
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function exists(string $username):bool{
        $stmt = $this->pdo->prepare("SELECT id FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return (bool) $stmt->fetch();
    }

    public function create(string $username, string $password): void{
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password) VALUE (:username, :password)");
        $stmt ->execute([
            'username'=> $username,
            'password' =>$hash
        ]);
    }

    public function findByUsername(string $username){
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username= :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch();
    }
}
?>