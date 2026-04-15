document.addEventListener('click', function (e) {
    const toggle = e.target.closest('[data-mobile-dropdown-toggle]');

    if (toggle) {
        const dropdown = toggle.closest('[data-mobile-dropdown]');
        const menu = dropdown.querySelector('[data-mobile-dropdown-menu]');

        menu.classList.toggle('open');
        return;
    }

    document.querySelectorAll('[data-mobile-dropdown]').forEach(dropdown => {
        if (!dropdown.contains(e.target)) {
            const menu = dropdown.querySelector('[data-mobile-dropdown-menu]');
            menu.classList.remove('open');
        }
    });
});