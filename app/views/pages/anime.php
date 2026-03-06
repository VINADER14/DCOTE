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
            <?php foreach ($seasons_list as $season): ?>
            <div class="cont scale-in">
                <div class="image-wrapper">
                    <img src="<?=e($season['img_src'])?>">
                </div>
                <div class="desc slide-in-left">
                    <div class="head"><h1><?=e($season['id'])?> СЕЗОН</h1>
                    <div class="rating">
                        <div class="rating-popup hidden">
                            <div class="popup-stars">
                                <div class="popup-stars-column"><button class="rating-btn" data-rating="1" aria-label="оценка"><svg class="star-icon" width="30" height="30"><use href="#star"></use></svg></button><p>1</p></div>
                                <div class="popup-stars-column"><button class="rating-btn" data-rating="2" aria-label="оценка"><svg class="star-icon" width="30" height="30"><use href="#star"></use></svg></button><p>2</p></div>
                                <div class="popup-stars-column"><button class="rating-btn" data-rating="3" aria-label="оценка"><svg class="star-icon" width="30" height="30"><use href="#star"></use></svg></button><p>3</p></div>
                                <div class="popup-stars-column"><button class="rating-btn" data-rating="4" aria-label="оценка"><svg class="star-icon" width="30" height="30"><use href="#star"></use></svg></button><p>4</p></div>
                                <div class="popup-stars-column"><button class="rating-btn" data-rating="5" aria-label="оценка"><svg class="star-icon" width="30" height="30"><use href="#star"></use></svg></button><p>5</p></div>
                                <div class="popup-stars-column"><button class="rating-btn" data-rating="6" aria-label="оценка"><svg class="star-icon" width="30" height="30"><use href="#star"></use></svg></button><p>6</p></div>
                                <div class="popup-stars-column"><button class="rating-btn" data-rating="7" aria-label="оценка"><svg class="star-icon" width="30" height="30"><use href="#star"></use></svg></button><p>7</p></div>
                                <div class="popup-stars-column"><button class="rating-btn" data-rating="8" aria-label="оценка"><svg class="star-icon" width="30" height="30"><use href="#star"></use></svg></button><p>8</p></div>
                                <div class="popup-stars-column"><button class="rating-btn" data-rating="9" aria-label="оценка"><svg class="star-icon" width="30" height="30"><use href="#star"></use></svg></button><p>9</p></div>
                                <div class="popup-stars-column"><button class="rating-btn" data-rating="10" aria-label="оценка"><svg class="star-icon" width="30" height="30"><use href="#star"></use></svg></button><p>10</p></div>
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
                    <div class="progress-bar"></div>
                    <button class="dropdown-btn" aria-expanded="false">ДОБАВИТЬ В <svg class="dropdown-icon" width="30" height="30"><use href="#dropdown"></use></svg></button>
                    <div class="button-line"><button>НАЧАТЬ СМОТРЕТЬ</button><button>СТРАНИЦА СЕЗОНА</button></div>
                </div>
            </div>
        <?php endforeach; ?>
<ul class="dropdown-list hidden">
    <li><p>Вариант 1</p></li>
    <li><p>Вариант 2</p></li>
    <li><p>Вариант 3</p></li>
</ul>
</main>
</body>
<script>
document.addEventListener('DOMContentLoaded', () => {
    function initPopup(rating) {
        const popupWindow = rating.querySelector('.rating-popup')
        const ratingBtnForPopup = rating.querySelector('.rating-btn-for-popup')
        const starsContainer = rating.querySelector('.popup-stars');
        const stars = rating.querySelectorAll('.rating-btn');
        let selectedRating = 0

        ratingBtnForPopup.addEventListener('click', () => {
            popupWindow.classList.toggle('hidden');
            ratingBtnForPopup.classList.toggle('active');
        });

        document.addEventListener('click', (event) => {
            if (!popupWindow.classList.contains('hidden')) {
                const isClickInsidePopup = popupWindow.contains(event.target);
                const isClickOnTrigger = event.target.closest('.rating-btn-for-popup');
                if (!isClickInsidePopup && !isClickOnTrigger) {
                    popupWindow.classList.add('hidden');
                    ratingBtnForPopup.classList.remove('active');
                }
            }
        });

        function highlightStars(upTo) {
            stars.forEach(star => {
                const rating = +star.dataset.rating;
                star.classList.toggle('active', rating <= upTo);
            });
        }

        stars.forEach(star => {
            star.addEventListener('mouseenter', () => {
                const rating = +star.dataset.rating;
                highlightStars(rating);
            });
            star.addEventListener('mouseleave', () => {
                highlightStars(selectedRating);
            });
            star.addEventListener('click', () => {
                const clickedRating = +star.dataset.rating;
                if (clickedRating === selectedRating) {
                    selectedRating = 0;
                    highlightStars(0);
                    ratingBtnForPopup.classList.remove('active_long');
                    console.log('Оценка сброшена');
                } else {
                    selectedRating = clickedRating;
                    highlightStars(selectedRating);
                    ratingBtnForPopup.classList.add('active_long');
                }
                    });
        });
    }

    document.querySelectorAll('.rating').forEach(rating => {
        initPopup(rating);
    });

    const button = document.querySelector('.dropdown-btn');
    const dropdown = document.querySelector('.dropdown-list');

    button.addEventListener('click', (e) => {
        e.stopPropagation();
        const rect = button.getBoundingClientRect();
        dropdown.style.top = rect.bottom + window.scrollY + 'px';
        dropdown.style.left = rect.left + window.scrollX + 'px';
        dropdown.style.width = `${button.offsetWidth}px`; 
        dropdown.classList.toggle('hidden');
        button.classList.toggle('active');
        const expanded = button.getAttribute('aria-expanded') === 'true';
        button.setAttribute('aria-expanded', !expanded);
        });

        // Закрытие при клике вне
        document.addEventListener('click', () => {
            dropdown.classList.add('hidden');
            button.setAttribute('aria-expanded', false);
            button.classList.remove('active');
    });
})
</script>
</html>