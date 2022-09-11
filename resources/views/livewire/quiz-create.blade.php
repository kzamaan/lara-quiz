<div>
    <x-breadcrumb title="Quiz" current="Create Quiz">
        <x-slot name="button">
            <a href="{{ route('quiz') }}"
                class="bg-primary hover:bg-primary-700 py-2 px-4 text-white font-semibold rounded-md">
                Back
            </a>
        </x-slot>
    </x-breadcrumb>

    <x-slot name="head">
        <link rel="stylesheet" href="{{ asset('plugins/select2/select2.min.css') }}">
    </x-slot>


    <form wire:submit.prevent="store">

        <div class="mb-6">
            <label class="form-label">Title</label>
            <input type="text" wire:model="title" class="form-control">
            @error('title')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label class="form-label">Slug</label>
            <input type="text" wire:model="slug" class="form-control">
            @error('slug')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label class="form-label">
                Question
            </label>

            <select class="select2 js-states form-control" multiple="multiple">
                @foreach ($this->topics as $topic)
                    <optgroup label="{{ $topic->name }}">
                        @foreach ($topic->questions as $question)
                            <option value="{{ $question->id }}">{{ $question->question }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>
            @error('selectedQuestions')
                <span class="error text-red-500">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-6">
            <label for="message" class="form-label">Description</label>
            <textarea id="message" rows="5" class="form-control" placeholder="Leave a description..."></textarea>
        </div>

        <div class="space-x-4">
            <x-button type="submit" wire:loading.attr="disabled" class="bg-primary">
                Save
            </x-button>

            <x-button class="bg-red-500 text-white hover:bg-red-600 hover:text-white" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-button>
        </div>

    </form>

    <x-slot name="scripts">
        <script src="{{ asset('plugins/jQuery/jquery.min.js') }}"></script>
        <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>
        <script>
            $(function() {
                $('.select2').select2({
                    placeholder: "Choose Questions",
                    allowClear: true,
                })
            })
        </script>
    </x-slot>
</div>
