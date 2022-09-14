<div class="bg-white-gray">
    <x-navigation-menu />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- question --}}
        <div class="mt-5 card" x-data="quizTimer">
            <div class="card-header">
                <h3 class="card-title">Skill Assessment</h3>
            </div>
            <div class="card-body">
                <!-- Start of quiz box -->
                @if ($setupQuiz)
                    <button type="button" wire:click="startQuiz"
                        class="block w-full text-white bg-primary border-0 py-2 px-8 focus:outline-none hover:bg-primary-700 rounded text-lg">Start
                        Quiz</button>
                @endif

                @if ($quizInProgress)
                    <div class="flex max-w-auto justify-between">
                        <h1 class="text-sm leading-6 font-medium text-gray-900">
                            <span class="text-gray-400 font-extrabold">{{ $quiz->title }}</span>
                        </h1>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">
                            <span class="text-gray-400 font-extrabold">Quiz Progress </span>
                            <span
                                class="font-bold p-3 leading-loose bg-primary text-white rounded-full">{{ "$count / $quizSize" }}</span>
                        </p>
                    </div>

                    <div x-init="setTimeForQuiz({{ $time_limit }})" class="bg-white shadow overflow-hidden sm:rounded-lg mt-6">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 mb-2 font-medium text-gray-900">
                                <span class="mr-2 font-extrabold"> {{ $count }}.</span>
                                {{ $currentQuestion->question }}

                            </h3>
                            @foreach ($currentQuestion->options as $answer)
                                <label for="question-{{ $answer->id }}">
                                    <div
                                        class="max-w-auto px-3 py-3 m-3 {{ $isOptionDisabled ? 'text-gray-500' : 'text-gray-800' }} rounded-lg border border-gray-300 text-sm ">
                                        <span class="mr-2 font-extrabold">
                                            <x-input-box class="optionId" id="question-{{ $answer->id }}"
                                                value="{{ $answer->id . ',' . $answer->is_correct }}"
                                                wire:model="userAnswered" type="checkbox" :disabled="$isOptionDisabled" />
                                        </span>
                                        {{ $answer->option }}
                                    </div>
                                </label>
                            @endforeach

                        </div>
                        <div class="flex items-center justify-between mt-4 px-4 sm:px-6">
                            <p>
                                <span>Time: </span>
                                <span class="text-red-600" x-text="showRemaningTime"></span>
                                <span>/ {{ gmdate('i:s', $time_limit) }}</span>
                            </p>
                            <button type="button" wire:click="submitTimeOut" id="submitTimeOut"
                                class="hidden"></button>
                            @if ($count < $quizSize)
                                <button wire:click="nextQuestion" type="button"
                                    @click="setTimeForQuiz({{ $time_limit }})"
                                    @if ($isDisabled) disabled='disabled' @endif
                                    class="m-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                    {{ __('Next Question') }}
                                </button>
                            @else
                                <button wire:click="nextQuestion" type="button" @click="stopTimer"
                                    @if ($isDisabled) disabled='disabled' @endif
                                    class="m-4 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 disabled:opacity-25 transition">
                                    {{ __('Show Results') }}
                                </button>
                            @endif
                        </div>

                    </div>

                @endif
                <!-- end of quiz box -->

                @if ($showResult)
                    <section class="text-gray-600 body-font">
                        <div class="bg-white border-1 border-gray-200 shadow overflow-hidden sm:rounded-lg">
                            <div class="container px-5 py-5 mx-auto">
                                <div class="text-center mb-5 justify-center">
                                    <h1
                                        class=" sm:text-3xl text-2xl font-medium text-center title-font text-gray-900 mb-4">
                                        Quiz Result
                                    </h1>
                                    <p class="text-md mt-10"> Dear <span class="font-extrabold text-blue-600 mr-2">
                                            {{ Auth::user()->name . '!' }}
                                        </span> You have secured
                                        <a class="inline-block mr-2 text-primary-600 bg-primary-600/10 text-sm font-semibold mb-2 px-3 py-1 rounded-xl dark:bg-blue-200 dark:text-blue-800"
                                            href="#">
                                            Show quiz details
                                        </a>
                                    </p>
                                    <div class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                        <div class="{{ $quizPercentage > 70 ? 'bg-green-500' : 'bg-red-500' }}  text-xs font-medium text-white text-center p-0.5 leading-none rounded-full"
                                            style="width: {{ $quizPercentage }}%"> {{ $quizPercentage }}%</div>
                                    </div>
                                </div>
                                <div class="flex flex-wrap lg:w-4/5 sm:mx-auto sm:mb-2 -mx-2">
                                    <div class="p-2 sm:w-1/2 w-full">
                                        <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                                            <svg fill=" none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="3"
                                                class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
                                                <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                                <path d="M22 4L12 14.01l-3-3"></path>
                                            </svg>
                                            <span class="title-font font-medium mr-5 text-purple-700">Correct
                                                Answers</span><span
                                                class="title-font font-medium">{{ $currentQuizAnswers }}</span>
                                        </div>
                                    </div>
                                    <div class="p-2 sm:w-1/2 w-full">
                                        <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="3"
                                                class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
                                                <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                                <path d="M22 4L12 14.01l-3-3"></path>
                                            </svg>
                                            <span class="title-font font-medium mr-5 text-purple-700">Total
                                                Questions</span><span
                                                class="title-font font-medium">{{ $totalQuizQuestions }}</span>
                                        </div>
                                    </div>
                                    <div class="p-2 sm:w-1/2 w-full">
                                        <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="3"
                                                class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4" viewBox="0 0 24 24">
                                                <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                                <path d="M22 4L12 14.01l-3-3"></path>
                                            </svg>
                                            <span class="title-font font-medium mr-5 text-purple-700">Percentage
                                                Scored</span><span
                                                class="title-font font-medium">{{ $quizPercentage . '%' }}</span>
                                        </div>
                                    </div>
                                    <div class="p-2 sm:w-1/2 w-full">
                                        <div class="bg-gray-100 rounded flex p-4 h-full items-center">
                                            <svg fill="none" stroke="currentColor" stroke-linecap="round"
                                                stroke-linejoin="round" stroke-width="3"
                                                class="text-indigo-500 w-6 h-6 flex-shrink-0 mr-4"
                                                viewBox="0 0 24 24">
                                                <path d="M22 11.08V12a10 10 0 11-5.93-9.14"></path>
                                                <path d="M22 4L12 14.01l-3-3"></path>
                                            </svg>
                                            <span class="title-font font-medium mr-5 text-purple-700">Quiz
                                                Status</span><span
                                                class="title-font font-medium">{{ $quizPercentage > 70 ? 'Pass' : 'Fail' }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="mx-auto min-w-full p-2 md:flex m-2 justify-between">
                                    <a href="#"
                                        class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">See
                                        Quizzes Details</a>
                                    <a href="#"
                                        class="text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">See
                                        All Your Quizzes</a>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif

            </div>
        </div>
    </div>

    <x-slot name="scripts">
        <script>
            document.addEventListener('alpine:init', () => {
                Alpine.data('quizTimer', () => ({
                    startTimer() {
                        this.timer = setInterval(() => {
                            this.timeLeft--;
                            if (this.timeLeft === 0) {
                                this.stopTimer();
                                document.querySelectorAll('.optionId').forEach((element) => {
                                    element.disabled = true;
                                });
                                document.getElementById('submitTimeOut').click();
                            }
                            console.log('remaning time', this.timeLeft);
                        }, 1000);
                    },
                    stopTimer() {
                        clearInterval(this.timer);
                    },
                    setTimeForQuiz(time) {
                        this.timeLeft = time;
                        this.stopTimer();
                        this.startTimer();
                    },
                    showRemaningTime() {
                        var minutes = Math.floor(this.timeLeft / 60);
                        var seconds = this.timeLeft - minutes * 60;
                        return `${minutes.toString().padStart(2,'0')}:${seconds.toString().padStart(2,'0')}`;
                    },
                    timeLeft: 0,
                    timer: null,
                }))
            })
        </script>
    </x-slot>
</div>
