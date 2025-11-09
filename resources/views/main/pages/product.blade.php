@extends('main.layouts.master')

@section('title', $product->title)

@section('style')
    <style>
        .rating input:checked~label,
        .rating label:hover,
        .rating label:hover~label {
            color: #facc15;
        }
        .rating input:checked+label,
        .rating input:checked+label~label {
            color: #facc15;
        }
    </style>
@endsection

@section('content')
    <div class="container mx-auto mt-10 px-4" dir="rtl">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 bg-white shadow-2xl rounded-3xl p-8 border border-gray-100">
            <div class="order-2 md:order-1">
                <div class="overflow-hidden rounded-3xl shadow-lg mb-4 border border-gray-200">
                    <img id="mainImage" src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->title }}"
                        class="w-full h-[450px] object-contain bg-gray-50 transition-transform duration-500 hover:scale-105"> {{-- استفاده از object-contain برای حفظ نسبت تصویر --}}
                </div>

                @if ($product->images && $product->images->count())
                    <div class="flex gap-4 overflow-x-auto pb-2">
                        @foreach ($product->images as $image)
                            <img src="{{ asset('storage/' . $image->path) }}" alt="{{ $image->alt ?? $product->title }}"
                                class="flex-shrink-0 w-24 h-24 object-cover rounded-xl border-2 border-transparent hover:border-blue-500 transition cursor-pointer gallery-thumb shadow-sm"
                                data-full="{{ asset('storage/' . $image->path) }}">
                        @endforeach
                    </div>
                @endif
            </div>

            <div class="flex flex-col justify-start text-right order-1 md:order-2">
                <h1 class="text-4xl font-extrabold text-gray-900 mb-4 border-r-4 border-blue-500 pr-3">{{ $product->title }}</h1>

                @if ($product->short_description)
                    <p class="text-gray-600 leading-relaxed mb-6 pb-4 border-b border-gray-100">{{ $product->short_description }}</p>
                @endif

                <div class="flex items-center justify-end gap-2 mb-4">
                    <span class="text-lg font-bold text-gray-700">۴.۵</span>
                    <div class="flex text-yellow-500">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt text-gray-300"></i>
                    </div>
                    <span class="text-sm text-gray-500">(۱۲۰ نظر)</span>
                </div>


                <div class="mb-8 p-4 bg-gray-50 rounded-xl border border-gray-200">
                    @if ($product->discount_price)
                        <div class="flex items-end justify-end gap-3">
                            <span class="text-gray-400 line-through text-xl font-medium">{{ number_format($product->price) }} تومان</span>
                            <span class="text-red-600 text-4xl font-extrabold">{{ number_format($product->discount_price) }}</span>
                            <span class="text-xl text-red-600 font-bold">تومان</span>
                            <span class="bg-red-500 text-white text-sm font-bold px-3 py-1 rounded-full mr-auto">
                                -{{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                            </span>
                        </div>

                        @if ($product->discount_ends_at)
                            <p class="text-sm text-gray-500 mt-3 text-left">
                                ⏳ تخفیف تا: <span class="font-bold text-red-500">{{ jdate($product->discount_ends_at)->format('Y/m/d H:i') }}</span>
                            </p>
                        @endif
                    @else
                        <div class="flex items-end justify-end gap-1">
                             <span class="text-blue-600 text-4xl font-extrabold">{{ number_format($product->price) }}</span>
                             <span class="text-xl text-blue-600 font-bold">تومان</span>
                        </div>
                    @endif
                </div>

                 @php
            $cart = session('cart', []);
            $inCart = isset($cart[$product->id]);
        @endphp

        @if (!$inCart)
            <form action="{{ route('cart.add') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit"
                    class="block text-center w-full bg-blue-600 text-white py-2 rounded-xl hover:bg-blue-700 transition font-semibold">
                    افزودن به سبد خرید
                </button>
            </form>
        @else
            <form action="{{ route('cart.remove', $product->id) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="block text-center w-full bg-red-500 text-white py-2 rounded-xl hover:bg-red-600 transition font-semibold">
                    حذف از سبد خرید
                </button>
            </form>
        @endif


                <div class="mt-auto pt-6 border-t border-gray-100 text-sm text-gray-500">
                    <span>دسته: </span>
                    <a href="{{ route('category', $product->category->slug) }}" class="text-blue-600 font-semibold hover:underline">
                        {{ $product->category->title }}
                    </a>
                </div>
            </div>
        </div>
        <div class="mt-10 bg-white shadow-2xl rounded-3xl p-8">
            <div class="flex border-b border-gray-200 mb-6">
                <button class="tab-btn px-6 py-3 font-bold text-lg transition duration-300"
                    data-tab="description"
                    style="border-bottom: 2px solid; border-color: #3b82f6; color: #3b82f6;">توضیحات</button>
                <button class="tab-btn px-6 py-3 text-gray-600 font-bold text-lg transition duration-300 hover:text-blue-600"
                    data-tab="reviews"
                    style="border-bottom: 2px solid transparent; color: #4b5563;">نظرات</button>
            </div>

            <div id="description" class="tab-content text-gray-700 leading-relaxed text-base">
                {!! nl2br(e($product->description)) !!}
            </div>

            <div id="reviews" class="tab-content hidden">
                <h3 class="text-2xl font-bold mb-6 text-gray-800 border-r-4 border-blue-500 pr-3">نظرات کاربران (۲ نظر)</h3>
                <div class="space-y-6">
                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl shadow-sm border border-gray-100">
                        <img src="{{ asset('img/defaultPic.png') }}" alt="کاربر" class="w-14 h-14 rounded-full object-cover ring-2 ring-blue-100">
                        <div class="flex-grow">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-gray-800">محمد رضایی</span>
                                <div class="flex text-yellow-500 text-lg">
                                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="far fa-star text-gray-300"></i>
                                </div>
                            </div>
                            <p class="text-gray-700 mt-2">محصول بسیار عالی و با کیفیت بود. حتماً پیشنهاد می‌کنم.</p>
                            <span class="text-xs text-gray-400 mt-1 block">ارسال شده در ۰۱/۰۵/۱۴۰۳</span>
                        </div>
                    </div>

                    <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl shadow-sm border border-gray-100">
                        <img src="{{ asset('img/defaultPic.png') }}" alt="کاربر" class="w-14 h-14 rounded-full object-cover ring-2 ring-blue-100">
                        <div class="flex-grow">
                            <div class="flex items-center justify-between">
                                <span class="font-bold text-gray-800">سارا احمدی</span>
                                <div class="flex text-yellow-500 text-lg">
                                     <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                                </div>
                            </div>
                            <p class="text-gray-700 mt-2">ارسال سریع و بسته‌بندی عالی بود. از خریدم کاملاً راضی هستم.</p>
                             <span class="text-xs text-gray-400 mt-1 block">ارسال شده در ۲۸/۰۴/۱۴۰۳</span>
                        </div>
                    </div>
                </div>

                @auth
                    <div class="mt-10 bg-white border border-gray-200 rounded-2xl p-6 shadow-lg">
                        <h2 class="text-xl font-bold border-r-4 border-blue-500 pr-3 mb-6">ارسال نظر شما</h2>

                        <form method="POST" action="{{ route('comments.store', $product->id) }}" class="space-y-5">
                            @csrf

                            <div class="flex flex-col items-end">
                                <label class="block font-bold text-gray-700 mb-2">امتیاز شما:</label>
                                <div class="flex items-center gap-1 text-gray-400 rating text-4xl">
                                    @for ($i = 5; $i >= 1; $i--)
                                         <input type="radio" name="rating" id="star{{ $i }}"
                                             value="{{ $i }}" class="hidden peer" />
                                         <label for="star{{ $i }}" class="cursor-pointer transition hover:scale-110">★</label>
                                    @endfor
                                </div>
                                @error('rating')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="title" class="block font-bold text-gray-700 mb-2">عنوان نظر</label>
                                <input type="text" name="title" id="title" placeholder="عنوان کوتاه برای نظر شما"
                                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                @error('title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="body" class="block font-bold text-gray-700 mb-2">متن نظر</label>
                                <textarea name="body" id="body" rows="4" placeholder="تجربه خود از خرید این محصول را بنویسید"
                                    class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"></textarea>
                                @error('body')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-xl font-extrabold shadow-lg transition">
                                ارسال نظر
                            </button>
                        </form>
                    </div>
                @else
                    <div class="mt-8 bg-blue-50 border border-blue-200 rounded-2xl p-6 text-center shadow-inner">
                        <p class="text-gray-700 font-medium">برای ارسال نظر، لطفاً <a href="{{ route('login') }}"
                                class="text-blue-600 font-extrabold hover:text-blue-700 underline">وارد شوید</a>.</p>
                    </div>
                @endauth

            </div>
        </div>

        @if ($relatedProducts->count())
            <div class="mt-16">
                <h2 class="text-2xl font-extrabold mb-6 border-r-4 border-blue-500 pr-3 text-gray-900">محصولات مرتبط</h2>
                <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4">
                    @foreach ($relatedProducts as $rp)
                        @include('main.components.productCart', ['product' => $rp])
                    @endforeach
                </div>
            </div>
        @endif

    </div>
@endsection

@section('script')
    <script>
        document.querySelectorAll('.gallery-thumb').forEach(img => {
            img.addEventListener('click', function() {
                document.getElementById('mainImage').src = this.dataset.full;
                document.querySelectorAll('.gallery-thumb').forEach(t => t.classList.remove('border-blue-500'));
                this.classList.add('border-blue-500');
            });
            if (img === document.querySelectorAll('.gallery-thumb')[0]) {
                 img.classList.add('border-blue-500');
            }
        });

        const tabs = document.querySelectorAll('.tab-btn');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => {
                     t.style.borderColor = 'transparent';
                     t.style.color = '#4b5563';
                });
                tab.style.borderColor = '#3b82f6';
                tab.style.color = '#3b82f6';

                contents.forEach(c => c.classList.add('hidden'));
                document.getElementById(tab.dataset.tab).classList.remove('hidden');
            });
        });

        const ratingInputs = document.querySelectorAll('.rating input');
        ratingInputs.forEach(input => {
             input.addEventListener('change', () => {
                document.querySelectorAll('.rating label').forEach(label => label.style.color = '#9ca3af');

                let current = input.nextElementSibling;
                while(current) {
                    current.style.color = '#facc15';
                    current = current.nextElementSibling;
                }
             });
        });

    </script>
@endsection
