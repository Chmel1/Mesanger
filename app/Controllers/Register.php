<?php
session_start();
require_once __DIR__ . '/../Modules/User.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    if($username === '' || $password === ''){
        $error = 'Заполните все поля';
    }else{

        $userModel = new User();

        if($userModel->exists($username)){
            $error = 'Пользователь с таким именем уже существует';
        }else{
            $userModel->create($username,$password);
            header('Location: ?page=login');
            exit;
        }
    }
}

ob_start();
?>

<h2>Регистрация</h2>
<?php if (!empty($error)):?>
    <div class="alert alert-danger"><?=htmlspecialchars($error) ?></div>
<?php endif;?>

<form action="?page=register" method="post">
    <div class="mb-3">
        <label>Логин</label>
        <input type="text" name="username" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Пароль</label>
        <input type="text" name="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Зарегестрироваться</button>
</form>
<?php
$content = ob_get_clean();
$title = 'Регистрация';
require __DIR__ . '/../Views/layout.php'
?>