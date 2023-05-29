@include('layouts.navigation')
<x-guest-layout>
    <form action="{{ route('reviews.store', ['lending_id' => $lending->id]) }}" method="POST">
        @csrf

        <input type="hidden" name="lending_id" value="{{ $lending->id }}">

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="rating" :value="__('Rating')" />
            <x-text-input id="rating" class="block mt-1 w-full" type="text" name="rating" :value="old('rating')" required autocomplete="Rating" />
            <x-input-error :messages="$errors->get('rating')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="comment" :value="__('Comment')" />
            <x-text-input id="comment" class="block mt-1 w-full" type="text" name="comment" :value="old('comment')" required autocomplete="Comment" />
            <x-input-error :messages="$errors->get('comment')" class="mt-2" />
        </div>



        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ml-4">
                {{ __('Place Review') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>

<script src="{{ mix('js/app.js') }}"></script>

<script>
    window.Alpine || (window.Alpine = require('alpinejs'));
</script>
