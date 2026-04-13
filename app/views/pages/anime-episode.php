<?php
$episode_links = execute_query('SELECT has_dub,has_sub FROM anime_episodes WHERE number_of_season=? AND episode_number=?', [$season, $episode], true);
$season_episodes = execute_query('SELECT COUNT(*) as count FROM anime_episodes WHERE number_of_season=?', [$season], true);
$total_episodes = $season_episodes['count'] ?? 0;


$has_dub = !empty($episode_links['has_dub']);
$has_sub = !empty($episode_links['has_sub']);
$initial_type = $has_dub ? 'dub' : ($has_sub ? 'sub' : null);
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
        <button data-type="dub" class="dubs <?= $initial_type === 'dub' ? 'active' : '' ?>" <?= !$has_dub ? 'disabled' : '' ?>>ОЗВУЧКА</button>
        <button data-type="sub" class="subs <?= $initial_type === 'sub' ? 'active' : '' ?>" <?= !$has_sub ? 'disabled' : '' ?>>СУБТИТРЫ</button>
    </div>
    <?php if (!$has_dub && !$has_sub): ?>
        <h1 style="text-align: center;">СЕРИИ ПОКА НЕТ</h1>
    <?php else: ?>
<div class="iframe-wrapper"><iframe
    src="https://dcote.net/player.html?src=https://video.dcote.net/season-<?=$season?>/<?= $initial_type ?>/episode-<?= $episode ?>/master.m3u8&poster=https://video.dcote.net/season-<?= $season ?>/episodes-banner-season<?= $season ?>.webp"
    allow="autoplay; encrypted-media; picture-in-picture; fullscreen"
    allowfullscreen
    referrerpolicy="no-referrer-when-downgrade"
    style="border-radius: var(--fs-border-radius); width: 100%; aspect-ratio: 16/9; border: 0; display: block;padding:0px;"
    loading="lazy"
></iframe></div>
    <?php endif ?>
    <div class="episode-controls">
        <button <?= $episode <= 1 ? 'disabled' : '' ?> data-href="/anime/<?= e($season) ?>/<?= $episode - 1 ?>" class="prev-episode-btn">ПРЕДЫДУЩАЯ СЕРИЯ</button>
        <button onclick="window.location.href='/anime/<?= e($season) ?>'">ВСЕ СЕРИИ</button>
        <button <?= $episode >= ($total_episodes ?? 1) ? 'disabled' : '' ?> data-href="/anime/<?= e($season) ?>/<?= $episode + 1 ?>" class="next-episode-btn">СЛЕДУЮЩАЯ СЕРИЯ</button>
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
        <button <?= $episode >= ($total_episodes ?? 1) ? 'disabled' : '' ?> data-href="/anime/<?= e($season) ?>/<?= $episode + 1 ?>" class="next-episode-btn">
            <svg class="slider-icon" width="30" height="30">
                <use href="#arrow-right"></use>
            </svg>
        </button>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.prev-episode-btn, .next-episode-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            if (this.dataset.href) window.location.href = this.dataset.href;
        });
    });

    const buttons = document.querySelectorAll('.subs-and-dubs button');
    const iframe = document.querySelector('iframe');

    if (!iframe) return;

    buttons.forEach(btn => {
        btn.addEventListener('click', function() {
            if (this.classList.contains('active') || this.disabled) return;

            buttons.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            const type = this.dataset.type;
            let currentSrc = iframe.src;
            
            if (type === 'sub') {
                iframe.src = currentSrc.replace('/dub/', '/sub/');
            } else {
                iframe.src = currentSrc.replace('/sub/', '/dub/');
            }
        });
    });
});
</script>