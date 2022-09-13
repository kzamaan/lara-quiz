<aside class="flex">
    <div tabindex="0" role="button" @click="isSideMenuOpen = false" :class="isSideMenuOpen ? 'block' : 'hidden'"
        class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden">
    </div>

    <div class="sidebar" :class="isSideMenuOpen ? 'translate-x-0' : '-translate-x-full'">
        <div class="brand-logo" :class="{ 'justify-center': isMiniSidebar }">
            <a href="{{ route('dashboard') }}" class="flex items-center">
                <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />

                <span class="app-name"> Analyzen </span>
            </a>
            <span @click="isSideMenuOpen = false" class="material-icons sidebar-close"> close </span>
        </div>
        <nav id="sidebar-menu" class="overflow-y-auto h-sidebar" x-init="$store.dropdown.tab = '{{ $currentTab }}'">
            <ul class="nav-menu space-y-2">
                <li class="menu-header">Main Navigation</li>
                <li>
                    <a href="{{ route('quiz') }}"
                        class="nav-link {{ request()->routeIs('quiz') ? 'nav-link-active' : '' }}">
                        <span class="material-icons">quiz</span>
                        <span class="link-label">Quizzes</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('dashboard') }}"
                        class="nav-link {{ request()->routeIs('dashboard') ? 'nav-link-active' : '' }}">
                        <span class="material-icons">dashboard</span>
                        <span class="link-label">Leaderboards</span>
                    </a>
                </li>

                <li class="menu-header">Admin Menu</li>

                <li>
                    <a href="{{ route('quiz') }}"
                        class="nav-link {{ request()->routeIs('quiz') ? 'nav-link-active' : '' }}">
                        <span class="material-icons">quiz</span>
                        <span class="link-label">Quizzes</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('question') }}"
                        class="nav-link {{ request()->routeIs('question') ? 'nav-link-active' : '' }}">
                        <span class="material-icons">question_answer</span>
                        <span class="link-label">Questions</span>
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
