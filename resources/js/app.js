import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;
//* alpine init
document.addEventListener('alpine:init', () => {
    //! get theme from local storage
    function getTwilightTheme() {
        // if user already changed the theme, use it
        if (window.localStorage.getItem('dark')) {
            return JSON.parse(window.localStorage.getItem('dark'));
        }

        // else return their preferences
        return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    }

    const testUser = {
        name: 'John Doe',
        email: 'john@example.com',
        title: 'Software Engineer',
        title2: 'Web dev',
        status: 'Active',
        role: 'Owner',
    };
    // alpine data
    Alpine.data('twilight', () => ({
        init() {
            this.$refs.loading.classList.add('hidden');
            if (getTwilightTheme()) {
                this.$refs.twilight.classList.add('dark');
            }
        },
        users: [...Array(10).keys()].map(() => testUser),
        toggleTheme() {
            this.$refs.twilight.classList.toggle('dark');
            //! set theme to local storage
            window.localStorage.setItem('dark', !getTwilightTheme());
        },
        // sidebar
        isSideMenuOpen: false,
        isMiniSidebar: false,
        handleMiniSidebar() {
            this.isMiniSidebar = !this.isMiniSidebar;
            document.body.classList.toggle('mini-sidebar');
        },
    }));

    Alpine.store('dropdown', {
        tab: undefined,
    });

    Alpine.data('dropdownItem', idx => ({
        init() {
            this.idx = idx;
        },
        idx: -1,
        handleClick() {
            this.$store.dropdown.tab = this.$store.dropdown.tab == this.idx ? -1 : this.idx;
        },
        handleRotate() {
            return this.$store.dropdown.tab == this.idx ? 'rotate-180' : '';
        },
        activeDropdown() {
            return this.$store.dropdown.tab == this.idx ? 'nav-link-active' : '';
        },
        handleToggle() {
            return this.$store.dropdown.tab == this.idx ? `max-height: ${this.$refs.tab.scrollHeight}px` : '';
        },
    }));
});

window.onload = function () {
    // active scrollbar
    if (typeof PerfectScrollbar !== 'undefined') {
        new PerfectScrollbar('#sidebar-menu', {
            wheelSpeed: 2,
            wheelPropagation: true,
            minScrollbarLength: 20,
        }).update();
    }

    const header = document.getElementById('sticky__header');
    const scrollableContent = document.getElementById('scrollable-content');
    scrollableContent?.addEventListener('scroll', () => {
        // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
        if (scrollableContent.scrollTop > 0) {
            header.classList.add('sticky-header');
        } else {
            header.classList.remove('sticky-header');
        }
    });
};

Alpine.start();
