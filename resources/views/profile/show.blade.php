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
        {{ var_dump($user->blocked) }}
        <section class="sngl_prod">
            @if($errors->any())
                <h4>{{$errors->first()}}</h4>
            @endif
            @if(auth()->user()->role == 'admin' && $user->role == 'user')
                @if($user->blocked == 1)
                        <a class="btn-2" href="/unblock/{{$user->id}}">Unblock this user</a>
                    @else
                <a class="btn-3" href="/block/{{$user->id}}">Block this user</a>
                    @endif
            @endif
            <h1>{{ $user->name }}</h1>
            <p>
                {{ $user->email }}
            </p>
            <hr>
            Aangemaakt op: {{ $user->created_at }}
            <br><br>


{{--            // TODO Change so that this button only displays when user is the same as authenticated user--}}
            <a class="btn-2" href="/profile">
                Gegevens aanpassen
            </a>

{{--            //TODO Alle producten van een gebruiker tonen--}}
            <br>
            <article class="profile_buttons">
                <button id="showProductsButton" class="btn">Show Products</button>
                <button id="showReviewsButton" class="btn">Show Reviews</button>
                {{-- //TODO show only on profile page of user that's logged in --}}
                {{-- //TODO show the status of a product loaned out               --}}
                @if($currentUserId == $user->id)
                <button id="showBorrowedButton" class="btn">Show Borrowed Products</button>
                <button id="showLoanedButton" class="btn">Show Loaned Products</button>
                @endif
            </article>

            <br><br>
            <article class="profile_product_review">
                <div id="reviewsSection" style="display: none;">
                    <!-- Content for reviews -->
                    <h2>Reviews</h2>
                    <section class="profile_products">
                        @if(!empty($reviews))
                            @foreach($reviews as $review)
                                <article class="product">
                                    <h2>{{$review->rating}}</h2>
                                    <p>{{$review->comment}}</p>

                                </article>
                            @endforeach
                        @else
                            <p>This user has no products</p>
                        @endif
                    </section>
                </div>

                <div id="borrowedSection" style="display: none;">
                    <!-- Content for reviews -->
                    <h2>Borrowed</h2>
                    <section class="profile_products">
                        @if(count($borrowed_products) > 0)
                            @foreach($borrowed_products as $product)
                                <article class="product">
                                    <a href="/products/{{$product->id}}">
                                        <h1>{{ $product->name }}</h1>
                                    </a>

                                    <p class="lender_info">
                                        {{ $product->lender_id }}
                                    </p>

                                    <p>{{ $product->summary }}</p>
                                    @if($product->categories != null)
                                        <span class="product_categories">{{ $product->categories }}</span>
                                    @endif

                                </article>
                            @endforeach
                        @else
                            <p>This user has no products</p>
                        @endif
                    </section>
                </div>

                <div id="loanedSection" style="display: none;">
                    <!-- Content for reviews -->
                    <h2>Lendings</h2>
                    <section class="profile_products">
                        <table>
                            <tr>
                                <th>Product</th>
                                <th>Borrowed By</th>
                                <th>Lended By</th>
                                <th>Deadline</th>
                                <th>Status</th>
                                <th></th>
                            </tr>
                            @if(count($userLendings) > 0)
                                @foreach($userLendings as $lending)
                                    <tr>
                                        <td>{{ $lending->product->name }}</td>
                                        <td>{{ $lending->borrower->name }}</td>
                                        <td>{{ $lending->lender->name }}</td>
                                        <td>{{$lending->deadline}}</td>
                                        <td>{{$lending->status}}</td>
                                        @if($lending->status == "Returned")
                                            <td><button class="accept-btn">Accept</button></td>
                                        @else
                                            <td><button class="accept-btn-nw">Product not returned</button></td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <p>This user has no products</p>
                            @endif
                        </table>

                    </section>
                </div>

                <div id="productsSection" style="display: block;">
                    <!-- Content for products -->
                    <h2>Products</h2>
                    <section class="profile_products">
                        @if(!empty($products))
                            @foreach($products as $product)
                                <article class="product">
                                    <a href="/products/{{$product->id}}">
                                        <h1>{{ $product->name }}</h1>
                                    </a>

                                    <p class="lender_info">
                                        {{ $product->lender_id }}
                                    </p>

                                    <p>{{ $product->summary }}</p>
                                    @if($product->categories != null)
                                        <span class="product_categories">{{ $product->categories }}</span>
                                    @endif

                                </article>
                            @endforeach
                        @else
                            <p>This user has no products</p>
                        @endif
                    </section>
{{--                    @if(count($products) > 0)--}}

                </div>

            </article>

        </section>
    </main>
</div>

<script>
    document.getElementById("showReviewsButton").addEventListener("click", function() {
        document.getElementById("reviewsSection").style.display = "block";
        document.getElementById("productsSection").style.display = "none";
        document.getElementById("borrowedSection").style.display = "none";
        document.getElementById("loanedSection").style.display = "none";
    });

    document.getElementById("showProductsButton").addEventListener("click", function() {
        document.getElementById("reviewsSection").style.display = "none";
        document.getElementById("productsSection").style.display = "block";
        document.getElementById("borrowedSection").style.display = "none";
        document.getElementById("loanedSection").style.display = "none";
    });

    document.getElementById("showBorrowedButton").addEventListener("click", function() {
        document.getElementById("reviewsSection").style.display = "none";
        document.getElementById("productsSection").style.display = "none";
        document.getElementById("borrowedSection").style.display = "block";
        document.getElementById("loanedSection").style.display = "none";
    });

    document.getElementById("showLoanedButton").addEventListener("click", function() {
        document.getElementById("reviewsSection").style.display = "none";
        document.getElementById("productsSection").style.display = "none";
        document.getElementById("borrowedSection").style.display = "none";
        document.getElementById("loanedSection").style.display = "block";
    });


</script>

<script src="{{ mix('js/app.js') }}"></script>

<script>
    window.Alpine || (window.Alpine = require('alpinejs'));
</script>
</body>
</html>
