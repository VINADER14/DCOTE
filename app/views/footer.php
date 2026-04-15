    <footer class="footer-nav">
        <div class="footer-left">
            <a href="https://x.com/aandreev06" class="logo-link "><svg class="social-nets-logos" width="50" height="50"><use href="#x-logo"></use></svg></a>
            <a href="/" class="logo-link "><svg class="social-nets-logos" width="50" height="50"><use href="#ds-logo"></use></svg></a>
            <a href="https://t.me/DCOTEFILES" class="logo-link "><svg class="social-nets-logos" width="50" height="50"><use href="#tg-logo"></use></svg></a>
        </div>
        <div class="footer-center">
            <p>Мы не претендуем на авторство и/или какие-либо иные права на какой-либо контент с авторским правом, представленный на сайте.</p>
        </div>
        <div class="footer-right">
            <a href="/"><svg class="main-logo"><use href="#dcote-svg"></use></svg></a>
        </div>
    </footer>
    <navbar class="mobile-bottom-nav">
        <a href="/favorite" class="nav-item">
            <svg class="nav-icon"><use href="#file-star"></use></svg>
            <h2 class="nav-label">Избранное</h2>
        </a>
        <?php if (isset($_SESSION['verified']) && $_SESSION['verified']): ?>
                    <a href="#" class="nav-item">
                        <svg class="nav-icon"><use href="#user"></use></svg>
                        <h2 class="nav-label">Аккаунт</h2>
                    </a>
                    <div class="dropdown" data-dropdown>
                        <div class="drop-menu" data-dropdown-menu>
                            <a href="/account"><img src="/images/menu/user.svg" alt="avatar">Мой аккаунт</a>
                            <a href="/favorites"><img src="/images/menu/file-star.svg" alt="avatar">Избранное</a>
                            <a href="/rules"><img src="/images/menu/info-square.svg" alt="avatar">Правила сайта</a>
                            <a href="/settings"><img src="/images/menu/settings.svg" alt="avatar">Настройки</a>
                            <a href="/logout"><img src="/images/menu/layout-sidebar-right-expand.svg" alt="avatar">Выйти с аккаунта</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="/login" class="nav-item">
                        <svg class="nav-icon"><use href="#user"></use></svg>
                        <h2 class="nav-label">Аккаунт</h2>
                    </a>
                <?php endif; ?>
        <a href="/" class="nav-item">
            <svg class="center-nav-icon"><use href="#dcote-logo-small"></use></svg>
        </a>
        <a href="/favorite" class="nav-item">
            <svg class="nav-icon"><use href="#mail"></use></svg>
            <h2 class="nav-label">Уведомления</h2>
        </a>
        <button class="nav-item button-without-styles" id="hamburgerBtn">
            <svg class="nav-icon"><use href="#stack-2"></use></svg>
            <h2 class="nav-label">Меню</h2>
        </button>
    </navbar>
    <div id="notification-container" class="hidden">
        <h1>ОШИБКА</h1>
        <p></p>
        <div class="shape-close"><svg class="close-icon" stroke-width="3" width="24" height="24"><use href="#close-cross"></use></svg></div>
    </div>
<script>
const hamburger = document.getElementById('hamburgerBtn');
const sideMenu = document.getElementById('sideMenu');
const closeBtn = document.querySelector('.closeMenu');
const overlay = document.getElementById('overlay');


hamburger.addEventListener('click', () => {
    sideMenu.classList.add('open');
    overlay.classList.add('active');
    console.log('sdjhfgahjsgdf')
});

closeBtn.addEventListener('click', () => {
    sideMenu.classList.remove('open');
    overlay.classList.remove('active');
});

overlay.addEventListener('click', () => {
    sideMenu.classList.remove('open');
    overlay.classList.remove('active');
});


function showNotification(message, type = 'error', duration = 5000) {
    const container = document.getElementById('notification-container');
    
    container.classList.remove('hidden', 'hide');
    void container.offsetWidth;

    const title = container.querySelector('h1');
    const text = container.querySelector('p');
    const closeBtn = container.querySelector('.shape-close');
    
    if (type === 'error') {
        container.style.borderColor = 'rgb(229, 11, 85)';
    } else if (type === 'success') {
        title.textContent = '✅ УСПЕШНО';
        container.style.borderColor = 'rgb(46, 204, 113)';
    } else if (type === 'warning') {
        title.textContent = '⚠️ ВНИМАНИЕ';
        container.style.borderColor = 'rgb(243, 156, 18)';
    }

    text.textContent = message;
    closeBtn.onclick = () => {
        hideNotification();
    };
    
    if (duration > 0) {
        if (container.notificationTimer) {
            clearTimeout(container.notificationTimer);
        }
        
        container.notificationTimer = setTimeout(() => {
            hideNotification();
        }, duration);
    }
}

function hideNotification() {
    const container = document.getElementById('notification-container');
    
    container.classList.add('hide');
    
    container.addEventListener('animationend', (e) => {
        container.classList.add('hidden');
        container.classList.remove('hide');
    }, { once: true });
}


function updateNavHeight() {
    const nav = document.querySelector('.mobile-bottom-nav');
    if (!nav) return;

    const height = nav.offsetHeight + 
        (parseInt(getComputedStyle(nav).paddingBottom) || 0);
    
    document.documentElement.style.setProperty('--nav-height', height + 'px');
}

window.addEventListener('load', updateNavHeight);
window.addEventListener('resize', updateNavHeight);
</script>