@include('layouts.navigation')
<x-guest-layout>
    <form method="POST" action="/products/{{ $product->id }}">
        @csrf
        {{method_field('PATCH')}}
        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="$product->name" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="summary" :value="__('Summary')" />
            <x-text-input id="summary" class="block mt-1 w-full" type="text" name="summary" :value="$product->summary" required autocomplete="Summary" />
            <x-input-error :messages="$errors->get('summary')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="days" :value="__('Days')" />
            <x-text-input id="days" class="block mt-1 w-full" type="text" name="days" :value="$product->days_from_now" required autocomplete="days" />
            <x-input-error :messages="$errors->get('days')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ml-4">
                {{ __('Change') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>

<script src="{{ mix('js/app.js') }}"></script>

<script>
    window.Alpine || (window.Alpine = require('alpinejs'));
</script>
