<div>
    <x-breadcrumb title="Quiz" current="Quiz List">
        <x-slot name="button">
            <x-button type="button" wire:click="$toggle('quizModal')">
                Create
            </x-button>
        </x-slot>
    </x-breadcrumb>

    <div class="shadow-md sm:rounded-lg border border-gray-200 bg-white">
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

            <x-search-input wire:model="searchKey" />

        </div>

        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <x-input-box wire:model="selectedPage" type="checkbox" />
                            <span class="ml-2">SL</span>
                        </div>
                    </th>
                    <th scope="col" class="py-3 px-6">
                        <span>Title</span>
                        <button type="button" wire:click.prevent="sortBy('title')">
                            <svg xmlns="http://www.w3.org/2000/svg" class="ml-1 w-3 h-3" aria-hidden="true"
                                fill="currentColor" viewBox="0 0 320 512">
                                <path
                                    d="M27.66 224h264.7c24.6 0 36.89-29.78 19.54-47.12l-132.3-136.8c-5.406-5.406-12.47-8.107-19.53-8.107c-7.055 0-14.09 2.701-19.45 8.107L8.119 176.9C-9.229 194.2 3.055 224 27.66 224zM292.3 288H27.66c-24.6 0-36.89 29.77-19.54 47.12l132.5 136.8C145.9 477.3 152.1 480 160 480c7.053 0 14.12-2.703 19.53-8.109l132.3-136.8C329.2 317.8 316.9 288 292.3 288z" />
                            </svg>
                        </button>
                    </th>
                    <th scope="col" class="py-3 px-6 w-2/6">
                        Description
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Total Question
                    </th>
                    <th scope="col" class="py-3 px-6">
                        Status
                    </th>

                    <th scope="col" class="py-3 px-6 flex justify-end"></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($this->quizzes as $item)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="p-4 w-4">
                            <div class="flex items-center">
                                <x-input-box wire:model="selectedItem" type="checkbox" name="select"
                                    value="{{ $item->id }}" />

                                <span class="ml-2">
                                    {{ $this->quizzes->firstItem() + $loop->index }}
                                </span>
                            </div>
                        </td>
                        <th scope="row"
                            class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->title }}
                        </th>
                        <td class="py-4 px-6 w-2/6 text-ellipsis">
                            {{ $item->description }}
                        </td>
                        <td class="py-4 px-6">
                            {{ $item->questions_count }}
                        </td>
                        <td class="py-4 px-6">
                            @if ($item->status)
                                <span
                                    class="inline-block mr-2 text-primary-600 bg-primary-600/10 text-sm font-semibold mb-2 px-3 py-1 rounded-xl dark:bg-blue-200 dark:text-blue-800">Publish</span>
                            @else
                                <span
                                    class="inline-block mr-2 text-white bg-red-400 text-sm font-semibold mb-2 px-3 py-1 rounded-xl dark:bg-blue-200 dark:text-blue-800">Unpublish</span>
                            @endif
                        </td>
                        <td class="relative py-4 px-6 flex justify-end">
                            <x-dropdown align="right">
                                <x-slot name="trigger">
                                    <button type="button">
                                        <span class="material-icons">
                                            more_vert
                                        </span>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    <x-dropdown-link class="cursor-pointer">Edit</x-dropdown-link>
                                    <x-dropdown-link class="cursor-pointer"
                                        class="w-full text-left py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                        View</x-dropdown-link>
                                    @if ($item->status)
                                        <x-dropdown-link class="cursor-pointer"
                                            href="{{ route('assessments', $item->slug) }}" target="_blank">
                                            Start Quiz
                                        </x-dropdown-link>
                                    @endif
                                    <x-dropdown-link class="cursor-pointer"
                                        wire:click="toggleQuizStatus({{ $item->id }})">
                                        @if ($item->status)
                                            <span>Unpublish</span>
                                        @else
                                            <span>Publish</span>
                                        @endif
                                    </x-dropdown-link>
                                    <x-dropdown-link class="cursor-pointer"
                                        wire:click="deleteQuiz({{ $item->id }})">Delete</x-dropdown-link>
                                </x-slot>
                            </x-dropdown>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4">No data found</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
        <div class="m-4">
            {{ $this->quizzes->links() }}
        </div>
    </div>

    {{-- quiz create modal --}}

    <x-dialog-modal wire:model="quizModal" maxWidth="3xl">
        <x-slot name="title">
            Create Quiz
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                <label class="form-label">Title</label>
                <input type="text" wire:model="title" class="form-control">
                @error('title')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label">Slug</label>
                <input type="text" wire:model="slug" class="form-control">
                @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4 relative" x-data="{ isOpen: false }">
                <label class="form-label">
                    Question
                </label>

                <div class="form-control cursor-pointer" @click="isOpen = true">
                    @forelse ($this->selectedQuestions as $item)
                        <span
                            class="inline-block mr-2 text-primary-600 bg-primary-600/10 text-sm font-semibold mb-2 px-3 py-1 rounded-xl dark:bg-blue-200 dark:text-blue-800">
                            <div class="flex items-center">
                                {{ $item->question }}
                                <span class="material-icons"
                                    wire:click="removeQuestion({{ $item->id }})">close</span>
                            </div>
                        </span>
                    @empty
                        <span class="text-gray-400">Select Question</span>
                    @endforelse
                </div>

                <!-- Dropdown menu -->
                <div x-show="isOpen" @click.away="isOpen = false"
                    class="z-10 w-full absolute max-h-[300px] overflow-y-auto inset-auto bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="p-3 space-y-3 text-sm text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownCheckboxButton">
                        @foreach ($this->topics as $topic)
                            <li class="space-y-2">
                                <p class="text-2xl">{{ $topic->name }}</p>
                                @foreach ($topic->questions as $question)
                                    <div class="flex items-center">
                                        <input wire:model="questions" value="{{ $question->id }}"
                                            id="checkbox-item-{{ $question->id }}" type="checkbox"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                        <label for="checkbox-item-{{ $question->id }}"
                                            class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $question->question }}</label>
                                    </div>
                                @endforeach
                            </li>
                        @endforeach
                    </ul>
                </div>

                @error('questions')
                    <span class="error text-red-500">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="message" class="form-label">Description</label>
                <textarea id="message" wire:model="description" rows="5" class="form-control"
                    placeholder="Leave a description..."></textarea>
            </div>

            <div class="mb-4">
                <label class="form-label">Time Limit Per Question</label>
                <input type="number" wire:model="time_limit" class="form-control">
                @error('time_limit')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>


            <div class="mb-4">
                <label class="form-label">Status</label>
                <div class="flex space-x-4">
                    <div class="flex items-center">
                        <input id="radio-1" type="radio" name="status" wire:model="status" value="1"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="radio-1"
                            class="ml-2 text-sm font-medium text-gray-800 dark:text-gray-500">Publish</label>
                    </div>
                    <div class="flex items-center">
                        <input id="radio-2" type="radio" name="status" wire:model="status" value="0"
                            class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                        <label for="radio-2"
                            class="ml-2 text-sm font-medium text-gray-800 dark:text-gray-500">Unpublish</label>
                    </div>
                </div>
                @error('status')
                    <span class="error text-red-500">{{ $message }}</span>
                @enderror
            </div>

        </x-slot>

        <x-slot name="footer">
            <x-button color="danger" wire:click="$toggle('quizModal')" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-button>

            <x-button class="ml-3" wire:click="store" wire:loading.attr="disabled">
                Create Quiz
            </x-button>
        </x-slot>

    </x-dialog-modal>
</div>
