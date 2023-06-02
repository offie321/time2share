@include('layouts.navigation')
<x-guest-layout>
    <form method="POST" action="{{ route('products.store') }}"  enctype="multipart/form-data">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="summary" :value="__('Summary')" />
            <x-text-input id="summary" class="block mt-1 w-full" type="text" name="summary" :value="old('summary')" required autocomplete="Summary" />
            <x-input-error :messages="$errors->get('summary')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="days" :value="__('Days')" />
            <x-text-input id="days" class="block mt-1 w-full" type="text" name="days" :value="old('days')" required autocomplete="days" />
            <x-input-error :messages="$errors->get('days')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="image" :value="__('Image')" />
            <input id="image" class="block mt-1 w-full" type="file" name="image" multiple required />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="categorie" :value="__('Categorie')" />
            <x-text-input id="categorie" class="block mt-1 w-full" type="text" name="categorie" :value="old('categorie')" required autocomplete="Categorie" />
            <x-input-error :messages="$errors->get('categorie')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ml-4">
                {{ __('Create') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>

<script src="{{ mix('js/app.js') }}"></script>

<script>
    window.Alpine || (window.Alpine = require('alpinejs'));
</script>
