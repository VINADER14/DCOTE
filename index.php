<?php
// Получаем чистый путь из URL
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($path, '/');

// Определяем, какую страницу показать
if ($path === '' || $path === 'dcote_main') {
    $pageTitle = 'DCOTE | Главная';
    $bodyClass = 'page-home';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/dcote_main.php';
    include __DIR__ . '/app/views/footer.php';

} elseif ($path === 'ranobe') {
    $pageTitle = 'DCOTE | Ранобэ';
    $bodyClass = 'page-ranobe';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/ranobe.php';
    include __DIR__ . '/app/views/footer.php';

} elseif ($path === 'characters') {
    $pageTitle = 'DCOTE | Персонажи';
    $bodyClass = 'page-characters';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/characters.php';
    include __DIR__ . '/app/views/footer.php';

} else {
    // Страница не найдена → 404
    http_response_code(404);
    $pageTitle = '404 — Страница не найдена';
    $bodyClass = 'page-404';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/404.php';
    include __DIR__ . '/app/views/footer.php';
}