document.addEventListener('click', function (e) {
    const toggle = e.target.closest('[data-dropdown-toggle]');

    if (toggle) {
        const dropdown = toggle.closest('[data-dropdown]');
        const menu = dropdown.querySelector('[data-dropdown-menu]');

        menu.classList.toggle('open');
        return;
    }

    document.querySelectorAll('[data-dropdown]').forEach(dropdown => {
        if (!dropdown.contains(e.target)) {
            const menu = dropdown.querySelector('[data-dropdown-menu]');
            menu.classList.remove('open');
        }
    });
});