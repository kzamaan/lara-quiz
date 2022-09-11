@props(['title' => 'Dashboard', 'current' => 'default'])
<!-- Breadcrumb -->
<nav class="flex justify-between items-center md:mb-4 mb-2" aria-label="Breadcrumb">
    <div class="text-gray-700">
        <h3 class="text-base font-medium dark:text-gray-300">{{ $title }}</h3>
        <ol class="inline-flex items-center space-x-1 md:space-x-1">
            <li class="inline-flex items-center">
                <a href="#"
                    class="inline-flex items-center text-xs font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                    {{ $title }}
                </a>
            </li>

            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-4 h-4 text-gray-500" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="ml-1 text-xs font-medium text-gray-500 md:ml-2 dark:text-gray-400">
                        {{ $current }}
                    </span>
                </div>
            </li>
        </ol>
    </div>

    @isset($button)
        {{ $button }}
    @endisset
</nav>
<!-- End Breadcrumb -->
