<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? '' }} - {{ config('app.name', 'Laravel') }}</title>
    {{-- Fonts --}}
    <link rel="stylesheet" href="{{ asset('fonts/material-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/snackbar/snackbar.min.css') }}">
    {{-- Scripts --}}
    <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    {{ $head ?? '' }}
</head>

<body class="font-sans antialiased">
    <div x-ref="twilight" x-data="twilight">
        <div x-ref="loading" class="loading">Loading.....</div>
        <div class="twilight">
            @include('layouts.navigation', ['currentTab' => $currentTab ?? ''])

            <div id="scrollable-content" class="flex-1 flex flex-col overflow-y-auto overflow-x-hidden">
                <header id="sticky__header" class="top-header">
                    <div class="flex items-center">
                        <button type="button" @click="isSideMenuOpen = !isSideMenuOpen"
                            class="text-gray-500 focus:outline-none lg:hidden">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>
                        <button type="button" @click="handleMiniSidebar()"
                            class="text-gray-500 focus:outline-none hidden lg:block">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </button>
                    </div>

                    <div class="flex items-center space-x-4">
                        <div class="relative">
                            <button type="button" class="header-btn">
                                <svg fill="currentColor" viewBox="0 0 24 24" class="w-4 h-4"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <rect xmlns="http://www.w3.org/2000/svg" opacity="0.5" x="17.0365"
                                        y="15.1223" width="8.15546" height="2" rx="1"
                                        transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path xmlns="http://www.w3.org/2000/svg"
                                        d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                        fill="currentColor" />
                                </svg>
                            </button>
                        </div>

                        <button type="button" @click="toggleTheme" class="header-btn">
                            <svg aria-hidden="true" data-toggle-icon="sun" class="w-4 h-4 dark:flex hidden"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                                    fillRule="evenodd" clipRule="evenodd" />
                            </svg>
                            <svg aria-hidden="true" data-toggle-icon="moon" class="w-4 h-4 dark:hidden flex"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z" />
                            </svg>
                        </button>

                        <div class="relative" x-data="{ isOpen: false }">
                            <button type="button" @click="isOpen = !isOpen" @click.away="isOpen = false"
                                class="header-btn">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                </svg>
                            </button>
                            <div x-show="isOpen">
                                <div
                                    class="absolute right-0 w-72 py-2 mt-5 bg-white rounded-md shadow-lg overflow-hidden z-20">
                                    <div class="py-2">
                                        <a href="/"
                                            class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                                            <img class="h-8 w-8 rounded-full object-cover mx-1"
                                                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80"
                                                alt="avatar" />
                                            <p class="text-gray-600 text-sm mx-2">
                                                <span class="font-bold" href="#"> Sara Salah </span>
                                                replied on the
                                                <span class="font-bold text-blue-500" href="#"> Upload Image
                                                </span>
                                                article . 2m
                                            </p>
                                        </a>
                                        <a href="/"
                                            class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                                            <img class="h-8 w-8 rounded-full object-cover mx-1"
                                                src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=634&q=80"
                                                alt="avatar" />
                                            <p class="text-gray-600 text-sm mx-2">
                                                <span class="font-bold" href="#"> Slick Net </span>
                                                start following you . 45m
                                            </p>
                                        </a>
                                        <a href="/"
                                            class="flex items-center px-4 py-3 border-b hover:bg-gray-100 -mx-2">
                                            <img class="h-8 w-8 rounded-full object-cover mx-1"
                                                src="https://images.unsplash.com/photo-1450297350677-623de575f31c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=334&q=80"
                                                alt="avatar" />
                                            <p class="text-gray-600 text-sm mx-2">
                                                <span class="font-bold" href="#"> Jane Doe </span>
                                                Like Your reply on
                                                <span class="font-bold text-blue-500" href="#"> Test with TDD
                                                </span>article . 1h
                                            </p>
                                        </a>
                                        <a href="/" class="flex items-center px-4 py-3 hover:bg-gray-100 -mx-2">
                                            <img class="h-8 w-8 rounded-full object-cover mx-1"
                                                src="https://images.unsplash.com/photo-1580489944761-15a19d654956?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=398&q=80"
                                                alt="avatar" />
                                            <p class="text-gray-600 text-sm mx-2">
                                                <span class="font-bold" href="#"> Abigail Bennett </span>
                                                start following you . 3h
                                            </p>
                                        </a>
                                    </div>
                                    <a href="/"
                                        class="block mx-4 bg-gray-800 text-white text-center font-bold py-2">
                                        See all notifications
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="relative" x-data="{ isOpen: false }">
                            <button type="button" @click="isOpen = !isOpen" @click.away="isOpen = false"
                                class="relative z-10 block w-8 h-8 overflow-hidden rounded-full shadow focus:outline-none">
                                <img class="object-cover w-full h-full"
                                    src="https://ui-avatars.com/api/?background=random&name={{ Auth::user()->name }}"
                                    alt="Your avatar" />
                            </button>

                            <div x-show="isOpen">
                                <div
                                    class="absolute right-0 z-20 w-64 py-2 mt-5 bg-white dark:bg-dark-primary rounded-md shadow-xl">
                                    <div class="flex border-b dark:border-gray-700 px-4 py-2">
                                        <div class="flex-shrink-0">
                                            <img class="h-8 w-8 rounded-full object-cover"
                                                src="https://ui-avatars.com/api/?background=random&name={{ Auth::user()->name }}"
                                                alt="Your avatar" />
                                        </div>
                                        <div class="ml-3">
                                            <p class="leading-5 font-medium text-gray-900 dark:text-gray-300">
                                                {{ Auth::user()->name }}
                                            </p>
                                            <p class="text-xs leading-5 text-gray-500 dark:text-gray-300">
                                                Software Engineer
                                            </p>
                                        </div>
                                    </div>
                                    <div class="py-2 border-b dark:border-gray-700">
                                        <div class="user-menu-item">
                                            <a href="#" class="user-menu-link"> My Profile </a>
                                        </div>
                                        <div class="user-menu-item">
                                            <a href="#" class="user-menu-link">
                                                My Projects
                                                <span
                                                    class="inline-flex items-center justify-center px-2 py-1 ml-1 text-xs font-bold leading-none text-white bg-primary-600 rounded-full">
                                                    9
                                                </span>
                                            </a>
                                        </div>
                                        <div class="user-menu-item">
                                            <a href="#" class="user-menu-link"> My Subscription </a>
                                        </div>
                                    </div>
                                    <div class="py-2 relative">
                                        <div class="user-menu-item group">
                                            <a href="#" class="user-menu-link">
                                                Language
                                                <span class="text-xs font-bold leading-none flex items-center">
                                                    <img src="{{ asset('images/flags/united-states.svg') }}"
                                                        class="h-4 w-4 mr-2 rounded-full" alt="English" />
                                                    English
                                                </span>
                                                <!-- language dropdown -->
                                                <div
                                                    class="absolute left-0 -m-40 px-2 py-4 space-y-2 hidden group-hover:block w-40 bg-white dark:bg-dark-primary rounded-md shadow-xl">
                                                    <div
                                                        class="flex items-center rounded-md px-4 py-2 hover:bg-gray-100 dark:hover:text-gray-300 hover:dark:bg-dark-secondary dark--text hover:text-primary-600">
                                                        <img src="{{ asset('images/flags/united-states.svg') }}"
                                                            class="h-4 w-4 mr-2 rounded-full" alt="English" />
                                                        <span class="text-xs leading-none">English</span>
                                                    </div>
                                                    <div
                                                        class="flex items-center rounded-md px-4 py-2 hover:bg-gray-100 dark:hover:text-gray-300 hover:dark:bg-dark-secondary dark--text hover:text-primary-600">
                                                        <img src="{{ asset('images/flags/france.svg') }}"
                                                            class="h-4 w-4 mr-2 rounded-full" alt="france" />
                                                        <span class="text-xs leading-none">France</span>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="user-menu-item">
                                            <a href="#" class="user-menu-link"> Account Settings </a>
                                        </div>
                                        <div class="user-menu-item">
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                                    class="user-menu-link">
                                                    Log out
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="flex-1 dark:text-gray-300">
                    <div class="mx-auto px-6 pb-4 pt-2 md:pt-4">
                        <div class="components">
                            {{ $slot }}
                        </div>
                    </div>
                </main>

                <footer
                    class="px-6 py-4 bg-white dark:bg-dark-primary shadow md:flex md:items-center md:justify-between">
                    <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">
                        © 2022 <a href="#" class="hover:underline">Twilight™</a>. All Rights Reserved.
                    </span>
                    <ul class="flex flex-wrap items-center mt-3 text-sm text-gray-500 dark:text-gray-400 sm:mt-0">
                        <li>
                            <a href="#" class="mr-4 hover:underline md:mr-6">About</a>
                        </li>
                        <li>
                            <a href="#" class="mr-4 hover:underline md:mr-6">Privacy Policy</a>
                        </li>
                        <li>
                            <a href="#" class="mr-4 hover:underline md:mr-6">Licensing</a>
                        </li>
                        <li>
                            <a href="#" class="hover:underline">Contact</a>
                        </li>
                    </ul>
                </footer>
            </div>
        </div>
    </div>
    @livewireScripts
    <x-snackbar />
    <x-confirmation-alert />
    {{ $scripts ?? '' }}
</body>

</html>
