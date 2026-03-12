<?php

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($uri, '/');

$segments = $path === '' ? [] : explode('/', $path);


define('ROOT', __DIR__);
require ROOT . '/app/config/config.php';
require ROOT . '/help_funcs.php';


$pageTitle = 'DCOTE';
$desc = 'Сайт, который совмещает в себе все аспекты произведения "Добро пожаловать в класс превосходства". Википедия, аниме, ранобэ, манга и не только!';
$contentPage = '';
$httpCode = 200;


if (empty($segments) || $segments[0] === '' || $segments[0] === 'dcote_main') {
    $pageTitle = 'Главная | DCOTE';
    $desc = 'Сайт, который совмещает в себе все аспекты произведения "Добро пожаловать в класс превосходства". Википедия, аниме, ранобэ, манга и не только!';
    $contentPage = '/app/views/pages/dcote_main.php';

} elseif ($segments[0] === 'ranobe_main') {
    $pageTitle = 'Ранобе | DCOTE';
    $contentPage = '/app/views/pages/ranobe_main.php';

} elseif ($segments[0] === 'reg') {
    $pageTitle = 'Регистрация | DCOTE';
    $contentPage = '/app/views/pages/reg.php';

} elseif ($segments[0] === 'login') {
    $pageTitle = 'Авторизация | DCOTE';
    $contentPage = '/app/views/pages/login.php';

} elseif ($segments[0] === 'news_main') {
    $pageTitle = 'Новости | DCOTE';
    $desc = 'Новостные публикации, связанные со всеми информационными отраслями произведения. Всё об аниме, манге, ранобэ и прочем.';
    $contentPage = '/app/views/pages/news_main.php';

} elseif ($segments[0] === 'illustrations') {
    $pageTitle = 'Иллюстрации | DCOTE';
    $contentPage = '/app/views/pages/illustrations.php';

} elseif ($segments[0] === 'about-school') {
    $pageTitle = 'Кодо Икусей | DCOTE';
    $desc = 'Подробная информация о столичной старшей школе продвинутого воспитания. Правила, униформа, карта, база данных и не только!';
    $contentPage = '/app/views/pages/about-school.php';

} elseif ($segments[0] === 'characters') {
    $pageTitle = 'Персонажи | DCOTE';
    $contentPage = '/app/views/pages/characters.php';

} elseif ($segments[0] === 'rules') {
    $pageTitle = 'Правила сайта | DCOTE';
    $contentPage = '/app/views/pages/rules.php';

} elseif ($segments[0] === 'about-project') {
    $pageTitle = 'О проекте | DCOTE';
    $contentPage = '/app/views/pages/about-project.php';

} elseif ($segments[0] === 'anime') {

    $count = count($segments);
    if ($count === 1) {
        $pageTitle = 'Аниме | DCOTE';
        $contentPage = '/app/views/pages/anime.php';
    } elseif ($count === 2) {
        $season = $segments[1];

        if (ctype_digit($season)) {
            $pageTitle = "Аниме | Сезон $season | DCOTE";
            $contentPage = '/app/views/pages/anime-season.php';
        } else {
            $httpCode = 404;
            $contentPage = '/app/views/pages/page-404.php';
        }
    } elseif ($count === 3) {
        $season = $segments[1];
        $episode = $segments[2];

        if (ctype_digit($season) && ctype_digit($episode)) {
            $pageTitle = "Аниме | Сезон $season Серия $episode | DCOTE";
            $contentPage = '/app/views/pages/anime-episode.php';
        } else {
            $httpCode = 404;
            $contentPage = '/app/views/pages/page-404.php';
        }
    } else {
        $httpCode = 404;
        $contentPage = '/app/views/pages/page-404.php';
    }

} else {
    $httpCode = 404;
    $pageTitle = 'Страница не найдена | DCOTE';
    $contentPage = '/app/views/pages/page-404.php';
}

if ($httpCode === 404) {
    http_response_code(404);
}

include __DIR__ . '/app/views/header.php';

if ($contentPage && file_exists(__DIR__ . $contentPage)) {
    include __DIR__ . $contentPage;
} else {
    include __DIR__ . '/app/views/pages/page-404.php';
}

include __DIR__ . '/app/views/footer.php';