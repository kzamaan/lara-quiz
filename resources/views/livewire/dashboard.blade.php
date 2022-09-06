<div>
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

    <div class="mt-8">
        <h4 class="text-gray-600 dark:text-gray-300">Redgister User</h4>

        <div class="flex flex-col mt-6">
            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 dark:border-gray-700 shadow sm:rounded-lg">
                    <table class="min-w-full">
                        <thead
                            class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left uppercase">
                                    Name
                                </th>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left uppercase">
                                    Title
                                </th>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left uppercase">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left uppercase">
                                    Role
                                </th>
                                <th class="px-6 py-3" />
                            </tr>
                        </thead>

                        <tbody class="bg-white dark:bg-gray-800">
                            @foreach ($this->users as $user)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 w-10 h-10">
                                                <img class="w-10 h-10 rounded-full"
                                                    src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                                    alt="profile pic" />
                                            </div>

                                            <div class="ml-4">
                                                <div
                                                    class="text-sm font-medium leading-5 text-gray-700 dark:text-gray-300">
                                                    {{ $user->name }}
                                                </div>
                                                <div class="text-sm leading-5 text-gray-500">
                                                    {{ $user->email }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm leading-5 text-gray-700 dark:text-gray-300">
                                            {u.title}
                                        </div>
                                        <div class="text-sm leading-5 text-gray-500">
                                            {u.title2}
                                        </div>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span
                                            class="inline-flex px-2 text-xs font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                            {{ ($user->status == 1 ? 'Approved' : $user->status == 0) ? 'Pending' : 'Rejected' }}
                                        </span>
                                    </td>

                                    <td
                                        class="px-6 py-4 text-sm leading-5 text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                        {u.role}
                                    </td>

                                    <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-nowrap">
                                        <div class="relative" x-data="{ isOpen: false }">
                                            <button id="dropdownDefault" @click="isOpen = !isOpen"
                                                @click.away="isOpen = false"
                                                class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                                type="button">Action<svg class="ml-2 w-4 h-4" aria-hidden="true"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                                </svg></button>
                                            <!-- Dropdown menu -->
                                            <div x-show="isOpen" id="dropdown"
                                                class="absolute top-0 right-0 z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                                <ul class="py-1 text-sm text-gray-700 dark:text-gray-200 text-left"
                                                    aria-labelledby="dropdownDefault">
                                                    <li>
                                                        <a href="#"
                                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Details</a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
