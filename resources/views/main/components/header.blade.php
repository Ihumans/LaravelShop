<header
    class="sticky top-0 z-20 w-full   py-4 border-b border-gray-200 bg-white/80 backdrop-blur-sm transition-all duration-300">
    <div class="flex justify-between items-center max-w-[1260px] mx-auto">
        <a href="{{ route('home') }}">
            <img class="h-8" src="{{ asset('/img/logo.png') }}" alt="site logo">
        </a>

        <nav class="hidden lg:flex items-center gap-6">
            <a href="{{ route('home') }}" class="font-bold text-gray-700 hover:text-blue-600 transition-colors">خانه</a>
            <a href="{{ route('products') }}"
                class="font-bold text-gray-700 hover:text-blue-600 transition-colors">محصولات</a>
            <a href="{{ route('blogs') }}"
                class="font-bold text-gray-700 hover:text-blue-600 transition-colors">بلاگ</a>
            <a href="{{ route('about') }}" class="font-bold text-gray-700 hover:text-blue-600 transition-colors">درباره
                ما</a>
        </nav>

        <div class="flex items-center gap-4">
            <button class="text-gray-600 hover:text-blue-600 text-xl">
                <i class="fas fa-search"></i>
            </button>
            @php
                $cart = session('cart', []);
            @endphp
            <a href="{{ route('cart.index') }}" class="relative text-gray-600 hover:text-blue-600 text-xl">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 0 0-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 0 0-16.536-1.84M7.5 14.25 5.106 5.272M6 20.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Zm12.75 0a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>

                <span
                    class="absolute -top-2 -left-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">{{ count($cart) }}</span>
            </a>

            @include('main.components.authButton')

            <button class="lg:hidden text-gray-600 hover:text-blue-600 text-xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
</header>
