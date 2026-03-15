    <footer class="footer-nav">
        <div class="footer-left">
            <a href="https://x.com/aandreev06" class="logo-link scale-in"><svg class="social-nets-logos" width="50" height="50"><use href="#x-logo"></use></svg></a>
            <a href="/dcote_main" class="logo-link scale-in"><svg class="social-nets-logos" width="50" height="50"><use href="#ds-logo"></use></svg></a>
            <a href="https://t.me/DCOTEFILES" class="logo-link scale-in"><svg class="social-nets-logos" width="50" height="50"><use href="#tg-logo"></use></svg></a>
        </div>
        <div class="footer-center scale-in">
            <p>Мы не претендуем на авторство и/или какие-либо иные права на какой-либо контент с авторским правом, представленный на сайте.</p>
        </div>
        <div class="footer-right">
            <a href="/dcote_main" class="logo-link">
            <img src="/images/dcote_logo.png" alt="DCOTE" class="logo scale-in"> </a>
        </div>
    </footer>
    <div id="notification-container" class="hidden">
        <h1>ОШИБКА</h1>
        <p>Какойзто текст ошибки</p>
        <div class="shape-close"><svg class="close-icon" stroke-width="3" width="24" height="24"><use href="#close-cross"></use></svg></div>
    </div>
<script>
const hamburger = document.getElementById('hamburgerBtn');
const sideMenu = document.getElementById('sideMenu');
const closeBtn = document.getElementById('closeMenu');
const overlay = document.getElementById('overlay');

hamburger.addEventListener('click', () => {
    sideMenu.classList.add('open');
    overlay.classList.add('active');
});

closeBtn.addEventListener('click', () => {
    sideMenu.classList.remove('open');
    overlay.classList.remove('active');
});

overlay.addEventListener('click', () => {
    sideMenu.classList.remove('open');
    overlay.classList.remove('active');
});

if (!('IntersectionObserver' in window)) {
document
    .querySelectorAll('.scale-in, .slide-in-left, .slide-in-right, .slide-in-top')
    .forEach(el => el.classList.add('show'));
} else {
const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
    if (entry.isIntersecting) {
        entry.target.classList.add('show');
        observer.unobserve(entry.target);
    }
    });
}, { threshold: 0.1 });
document
    .querySelectorAll('.scale-in, .slide-in-left, .slide-in-right, .slide-in-top')
    .forEach(el => observer.observe(el));
}

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
</script>