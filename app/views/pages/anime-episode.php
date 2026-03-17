<?php
$episode_links = execute_query('SELECT episode_link,episode_link_sub FROM anime_episodes WHERE number_of_season=? AND episode_number=?', [$season, $episode], true);
$season_episodes = execute_query('SELECT number_of_release_episodes FROM anime_seasons WHERE season_number=?', [$season], true);
?>
<div class="navigation-links">
    <a href="/"><span>ГЛАВНАЯ</span></a>
    <p>/</p>
    <a href="/anime"><span>АНИМЕ</span></a>
    <p>/</p>
    <a href="/anime/<?= $season ?>"><span><?= $season ?> СЕЗОН</span></a>
    <p>/</p>
    <a class="current-page" href="/anime/<?= $season ?>/<?= $episode ?>"><span><?= $episode ?> СЕРИЯ</span></a>
</div>
<main class="page-anime-episode">
    <div class="subs-and-dubs">
        <button data-type="dub" class="dubs active">ОЗВУЧКА</button>
        <button data-type="sub" class="subs">СУБТИТРЫ</button>
    </div>
<?php if(empty(e($episode_links['episode_link'])) && empty(e($episode_links['episode_link_sub']))): ?>
    <h1 style="text-align: center;">СЕРИИ ПОКА НЕТ</h1>
<?php else: ?>
    <div style="position: relative; padding-top: 56.25%; width: 100%;border-radius: clamp(1px, 0.65vw, 10px);overflow: hidden;"><iframe data-dub="<?= e($episode_links['episode_link'] ?? '') ?>" data-sub="<?= e($episode_links['episode_link_sub'] ?? '') ?>" src="<?= e($episode_links['episode_link'] ?? '') ?>" allow="autoplay; fullscreen; picture-in-picture; encrypted-media; gyroscope; accelerometer; clipboard-write;" frameborder="0" allowfullscreen style="position: absolute; width: 100%; height: 100%; top: 0; left: 0;"></iframe></div>
<?php endif ?>
    <div class="episode-controls">
        <button <?= $episode == 1 ? 'disabled' : '' ?> data-href='/anime/<?= $season ?>/<?= $episode - 1 ?>' class="prev-episode-btn">ПРЕДЫДУЩАЯ СЕРИЯ</button>
        <button onclick="window.location.href='/anime/<?= $season ?>'">ВСЕ СЕРИИ</button>
        <button <?= $episode == $season_episodes['number_of_release_episodes'] ?? '1' ? 'disabled' : '' ?> data-href='/anime/<?= $season ?>/<?= $episode + 1 ?>' class="next-episode-btn">СЛЕДУЮЩАЯ СЕРИЯ</button>
    </div>
</main>
</body>
<script>
    document.addEventListener('DOMContentLoaded', () => {

        document.querySelectorAll('[class$="episode-btn"]:not([disabled])').forEach(btn => {
            btn.addEventListener('click', function() {
                window.location.href = this.dataset.href;
            });
        });


        const buttons = document.querySelectorAll('.subs-and-dubs button')
        const dubBtn = document.querySelector('.subs-and-dubs .dubs')
        const subBtn = document.querySelector('.subs-and-dubs .subs')
        const iframe='' 
        try{
            const iframe = document.querySelector('iframe')
        } catch {
            return
        }
        if (iframe!==''){
            const dubSrc = iframe.dataset[dubBtn.dataset.type];
            const subSrc = iframe.dataset[subBtn.dataset.type];

            if (dubSrc=='' && subSrc!==''){
                dubBtn.classList.remove('active')
                subBtn.classList.add('active')
                iframe.src = subSrc;
                dubBtn.disabled=true;
            } else if (subSrc=='' && dubSrc!==''){
                subBtn.disabled=true;
            }
            if (subSrc!=='' && dubSrc!==''){
                buttons.forEach(btn => {
                    btn.addEventListener('click', function() {
                        if (this.classList.contains('active')) {
                            return;
                        }
                        buttons.forEach(b => b.classList.remove('active'));
                        this.classList.add('active');
                        const type = this.dataset.type;
                        const newSrc = iframe.dataset[type];
                        if (newSrc && newSrc.trim() !== '') {
                            iframe.src = newSrc;
                        } else {
                            buttons.forEach(b => b.classList.remove('active'));
                            document.querySelector(`.subs-and-dubs button [data-type="${type}"]`)?.classList.add('active');
                        }
                    })
                });
            }
        } else{
            buttons.forEach(btn =>{
                console.log('успех')
                btn.classList.remove('active');
                btn.disabled=true;
            })
        }
    })
</script>