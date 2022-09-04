<x-app-layout currentTab="dashboard">

    <!-- Breadcrumb -->
    <nav class="flex justify-between items-center md:mb-4 mb-2" aria-label="Breadcrumb">
        <div class="text-gray-700">
            <h3 class="text-base font-medium dark:text-gray-300">Dashboard</h3>
            <ol class="inline-flex items-center space-x-1 md:space-x-1">
                <li class="inline-flex items-center">
                    <a href="#"
                        class="inline-flex items-center text-xs font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        Dashboard
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
                            Default
                        </span>
                    </div>
                </li>
            </ol>
        </div>
    </nav>
    <!-- End Breadcrumb -->

    <div class="block md:grid md:grid-cols-8 lg:grid-cols-4 gap-4 space-y-4 lg:space-y-0 items-end">
        <div class="md:col-span-4 lg:col-span-1 p-4 card dark--text h-48 min-h-full">
            <h3 class="text-xl pb-4">Ratings</h3>
            <div class="flex items-center my-4">
                <h2 class="text-2xl font-semibold dark--text">13k</h2>
                <span class="text-green-500 ml-2">+45%</span>
            </div>
            <span
                class="text-primary-600 bg-primary-600/10 text-sm font-semibold mr-2 px-3 py-1 rounded-xl dark:bg-blue-200 dark:text-blue-800">
                Year of 2021
            </span>
        </div>

        <div class="md:col-span-4 lg:col-span-1 p-4 card dark--text h-48 min-h-full">
            <h3 class="text-xl pb-4">Sessions</h3>
            <div class="flex items-center my-4">
                <h2 class="text-2xl font-semibold dark--text">27k</h2>
                <span class="text-green-500 ml-2">+45%</span>
            </div>
            <span
                class="dark--text bg-gray-200 text-sm font-semibold mr-2 px-3 py-1 rounded-xl dark:bg-blue-200 dark:text-blue-800">
                Last Week
            </span>
        </div>

        <div class="col-span-8 lg:col-span-2">
            <div class="p-4 card dark--text h-48 min-h-full">
                <div class="flex justify-between mb-2">
                    <h3 class="text-xl">Statistics Card</h3>
                    <span
                        class="material-icons active:bg-gray-200 transition-colors ease-in-out duration-200 flex items-center justify-center rounded-full h-8 w-8 cursor-pointer text-gray-400">
                        more_vert
                    </span>
                </div>
                <p>Total 48.5% growth 😎 this month</p>
                <div class="grid grid-cols-3 gap-4 mt-10">
                    <div class="flex items-center space-x-2">
                        <div class="rounded bg-primary-600 p-1 md:p-2 text-white">
                            <span aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" role="img"
                                    aria-hidden="true" fill="currentColor" class="h-6 w-6 md:h-8 md:w-8">
                                    <path
                                        d="M16,6L18.29,8.29L13.41,13.17L9.41,9.17L2,16.59L3.41,18L9.41,12L13.41,16L19.71,9.71L22,12V6H16Z">
                                    </path>
                                </svg>
                            </span>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs mb-0">Sales</p>
                            <h3 class="text-sm md:text-xl font-weight-bold">245k</h3>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="rounded bg-green-600 p-1 md:p-2 text-white">
                            <span aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" role="img"
                                    aria-hidden="true" fill="currentColor" class="h-6 w-6 md:h-8 md:w-8">
                                    <path
                                        d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,6A2,2 0 0,0 10,8A2,2 0 0,0 12,10A2,2 0 0,0 14,8A2,2 0 0,0 12,6M12,13C14.67,13 20,14.33 20,17V20H4V17C4,14.33 9.33,13 12,13M12,14.9C9.03,14.9 5.9,16.36 5.9,17V18.1H18.1V17C18.1,16.36 14.97,14.9 12,14.9Z">
                                    </path>
                                </svg>
                            </span>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs mb-0">Customers</p>
                            <h3 class="text-sm md:text-xl font-weight-bold">15.7kk</h3>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="rounded bg-yellow-400 p-1 md:p-2 text-white">
                            <span aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" role="img"
                                    aria-hidden="true" fill="currentColor" class="h-6 w-6 md:h-8 md:w-8">
                                    <path
                                        d="M16,17H5V7H16L19.55,12M17.63,5.84C17.27,5.33 16.67,5 16,5H5A2,2 0 0,0 3,7V17A2,2 0 0,0 5,19H16C16.67,19 17.27,18.66 17.63,18.15L22,12L17.63,5.84Z">
                                    </path>
                                </svg>
                            </span>
                        </div>
                        <div class="ml-3">
                            <p class="text-xs mb-0">Product</p>
                            <h3 class="text-sm md:text-xl font-weight-bold">1.7kk</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
