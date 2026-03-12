<?php
$seasons_list=execute_query('SELECT * FROM anime_seasons ORDER BY id DESC', fetch:'all'); 
?>
<svg style="display: none;">
<symbol id="star" viewBox="0 0 24 24">
    <path fill="currentColor" d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
</symbol>
</svg>
<div class="navigation-links">
            <a href="/dcote_main"><span>ГЛАВНАЯ</span></a>
            <p>/</p>
            <a class="current-page" href="/anime"><span>АНИМЕ</span></a>
        </div>
        <main class="page-anime">
<?php foreach ($seasons_list as $index => $season): ?>
    <?php $total = (int)$season['number_of_episodes'];
    $released = (int)$season['number_of_realese_episodes'];
    $percent = ($total > 0) ? min(100, round(($released / $total) * 100, 2)) : 0;?>
            <div class="cont scale-in" data-season=" <?=(int)$season['season_number'] ?>">
                <div class="image-wrapper">
                    <img src="<?=e($season['img_src'])?>"<?= $index < 2 ? 'fetchpriority="high"' : 'loading="lazy"' ?> decoding="async">
                </div>
                <div class="desc slide-in-left">
                    <div class="head"><h1><?=e($season['id'])?> СЕЗОН</h1>
                    <div class="rating">
                        <div class="rating-popup hidden">
                            <div class="popup-stars">
<?php for ($i = 1; $i <= 10; $i++): ?>
                                <div class="popup-stars-column"><button class="rating-btn" data-rating="<?= $i ?>" aria-label="оценка"><svg class="star-icon" width="30" height="30"><use href="#star"></use></svg></button><p><?= $i ?></p></div>
<?php endfor; ?>
                            </div>
                        </div>
                        <div class="star-and-number"><button class="rating-btn-for-popup" aria-label="оценка"><svg class="star-icon" width="30" height="30"><use href="#star"></use></svg></button><h3>9</h3></div><p>150 оценок</p>
                    </div></div>
                    <div class="info-block">
                        <div class="left-column"><p><b>Статус сериала:</b></p><p><b>Сезон:</b></p></div>
                        <div class="right-column"><p class="<?= e($season['status'])==='Вышел' ? 'green': 'yellow'?>"><?=e($season['status'])?></p><p><?=e($season['season_time'])?></p></div>
                    </div>
                    <div class="info-block">
                        <div class="left-column"><p><b>Выпуск:</b></p><p><b>Студия:</b></p></div>
                        <div class="right-column"><p><?=e($season['release_time'])?></p><p><?=e($season['studio'])?></p></div>
                    </div>
                    <div class="info-block">
                        <div class="left-column"><p><b>Кол-во серий:</b></p><p><b>Последнее обновление:</b></p></div>
                        <div class="right-column"><p><?=e($season['number_of_episodes'])?></p><p><?=e($season['last_update'])?></p></div>
                    </div>
                    <p><b>Выпущено:</b> <?=e($season['number_of_realese_episodes'])?> из <?=e($season['number_of_episodes'])?> серий</p>
                    <div class="progress-bar" style="--progress-width: <?= $percent ?>%"></div>
                    <button class="dropdown-btn" aria-expanded="false">ДОБАВИТЬ В <svg class="dropdown-icon" width="30" height="30"><use href="#dropdown"></use></svg></button>
                    <div class="button-line"><button>НАЧАТЬ СМОТРЕТЬ</button><button>СТРАНИЦА СЕЗОНА</button></div>
                </div>
            </div>
<?php endforeach; ?>
<ul class="dropdown-list hidden">
    <li><p>Смотрю</p></li>
    <li><p>Брошеное</p></li>
    <li><p>Любимое</p></li>
</ul>
</main>
</body>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const ratingPopups = document.querySelectorAll('.rating');
    ratingPopups.forEach(rating => {
        const popupWindow = rating.querySelector('.rating-popup');
        const ratingBtnForPopup = rating.querySelector('.rating-btn-for-popup');
        const stars = rating.querySelectorAll('.rating-btn');
        let selectedRating = 0;

        ratingBtnForPopup.addEventListener('click', (e) => {
            e.stopPropagation();
            popupWindow.classList.toggle('hidden');
            ratingBtnForPopup.classList.toggle('active');
        });

        function highlightStars(upTo) {
            stars.forEach(star => {
                const starRating = +star.dataset.rating;
                star.classList.toggle('active', starRating <= upTo);
            });
        }

        stars.forEach(star => {
            star.addEventListener('mouseenter', () => highlightStars(+star.dataset.rating));
            star.addEventListener('mouseleave', () => highlightStars(selectedRating));
            star.addEventListener('click', () => {
                const clickedRating = +star.dataset.rating;
                if (clickedRating === selectedRating) {
                    selectedRating = 0;
                    highlightStars(0);
                    ratingBtnForPopup.classList.remove('active_long');
                } else {
                    selectedRating = clickedRating;
                    highlightStars(selectedRating);
                    ratingBtnForPopup.classList.add('active_long');
                }
            });
        });
    });


    document.addEventListener('click', (e) => {
        ratingPopups.forEach(rating => {
            const popup = rating.querySelector('.rating-popup');
            const btn = rating.querySelector('.rating-btn-for-popup');
            if (!popup.classList.contains('hidden')) {
                const isInside = popup.contains(e.target);
                const isOnTrigger = e.target.closest('.rating-btn-for-popup');
                if (!isInside && !isOnTrigger) {
                    popup.classList.add('hidden');
                    btn.classList.remove('active');
                }
            }
        });
    });



    const globalDropdown = document.querySelector('.dropdown-list');
    let currentDdButton = null;
    
    if (globalDropdown) {
        document.querySelectorAll('.dropdown-btn').forEach(button => {
            button.addEventListener('click', (e) => {
                e.stopPropagation();

                if (currentDdButton && currentDdButton !== button) {
                    globalDropdown.classList.add('hidden');
                    currentDdButton.classList.remove('active');
                    currentDdButton.setAttribute('aria-expanded', 'false');
                }
                const rect = button.getBoundingClientRect();
                globalDropdown.style.top = rect.bottom + window.scrollY + 'px';
                globalDropdown.style.left = rect.left + window.scrollX + 'px';
                globalDropdown.style.width = `${button.offsetWidth}px`;
                
                const isHidden = globalDropdown.classList.toggle('hidden');
                button.classList.toggle('active');
                button.setAttribute('aria-expanded', !isHidden);
                currentDdButton = isHidden ? null : button;
            });
        });

        document.addEventListener('click', (e) => {
            const clickedBtn = e.target.closest('.dropdown-btn');
            
            if (!clickedBtn && !globalDropdown.contains(e.target) && !globalDropdown.classList.contains('hidden')) {
                globalDropdown.classList.add('hidden');
                
                document.querySelectorAll('.dropdown-btn').forEach(btn => {
                    btn.classList.remove('active');
                    btn.setAttribute('aria-expanded', 'false');
                });
                
                currentDdButton = null;
            }
        });
    }
})
</script>
</html>