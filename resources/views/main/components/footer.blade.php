<footer class="bg-gray-900 text-gray-300 mt-20 border-t border-gray-800" dir="rtl">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="py-12 grid grid-cols-2 md:grid-cols-5 gap-10">

            <div class="text-right col-span-2 md:col-span-1">
                <a href="{{ route('home') }}">
                    <img class="h-8 mb-4" src="{{ asset('/img/logo.png') }}" alt="site logo">
                </a>
                <p class="text-gray-400 text-sm leading-relaxed">
                    این فروشگاه تلاش می‌کند تا بهترین تجربه خرید آنلاین را برای شما فراهم کند. کیفیت و رضایت مشتری اولویت ماست.
                </p>
            </div>

            <div class="text-right">
                <h3 class="text-lg font-bold text-white mb-4">لینک‌های سریع</h3>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('home') }}" class="hover:text-blue-500 transition">خانه</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-blue-500 transition">درباره ما</a></li>
                    <li><a href="{{ route('products') }}" class="hover:text-blue-500 transition">محصولات</a></li>
                    <li><a href="#" class="hover:text-blue-500 transition">تماس با ما</a></li>
                </ul>
            </div>

            <div class="text-right">
                <h3 class="text-lg font-bold text-white mb-4">دسته‌بندی‌ها</h3>
                <ul class="space-y-3 text-sm">
                    @foreach (\App\Models\Category::whereNull('parent_id')->take(5)->get() as $category)
                        <li>
                            <a href="{{ route('category', $category->slug) }}" class="hover:text-blue-500 transition">
                                {{ $category->title }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="text-right col-span-2 md:col-span-2">
                <h3 class="text-lg font-bold text-white mb-4">ما را دنبال کنید و عضو خبرنامه شوید</h3>
                <div class="flex gap-4 mb-6 justify-end">
                    <a href="#" class="hover:text-blue-500 transition text-2xl"><i class="fab fa-telegram-plane"></i></a>
                    <a href="#" class="hover:text-red-600 transition text-2xl"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="hover:text-blue-500 transition text-2xl"><i class="fab fa-twitter"></i></a>
                </div>

                <form action="#" class="flex gap-2 justify-end">
                    <input type="email" placeholder="ایمیل خود را وارد کنید"
                        class="w-full px-4 py-2 rounded-lg text-gray-900 focus:ring-2 focus:ring-blue-500 border-none transition placeholder-gray-500">
                    <button type="submit"
                        class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium text-sm whitespace-nowrap">عضویت</button>
                </form>
            </div>

        </div>

        <div class="border-t border-gray-800 py-4 text-center text-gray-500 text-xs">
            © 2025 تمامی حقوق این سایت محفوظ است | طراحی شده با <span class="text-red-500">❤️</span> توسط <a href="#" class="hover:text-blue-500">تیم شما</a>
        </div>
    </div>
</footer>
