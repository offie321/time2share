<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>

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
        <section class="sngl_prod">
            <article class="flex">
                <article>
                    <a class="btn" href="{{ redirect()->getUrlGenerator()->previous() }}">Go back</a>
                    @if(Auth::id() == $product->lender_id)
                        <a class="btn-2" href="/products/{{$product->id}}/edit">Edit</a>
                    @endif
                    <article class="product">
                        <h1>{{ $product->name }}</h1>

                        <a href="{{ route('profile.show', ['id' => $product->lender_id]) }}">
                            <p class="lender_info">Uitgeleend door: {{ $username }}</p>
                            <p>In te leveren binnen <u><b>{{$product->days_from_now}}</b></u> dagen</p>
                        </a>
                        <br>
                        <h3>Omschrijving: </h3>
                        <p>{{ $product->summary }}</p>
                        @if($product->categories != null)
                            <span class="product_categories">{{ $product->categories }}</span>
                        @endif
                    </article>

                    @if(Auth::id() == $product->lender_id || auth()->user()->role == 'admin')
                        <form action="/products/{{ $product->id }}" method="POST">
                            @csrf
                            {{method_field('DELETE')}}
                            <input class="btn-3" type="submit" name="submit" value="Delete">
                        </form>
                    @endif
                    @if($product->borrower_id == Auth::id())
                        <a class="btn" href="/products/{{$product->id}}/return">Return</a>
                    @elseif(Auth::id() != $product->lender_id)
                        <a class="btn" href="/products/{{$product->id}}/lend/{{$product->lender_id}}/{{$product->days_from_now}}">Borrow</a>
                    @endif
                </article>
                <article>
                    <img class="product_image" src="{{ asset('images/' . $product->image) }}" alt="Product Image">
                </article>
            </article>
        </section>
    </main>
</div>

<script src="{{ mix('js/app.js') }}"></script>

<script>
    window.Alpine || (window.Alpine = require('alpinejs'));
</script>
</body>
</html>
