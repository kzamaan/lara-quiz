<aside class="flex">
    <div tabindex="0" role="button" @click="isSideMenuOpen = false" :class="isSideMenuOpen ? 'block' : 'hidden'"
        class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden">
    </div>

    <div class="sidebar" :class="isSideMenuOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="brand-logo" :class="{ 'justify-center': isMiniSidebar }">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <svg class="w-12 h-12" viewBox="0 0 512 512" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
                        fill="#4C51BF" stroke="#4C51BF" strokeWidth="2" strokeLinecap="round" strokeLinejoin="round" />
                    <path
                        d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
                        fill="white" />
                </svg>

                <span class="app-name"> Analyzen </span>
            </a>
            <span @click="isSideMenuOpen = false" class="material-icons sidebar-close"> close </span>
        </div>
        <nav id="sidebar-menu" class="overflow-y-auto h-sidebar" x-init="$store.dropdown.tab = '{{ $currentTab }}'">
            <ul class="nav-menu space-y-2">

                <li>
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : '' }}">
                        <span class="material-icons">dashboard</span>
                        <span class="link-label">Leaderboards</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('question') }}" class="nav-link">
                        <span class="material-icons">question_answer</span>
                        <span class="link-label">Questions</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('quiz') }}"
                        class="nav-link {{ request()->routeIs('quiz') ? 'nav-link-active' : '' }}">
                        <span class="material-icons">quiz</span>
                        <span class="link-label">Quizzes</span>
                    </a>
                </li>

                <li>
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <span class="material-icons">history</span>
                        <span class="link-label">Tests Result</span>
                    </a>
                </li>


                <li>
                    <a href="{{ route('dashboard') }}" class="nav-link">
                        <span class="material-icons">workspaces</span>
                        <span class="link-label">User Management</span>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
