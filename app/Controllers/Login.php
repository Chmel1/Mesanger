<?php
    session_start();

    require_once __DIR__ . '/../Models/User.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if ($username === '' || $password === ''){
        $error = 'Заполните все поля';
    }else{
        $userModel = new User();
        $user = $userModel->findByUsername($username);

        if(!$user || !password_verify($password,$user['password'])){
            $error = 'Неверный логин или пароль';
        }else{
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            header('Location: ?page=chat');
            exit;
        }
    }
    }
    ob_start();
?>
<h2>Вход</h2>
<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<form method="post" action="?page=login">
    <div class="mb-3">
        <label>Логин</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Пароль</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Войти</button>
</form>
<?php
$content = ob_get_clean();
$title = 'Вход';
require __DIR__ . '/../Views/layout.php';
