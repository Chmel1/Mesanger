<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Мессенджер') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Свои стили -->
    <link href="/assets/css/style.css" rel="stylesheet">
    
    <!-- Свои JS -->
    <script src="/assets/js/app.js" defer></script>
</head>
<body class="bg-light">
    
    <!-- Навбар -->
    <nav class="navbar navbar-light bg-light p-2 mb-4">
        <div class="container d-flex justify-content-between align-items-center">
            <?php if (!empty ($_COOKIE['lodout_success'])):?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_COOKIE['logout_success'])?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Закрыть"></button>
                </div>
                <?php setcookie("logout_success", "", time() -3600, "/")?>
            <?php endif; ?>
                <span class="navbar-text">
                <?php if (isset($_SESSION['username'])): ?>
                    Вы вошли как <strong><?= htmlspecialchars($_SESSION['username']) ?></strong>
                <?php endif; ?>
            </span>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="#" id="logout-btn" class="btn btn-sm btn-outline-danger" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    Выйти
                </a>
            <?php endif;?>
        </div>
    </nav>

    <!-- Контент -->
    <div class="container py-4">
        <?= !empty($content) ? $content : '' ?>
    </div>
    <!-- Модальное окно подтверждения выхода - Exit confirmation modal window -->
</body>
</html>
