<?php


require_once __DIR__ . '/../config/database.php';

class Message{
    private $pdo;

    public function __construct(){
        global $pdo;
        $this->pdo = $pdo;
    }

    public function fetchAll(): array{
        $stmt = $this ->pdo->query("SELECT messages.content, messages.created_at, users.username
            FROM messages
            JOIN users ON messages.user_id = users.id
            ORDER BY messages.created_at DESC
            LIMIT 50
");
        return $stmt->fetchAll();
    }
    public function create(int $userId, string $content):bool{
        $stmt = $this->pdo->prepare("INSERT INTO messages (user_id, content) VALUES (:user_id, :content)");
        return $stmt->execute([
            'user_id' => $userId,
            'content' => htmlspecialchars($content)
        ]);
    }
}
?>