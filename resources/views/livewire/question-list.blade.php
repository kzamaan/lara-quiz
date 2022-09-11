<div>
    <!-- Breadcrumb -->
    <nav class="flex justify-between items-center md:mb-4 mb-2" aria-label="Breadcrumb">
        <div class="text-gray-700">
            <h3 class="text-base font-medium dark:text-gray-300">Questions</h3>
            <ol class="inline-flex items-center space-x-1 md:space-x-1">
                <li class="inline-flex items-center">
                    <a href="#"
                        class="inline-flex items-center text-xs font-medium text-gray-500 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white">
                        Questions
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
                            Question List
                        </span>
                    </div>
                </li>
            </ol>
        </div>

        <button wire:click="create"
            class="bg-primary hover:bg-primary-700 py-2 px-4 text-white font-semibold rounded-md">
            Create
        </button>
    </nav>
    <!-- End Breadcrumb -->

    <div class="mt-8">
        <div class="flex flex-col mt-6">
            <div class="py-2 -my-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
                <div
                    class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 dark:border-gray-700 shadow sm:rounded-lg">
                    <table class="min-w-full">
                        <thead
                            class="border-b border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="px-4 py-3 text-xs font-medium leading-4 tracking-wider text-left uppercase">
                                    SL
                                </th>
                                <th class="px-4 py-3 text-xs font-medium leading-4 tracking-wider text-left uppercase">
                                    Question
                                </th>
                                <th class="px-4 py-3 text-xs font-medium leading-4 tracking-wider text-left uppercase">
                                    Answer
                                </th>
                                <th class="px-4 py-3" />
                            </tr>
                        </thead>

                        <tbody class="bg-white dark:bg-gray-800">
                            @foreach ($this->questions as $item)
                                <tr class="border-b border-gray-200 dark:border-gray-700">
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        {{ $this->questions->firstItem() + $loop->index }}
                                    </td>
                                    <td class="px-4 py-4 whitespace-nowrap">
                                        <div class="text-sm leading-5 text-gray-700 dark:text-gray-300">
                                            {{ $item->question }}
                                        </div>
                                        <div class="text-sm leading-5 text-gray-500">
                                            {{ $item->explanation }}
                                        </div>
                                    </td>

                                    <td
                                        class="px-4 py-4 text-sm leading-5 text-gray-500 dark:text-gray-300 whitespace-nowrap">
                                        {{ $item->answer->option ?? '' }}
                                    </td>

                                    <td class="px-4 py-4 text-sm font-medium leading-5 text-right whitespace-nowrap">
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
                                                            wire:click.prevent="questionEdit({{ $item->id }})"
                                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Details</a>
                                                    </li>
                                                    <li>
                                                        <a href="#"
                                                            wire:click.prevent="deleteQuestion({{ $item->id }})"
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
                    <div class="m-4">
                        {{ $this->questions->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-confirmation-alert />

    {{-- question create modal --}}

    <x-dialog-modal wire:model="questionModal" maxWidth="3xl">
        <x-slot name="title">
            {{ $questionIsEdit ? 'Update' : 'Create' }} Question
        </x-slot>

        <x-slot name="content">
            <div class="mb-6">
                <label for="large-input" class="form-label">
                    Question
                    <span class="text-red-500">*</span>
                </label>
                <input type="text" wire:model="question"
                    class="block p-4 w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 sm:text-md focus:ring-primary focus:border-primary dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary">
                @error('question')
                    <span class="error text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="grid grid-cols-2 gap-6">

                @foreach ($options as $i => $option)
                    <div>
                        <label for="base-input" class="form-label">
                            Option {{ $i + 1 }}
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="mb-6">
                            <div class="flex items-center">
                                <input type="radio" class="mr-4" wire:click="correctOption({{ $i }})"
                                    name="correct" {{ $option['is_correct'] ? 'checked' : '' }}>
                                <input type="text" class="form-control"
                                    wire:model="options.{{ $i }}.option">
                            </div>
                            @error('options.' . $i . '.option')
                                <span class="error text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                @endforeach

            </div>

            <div>

                <label for="message"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Explanation</label>
                <textarea id="message" wire:model="explanation" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary focus:border-primary dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary"
                    placeholder="Leave a explanation..."></textarea>

            </div>

        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="$toggle('questionModal')"
                class="bg-red-500 text-white hover:bg-red-600 hover:text-white" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-button>

            <x-button wire:click="{{ $questionIsEdit ? 'update' : 'store' }}" class="ml-3"
                wire:loading.attr="disabled">
                {{ $questionIsEdit ? 'Update' : 'Create' }} Question
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
