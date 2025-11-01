<?php 
session_start();
require 'config.php';
require 'help_funcs.php';

$news_list=execute_query('SELECT * FROM news', fetch:'all');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>НОВОСТИ</title>
    <link rel="stylesheet" href="news.css">
</head>
<body>
    <nav class="navbar">
        <div class="left">
            <a href="dcote.php" class="logo-link">
            <img src="images/dcote_logo.png" alt="DCOTE" class="logo"> </a>
        </div>
        <div class="center">
            <a href="https://dcote/news.com">НОВОСТИ</a>
            <a href="ranobe.html">ЧИТАТЬ РАНОБЕ</a>
            <a href="https://dcote/arts.com">ИЛЛЮСТРАЦИИ</a>
            <a href="https://dcote/characters.com">ПЕРСОНАЖИ</a>
        </div>
        <div class="right">
            <?php if (isset($_SESSION['email'])): ?>
                <a href="registration.php"><?= htmlspecialchars($_SESSION['username'] ?? $_SESSION['email']) ?></a>
            <?php else: ?>
                <a href="registration.php">ВХОД</a>
            <?php endif; ?>
        </div>
    </nav>
    <main>
        <div class="content">
            <div class="input-with-icon">
                <img src="images/search-icon.png" alt="user icon" class="input-icon">
                <input type="text" placeholder="Поиск...">
            </div>
            <div class="filters">
            <select class="filter-select">
                <option value="">Сортировка по...</option>
                <option value="1">Новости</option>
                <option value="2">Статьи</option>
            </select>
            <select class="filter-select">
                <option value="">Теги</option>
                <option value="1">хз1</option>
                <option value="2">хз2</option>
            </select>
            <button class="filter-button">Непросмотренные посты</button>
            </div>
            <div class="news-list">
                <?php foreach ($news_list as $news): ?>
                    <div class='news1'>
                        <img src='<?=e($news['image'])?>' alt="news_image" class="new-img" >
                        <?php if ((int)$news['pin'] === 1): ?>
                            <img src="images/pin-icon.png" class="pin-img">
                        <?php endif; ?>
                        <div class="news-text">
                        <h1 class="news-title"><?=e($news['news_title'])?></h1>
                        <p><?=e($news['news_text'])?></p>
                            <div class="news-comms-date">
                                <img src="images/comm-icon.png">
                                <p class="comms-number"><?=e($news['comms'])?></p>
                                <p class="date"><?=date_for_news($news['created_at'])?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </main>
    <footer class="footer-nav">
        <a href="#">Главная</a>
        <a href="#">Новости</a>
        <a href="#">Контакты</a>
        <a href="#">Поддержать монетой</a>
    </footer>
</body>
</html>