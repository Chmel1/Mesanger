<?php
session_start();
require_once __DIR__ . '/../includes/db.php';

header('Content-Type: application/json');

try{

    if (!isset($_SESSION['user_id']))
    {
        throw new Exception("Authentication required", 401);
    }
    
    $currentUserId = $_SESSION['user_id'];
    $receiverId = isset($_GET['receiver_id']) ? (int)$GET['receiver_id'] : 0;

    if ($receiverId <= 0){
        throw new Exception("Invalid receiver ID", 400);
    }
    
    $limit = 50;
    $offset = isset($_GET['offset']) ? (int)$_GET['offset'] : 0;

    $stmt = $pdo->prepare("
     SELECT 
            m.id,
            m.sender_id,
            m.receiver_id,
            m.message,
            m.is_read,
            m.message_type,
            m.attachments,
            to_char(m.created_at, 'HH24:MI') AS time,
            u.username AS sender_name
        FROM messages m
        JOIN users u ON u.id = m.sender_id
        WHERE 
            (m.sender_id = :current_user AND m.receiver_id = :receiver)
            OR (m.sender_id = :receiver AND m.receiver_id = :current_user)
        ORDER BY m.created_at ASC
        LIMIT :limit OFFSET :offset
    ");

    $stmt->bindValue(':current_user', $currentUserId, PDO::PARAM_INT);
    $stmt->bindValue(':receiver', $receiverId, PDO::PARAM_INT);
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue('offset', PDO::PARAM_INT);

    $stmt->execute();
    $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($messages){
        $updateStmt = $pdo->prepare("
        UPDATE messages
            SET is_read = TRUE
            WHERE receiver_id = :current_user
            AND sender_id = :receiver
            AND is_read = FALSE
        ");
        $updateStmt->execute([
            'current_user' => $currentUserId,
            ':receiver' => $receiverId
        ]);
    }

    $result =[
        'success' => true,
        'messages' => array_map(function($msg) use ($currentUserId){
            return [
                'id' => $msg['id'],
                'is_sender' => ($msg['sender_id'] == $currentUserId),
                'sender_name' => $msg['sender_name'],
                'message' => $msg['message'],
                'time' => $msg['time'],
                'is_read' => $msg['is_read'],
                'message_type' => $msg['message_type'],
                'attachments' => $msg['attachments'] ? json_decode($msg['attachments'], true) : null
            ];
        }, $messages),
        'has_more'=>count($messages) === $limit
    ];

    echo json_encode($result);

}catch(Exception $e){
    http_response_code($e->getCode() ?: 500);
    echo json_encode([
        'success' => false,
        'error' => $e->getMessage()
    ]);
}
?>