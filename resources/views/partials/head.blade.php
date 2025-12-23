<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'SIAKUP')</title>
    <link rel="icon" href="{{ asset('favicon.png') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @yield('css')
    @vite('resources/css/app.css')
</head>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle menu item highlighting
        const menuItems = document.querySelectorAll('.menu-item a, .submenu-item a');
        menuItems.forEach(item => {
            item.addEventListener('click', function() {
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
                link.addEventListener('click', function(e) {
                    e.preventDefault(); // OK here — this is for the parent that toggles submenu
                    trigger.classList.toggle('active');
                });
            }
        });

        if (localStorage.getItem('flash_type') == 'success') {
            successToast(localStorage.getItem('flash_message'));
        }

        if (localStorage.getItem('flash_type') == 'error') {
            errorToast(localStorage.getItem('flash_message'));
        }

        if (localStorage.getItem('flash_type') == 'warning') {
            warningToast(localStorage.getItem('flash_message'));
        }

        localStorage.removeItem('flash_type');
        localStorage.removeItem('flash_message');
    });

    const appToastTimeout = 5000;

    function successToast(message = null) {
        Swal.fire({
            toast: true,
            position: 'top',
            title: `<span class="swal2-title-custom">${message || 'Berhasil disimpan'}</span>`,
            html: '',
            showConfirmButton: true,
            confirmButtonText: 'Oke',
            background: '#222',
            color: '#fff',
            customClass: {
                popup: 'swal2-toast-custom',
                confirmButton: 'button button-outline',
                title: 'swal2-title-custom'
            },
            buttonsStyling: false,
            timer: appToastTimeout,
            timerProgressBar: true,
            icon: undefined
        });
    }

    function errorToast(message = null) {
        Swal.fire({
            toast: true,
            position: 'top',
            title: `<span class="swal2-title-custom">${message || 'Terjadi kesalahan'}</span>`,
            html: '',
            showConfirmButton: true,
            confirmButtonText: 'Oke',
            background: '#222',
            color: '#fff',
            customClass: {
                popup: 'swal2-toast-custom',
                confirmButton: 'button button-outline',
                title: 'swal2-title-custom'
            },
            buttonsStyling: false,
            timer: appToastTimeout,
            timerProgressBar: true,
            icon: 'error'
        });
    }

    function confirmToast(message = null, callback = null) {
        Swal.fire({
            title: `<span class="swal2-title-custom">${message || 'Apakah Anda yakin?'}</span>`,
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak',
            background: '#222',
            color: '#fff',
            customClass: {
                popup: 'swal2-confirm-custom',
                confirmButton: 'button button-outline',
                cancelButton: 'button button-outline',
                title: 'swal2-title-custom'
            },
            buttonsStyling: false,
            icon: 'warning'
        }).then((result) => {
            if (result.isConfirmed && callback) {
                callback();
            }
        });
    }

    function showLoading() {
        Swal.fire({
            title: 'Loading...',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            },
            background: '#222',
            color: '#fff',
            customClass: {
                popup: 'swal2-loading-custom',
                title: 'swal2-title-custom'
            },
            buttonsStyling: false,
        });
    }

    function warningToast(message = null) {
        Swal.fire({
            toast: true,
            position: 'top',
            title: `<span class="swal2-title-custom">${message || 'Peringatan'}</span>`,
            html: '',
            showConfirmButton: true,
            confirmButtonText: 'Oke',
            background: '#222',
            color: '#fff',
            customClass: {
                popup: 'swal2-toast-custom',
                confirmButton: 'button button-outline',
                title: 'swal2-title-custom'
            },
            buttonsStyling: false,
            timer: appToastTimeout,
            timerProgressBar: true,
            icon: 'warning'
        });
    }
</script>

@yield('javascript')
