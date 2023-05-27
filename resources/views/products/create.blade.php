@include('layouts.navigation')
<x-guest-layout>
    <form method="POST" action="{{ route('products.store') }}">
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


        @foreach($categories as $category)
            <ul class="grid w-full gap-6 md:grid-cols-3">
                <div class="flex items-center">
                    <input checked id="checked-checkbox" type="checkbox" value="" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                    <label for="checked-checkbox" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{ $category->category  }}</label>
                </div>
            </ul>
        @endforeach

        <div class="flex items-center justify-end mt-4">

            <x-primary-button class="ml-4">
                {{ __('Create') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>
