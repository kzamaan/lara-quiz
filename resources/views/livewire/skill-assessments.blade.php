<div class="bg-white-gray">
    <x-navigation-menu />

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- question --}}
        <div class="mt-5 card">
            <p class="card-header text-2xl text-center">
                {{ $quiz->title }}
            </p>
            <p class="card-header">
                {{ $quiz->title }}
            </p>
            <div class="card-body">
                {{ $quiz->questions }}
            </div>
        </div>
    </div>
</div>
