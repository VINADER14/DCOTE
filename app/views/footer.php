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
            <img src="images/dcote_logo.png" alt="DCOTE" class="logo scale-in"> </a>
        </div>
    </footer>
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
</script>