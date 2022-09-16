<div class="bg-white-gray">
    <x-navigation-menu />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- question --}}
        <div class="my-5 card">
            <div class="card-header">
                <h3 class="card-title">Welcome LaraQuiz</h3>
            </div>
            <div class="card-body">

                <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center">
                                    <span class="ml-2">SL</span>
                                </div>
                            </th>
                            <th scope="col" class="py-3 px-6">
                                <span>Title</span>
                            </th>
                            <th scope="col" class="py-3 px-6 w-2/6">
                                Description
                            </th>
                            <th scope="col" class="py-3 px-6">
                                Total Question
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

                                <td class="relative py-4 px-6 flex justify-end items-center">
                                    <a class="text-primary underline" href="{{ route('assessments', $item->slug) }}"
                                        target="_blank">
                                        Start Quiz
                                    </a>
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

                {{ Auth::user() }}

            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            function startQuiz(event) {
                console.log('start quiz', event);
            }
        </script>
    </x-slot>
</div>
