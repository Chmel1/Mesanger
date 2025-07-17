<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($title ?? 'Мессенджер') ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Твои стили -->
    <link href="/assets/css/style.css" rel="stylesheet">
    <!-- Твои скрипты -->
    <script src="/assets/js/app.js" defer></script>
</head>
<body class="bg-light">
    <div class="container py-4">
        <?php if (!empty($content)) echo $content; ?>
    </div>
    <a href="?page=logout" class="btn btn-link">Выйти</a>
</body>
</html>
