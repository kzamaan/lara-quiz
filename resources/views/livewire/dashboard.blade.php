<div>
    <x-breadcrumb title="Dashboard" current="Leaderboards" />

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
                                            <div class="text-sm font-medium leading-5 text-gray-700 dark:text-gray-300">
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
                                    {{ Str::ucfirst($user->type) }}
                                </td>

                                <td class="px-6 py-4 text-sm font-medium leading-5 text-right whitespace-nowrap">
                                    <div class="relative" x-data="{ isOpen: false }">
                                        <x-button id="dropdownDefault" @click="isOpen = !isOpen"
                                            @click.away="isOpen = false" type="button">
                                            Action
                                            <svg class="ml-2 w-4 h-4" aria-hidden="true" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </x-button>
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
