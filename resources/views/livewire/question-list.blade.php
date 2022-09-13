<div>
    <x-breadcrumb title="Question List" current="Question List">
        <x-slot name="button">
            <x-button wire:click="create">
                Create
            </x-button>
        </x-slot>
    </x-breadcrumb>

    <div class="overflow-x-auto relative shadow-md sm:rounded-lg border border-gray-200 bg-white">
        <div class="flex justify-between items-center p-4">
            <div class="flex items-center space-x-4">
                <div class="flex items-center">
                    <label for="perPage" class="text-sm text-gray-600">Show</label>
                    <select wire:model="perPage" id="perPage" class="mx-2 form-control min-w-[80px] px-4 py-1.5">
                        <option value="10">10</option>
                        <option value="15">15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <label for="perPage" class="text-sm text-gray-600">entries</label>
                </div>

                <div class="flex items-center space-x-4">
                    <x-button color="light" type="button">
                        csv
                    </x-button>
                    <x-button color="light" type="button">
                        Xslx
                    </x-button>
                    <x-button color="light" type="button">
                        PDF
                    </x-button>
                </div>
            </div>

            <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" aria-hidden="true" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                            clip-rule="evenodd"></path>
                    </svg>
                </div>
                <input type="text" id="table-search" wire:model="searchKey"
                    class="block p-2 pl-10 w-80 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Search for items">
            </div>
        </div>

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input wire:model="selectedPage" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                            <span class="ml-2">SL</span>
                        </div>
                    </th>
                    <th scope="col" class="py-3 px-6">
                        <div class="flex items-center">
                            <span>Question</span>
                            <button type="button" wire:click.prevent="sortBy('question')">
                                <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-3 h-3" aria-hidden="true"
                                    fill="currentColor" viewBox="0 0 320 512">
                                    <path
                                        d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                                </svg>
                            </button>
                        </div>
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Answer
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Topic
                    </th>
                    <th scope="col" class="py-3 px-6 flex justify-end"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($this->questions as $item)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="p-4 w-4">
                            <div class="flex items-center">
                                <input wire:model="selectedItem" type="checkbox" name="select"
                                    value="{{ $item->id }}"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

                                <span class="ml-2">
                                    {{ $this->questions->firstItem() + $loop->index }}
                                </span>
                            </div>
                        </td>
                        <th scope="row"
                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->question }}
                        </th>
                        <td class="py-4 px-6">
                            {{ $item->answer->option ?? '' }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $item->topic->name ?? '' }}
                        </td>
                        <td class="py-4 px-6 flex justify-end">
                            <div class="relative" x-data="{ isOpen: false }">
                                <button @click="isOpen = !isOpen" @click.away="isOpen = false" type="button">
                                    <span class="material-icons">
                                        more_vert
                                    </span>
                                </button>
                                <!-- Dropdown menu -->
                                <div x-show="isOpen" id="dropdown"
                                    class="absolute top-0 right-0 z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700">
                                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200 text-left"
                                        aria-labelledby="dropdownDefault">
                                        <li>
                                            <button type="button" wire:click="questionEdit({{ $item->id }})"
                                                class="w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Edit</button>
                                        </li>
                                        <li>
                                            <button type="button"
                                                class="w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">View</button>
                                        </li>
                                        <li>
                                            <button type="button" wire:click="deleteQuestion({{ $item->id }})"
                                                class="w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Delete</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4">No data found</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <div class="m-4">
            {{ $this->questions->links() }}
        </div>
    </div>

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
            <div class="my-6">
                <label for="large-input" class="form-label">
                    Topic
                    <span class="text-red-500">*</span>
                </label>
                <select wire:model="topic_id"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="">Select Topic</option>
                    @foreach ($this->topics as $topic)
                        <option value="{{ $topic->id }}">{{ $topic->name }}</option>
                    @endforeach
                </select>
                @error('topic_id')
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
            <x-button color="danger" wire:click="$toggle('questionModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-button>

            <x-button wire:click="{{ $questionIsEdit ? 'update' : 'store' }}" class="ml-3"
                wire:loading.attr="disabled">
                {{ $questionIsEdit ? 'Update' : 'Create' }} Question
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
