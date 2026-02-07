<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($path, '/');
define('ROOT', __DIR__);

if ($path === '' || $path === 'dcote_main') {
    $pageTitle = 'Главная | DCOTE';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/dcote_main.php';
    include __DIR__ . '/app/views/footer.php';

} elseif ($path === 'ranobe_main') {
    $pageTitle = 'Ранобе | DCOTE';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/ranobe_main.php';
    include __DIR__ . '/app/views/footer.php';

} elseif ($path === 'reg') {
    $pageTitle = 'Рергистрация | DCOTE';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/reg.php';
    include __DIR__ . '/app/views/footer.php';


} elseif ($path === 'login') {
    $pageTitle = 'Авторизация | DCOTE';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/login.php';
    include __DIR__ . '/app/views/footer.php';

} elseif ($path === 'news_main') {
    $pageTitle = 'Новости | DCOTE';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/news_main.php';
    include __DIR__ . '/app/views/footer.php';

} elseif ($path === 'illustrations') {
    $pageTitle = 'Иллюстрации | DCOTE';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/illustrations.php';
    include __DIR__ . '/app/views/footer.php';

} elseif ($path === 'about_school') {
    $pageTitle = 'Кодо Икусей | DCOTE';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/about_school.php';
    include __DIR__ . '/app/views/footer.php';

} elseif ($path === 'characters') {
    $pageTitle = 'Персонажи | DCOTE';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/characters.php';
    include __DIR__ . '/app/views/footer.php';

} else {
    http_response_code(404);
    $pageTitle = '';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/page_404.php';
    include __DIR__ . '/app/views/footer.php';
}