<?php
$episode_links = execute_query('SELECT episode_link, episode_link_sub FROM anime_episodes WHERE number_of_season=? AND episode_number=?', [$season, $episode], true);
$season_episodes = execute_query('SELECT number_of_release_episodes FROM anime_seasons WHERE season_number=?', [$season], true);

if (!$episode_links) {
    $episode_links = ['episode_link' => '', 'episode_link_sub' => ''];
}
if (!$season_episodes) {
    $season_episodes = ['number_of_release_episodes' => 0];
}


$has_dub = !empty($episode_links['episode_link']);
$has_sub = !empty($episode_links['episode_link_sub']);
$active_src = $has_dub ? $episode_links['episode_link'] : $episode_links['episode_link_sub'];
?>

<div class="navigation-links">
    <a href="/"><span>ГЛАВНАЯ</span></a>
    <p>/</p>
    <a href="/anime"><span>АНИМЕ</span></a>
    <p>/</p>
    <a href="/anime/<?= e($season) ?>"><span><?= e($season) ?> СЕЗОН</span></a>
    <p>/</p>
    <a class="current-page" href="/anime/<?= e($season) ?>/<?= e($episode) ?>"><span><?= e($episode) ?> СЕРИЯ</span></a>
</div>

<main class="page-anime-episode">
    <div class="subs-and-dubs">
        <button data-type="dub" class="dubs <?= $has_dub ? 'active' : '' ?>" <?= !$has_dub ? 'disabled' : '' ?>>ОЗВУЧКА</button>
        <button data-type="sub" class="subs <?= $has_sub && !$has_dub ? 'active' : '' ?>" <?= !$has_sub ? 'disabled' : '' ?>>СУБТИТРЫ</button>
    </div>

    <?php if (!$has_dub && !$has_sub): ?>
        <h1 style="text-align: center;">СЕРИИ ПОКА НЕТ</h1>
    <?php else: ?>

    <?php endif ?>

    <div class="episode-controls">
        <button <?= $episode <= 1 ? 'disabled' : '' ?> data-href="/anime/<?= e($season) ?>/<?= $episode - 1 ?>" class="prev-episode-btn">ПРЕДЫДУЩАЯ СЕРИЯ</button>
        <button onclick="window.location.href='/anime/<?= e($season) ?>'">ВСЕ СЕРИИ</button>
        <button <?= $episode >= ($season_episodes['number_of_release_episodes'] ?? 1) ? 'disabled' : '' ?> data-href="/anime/<?= e($season) ?>/<?= $episode + 1 ?>" class="next-episode-btn">СЛЕДУЮЩАЯ СЕРИЯ</button>
    </div>
    <div class="episode-controls mobile">
        <button <?= $episode <= 1 ? 'disabled' : '' ?> data-href="/anime/<?= e($season) ?>/<?= $episode - 1 ?>" class="prev-episode-btn">
            <svg class="slider-icon" width="30" height="30">
                <use href="#arrow-left"></use>
            </svg>
        </button>
        <button onclick="window.location.href='/anime/<?= e($season) ?>'">
            <svg class="slider-icon" width="30" height="30">
                <use href="#list-details"></use>
            </svg>
        </button>
        <button <?= $episode >= ($season_episodes['number_of_release_episodes'] ?? 1) ? 'disabled' : '' ?> data-href="/anime/<?= e($season) ?>/<?= $episode + 1 ?>" class="next-episode-btn">
            <svg class="slider-icon" width="30" height="30">
                <use href="#arrow-right"></use>
            </svg>
        </button>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[class$="episode-btn"]:not([disabled])').forEach(btn => {
        btn.addEventListener('click', function() {
            window.location.href = this.dataset.href;
        });
    });


    const buttons = document.querySelectorAll('.subs-and-dubs button');
    const iframe = document.querySelector('iframe');
    

    if (!iframe) {
        buttons.forEach(btn => {
            btn.disabled = true;
            btn.classList.remove('active');
        });
        return;
    }

    const dubBtn = document.querySelector('.subs-and-dubs .dubs');
    const subBtn = document.querySelector('.subs-and-dubs .subs');
    const dubSrc = iframe.dataset.dub || '';
    const subSrc = iframe.dataset.sub || '';

    if (dubSrc && !subSrc) {
        // Только дубляж
        dubBtn.classList.add('active');
        subBtn.disabled = true;
        subBtn.classList.remove('active');
    } else if (!dubSrc && subSrc) {
        subBtn.classList.add('active');
        dubBtn.disabled = true;
        dubBtn.classList.remove('active');
        iframe.src = subSrc;
    } else if (dubSrc && subSrc) {
        buttons.forEach(btn => {
            btn.addEventListener('click', function() {
                if (this.classList.contains('active') || this.disabled) {
                    return;
                }
                
                buttons.forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                
                const type = this.dataset.type;
                const newSrc = iframe.dataset[type];
                
                if (newSrc && newSrc.trim() !== '') {
                    iframe.src = newSrc;
                }
            });
        });
    } else {
        buttons.forEach(btn => {
            btn.disabled = true;
            btn.classList.remove('active');
        });
    }
});
</script>