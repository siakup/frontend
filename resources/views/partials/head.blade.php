<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'SIAKAD')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @yield('css')
</head>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Handle menu item highlighting
    const menuItems = document.querySelectorAll('.menu-item a, .submenu-item a');
    menuItems.forEach(item => {
        item.addEventListener('click', function () {
            menuItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');

            const parentSubmenu = this.closest('.submenu');
            if (parentSubmenu) {
                const parentMenuItem = parentSubmenu.closest('.has-submenu');
                if (parentMenuItem) parentMenuItem.classList.add('active');
            }
        });
    });

    // Expand submenu if child is active
    const activeSubmenuItem = document.querySelector('.submenu-item a.active');
    if (activeSubmenuItem) {
        const parentMenu = activeSubmenuItem.closest('.has-submenu');
        if (parentMenu) parentMenu.classList.add('active');
    }

    // Toggle submenus
    const submenuTriggers = document.querySelectorAll('.has-submenu');
    submenuTriggers.forEach(trigger => {
        const link = trigger.querySelector('.menu-link'); // the actual <a> or button

        if (link) {
            link.addEventListener('click', function (e) {
                e.preventDefault(); // OK here — this is for the parent that toggles submenu
                trigger.classList.toggle('active');
            });
        }
    });
});
</script>

@yield('javascript')