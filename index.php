<?php

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($path, '/');
define('ROOT', __DIR__);

if ($path === '' || $path === 'dcote_main') {
    $pageTitle = 'Главная | DCOTE';
    $desc = 'Сайт, который совмещает в себе все аспекты произведения "Добро пожаловать в класс превосходства". Википедия, аниме, ранобэ, манга и не только!';
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
    $desc = 'Новостные публикации, связанные со всеми информационными отраслями произведения. Всё об аниме, манге, ранобэ и прочем.';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/news_main.php';
    include __DIR__ . '/app/views/footer.php';

} elseif ($path === 'illustrations') {
    $pageTitle = 'Иллюстрации | DCOTE';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/illustrations.php';
    include __DIR__ . '/app/views/footer.php';

} elseif ($path === 'about-school') {
    $pageTitle = 'Кодо Икусей | DCOTE';
    $desc = 'Подробная информация о столичной старшей школе продвинутого воспитания. Правила, униформа, карта, база данных и не только!';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/about-school.php';
    include __DIR__ . '/app/views/footer.php';

} elseif ($path === 'characters') {
    $pageTitle = 'Персонажи | DCOTE';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/characters.php';
    include __DIR__ . '/app/views/footer.php';

} elseif ($path === 'rules') {
    $pageTitle = 'Правила сайта | DCOTE';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/rules.php';
    include __DIR__ . '/app/views/footer.php';

} elseif ($path === 'about-project') {
    $pageTitle = 'О проекте | DCOTE';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/about-project.php';
    include __DIR__ . '/app/views/footer.php';

} else {
    http_response_code(404);
    $pageTitle = '';
    include __DIR__ . '/app/views/header.php';
    include __DIR__ . '/app/views/pages/page-404.php';
    include __DIR__ . '/app/views/footer.php';
}