<div>
    <x-breadcrumb title="Quiz" current="Quiz List">
        <x-slot name="button">
            <a href="{{ route('quiz.create') }}"
                class="bg-primary hover:bg-primary-700 py-2 px-4 text-white font-semibold rounded-md">
                Create
            </a>
        </x-slot>
    </x-breadcrumb>
</div>
