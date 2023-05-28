<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    {{--        @vite(['resources/css/app.css', 'resources/js/app.js'])--}}
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
    @include('layouts.navigation')

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white dark:bg-gray-800 shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main>
        <form class="searchbar" action="{{ route('products.index') }}" method="GET">
            <input type="text" name="search" placeholder="Search products...">
            <button type="submit">Search</button>
        </form>


        <section class="products_section">
            @if(count($products) > 0)
                @foreach($products as $product)
                    <article class="product">
                        <a href="/products/{{$product->id}}">
                            <h1>{{ $product->name }}</h1>
                        </a>

                            <p class="lender_info">
                                {{ $product->lender_id }}
                            </p>

                            How many days from now: {{ $product->days_from_now }}

                        <p>{{ $product->summary }}</p>
                        @if($product->categories != null)
                            <span class="product_categories">{{ $product->categories }}</span>
                        @endif

                    </article>
                @endforeach
            @else
                <p>No Products</p>
            @endif
        </section>
    </main>
</div>

<script src="{{ mix('js/app.js') }}"></script>

<script>
    window.Alpine || (window.Alpine = require('alpinejs'));
</script>
</body>
</html>
