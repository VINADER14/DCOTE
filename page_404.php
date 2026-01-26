<?php
$pageTitle = 'Ошибка | DCOTE';
$bodyClass = 'page-home';
include __DIR__ . '/app/views/header.php';
?>
<main class="page-404">
    <div class="wrapper">
        <h1 class="text-404">404</h1>
        <img class="ptichka" src="/images/page_404/ptichka.png" alt="бро из мема">
        <div class="desc-404">
            <h2>СОМНЕВАЮСЬ, ЧТО ТАКАЯ СТРАНИЦА СУЩЕСТВУЕТ</h2>
            <div class="button"><button class="return" onclick="window.location.href='/dcote_main'"><h3>НА ГЛАВНУЮ</h3></button></div>
        </div>
    </div>

</main>
<?php include __DIR__ . '/app/views/footer.php'; ?>
</body>
</html>