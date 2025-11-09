@extends('main.layouts.master')

@section('title', 'سبد خرید')

@section('content')
    <div class="container mx-auto py-12 px-4" dir="rtl">

        <h1 class="text-3xl font-extrabold text-gray-900 mb-8 border-r-4 border-blue-500 pr-3">سبد خرید شما</h1>

        @if (count($cart))

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <div class="lg:col-span-2 space-y-6">

                    @foreach ($cart as $id => $item)
                        <div
                            class="flex flex-col sm:flex-row items-center bg-white p-5 rounded-2xl shadow-lg border border-gray-100">

                            <div class="flex items-center gap-4 w-full sm:w-1/2">
                                <img src="{{ asset('storage/' . $item['main_image']) }}" alt="{{ $item['title'] }}"
                                    class="w-20 h-20 object-cover rounded-xl border">
                                <a href="{{ route('product', $id) }}"
                                    class="text-lg font-bold text-gray-800 hover:text-blue-600 transition">
                                    {{ $item['title'] }}
                                </a>
                            </div>

                            <div
                                class="flex items-center justify-between sm:justify-end gap-6 mt-4 sm:mt-0 w-full sm:w-1/2">

                                <div class="flex items-center gap-1 border border-gray-300 rounded-lg p-1">
                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $id }}">
                                        <input type="hidden" name="quantity" value="{{ max($item['quantity'] - 1, 1) }}">
                                        <button type="submit"
                                            class="w-8 h-8 flex items-center justify-center text-lg font-bold text-gray-700 rounded-lg hover:bg-gray-100 transition">
                                            -
                                        </button>
                                    </form>

                                    <span class="px-3 text-lg font-semibold text-gray-800">{{ $item['quantity'] }}</span>

                                    <form action="{{ route('cart.update') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $id }}">
                                        <input type="hidden" name="quantity" value="{{ $item['quantity'] + 1 }}">
                                        <button type="submit"
                                            class="w-8 h-8 flex items-center justify-center text-lg font-bold text-gray-700 rounded-lg hover:bg-gray-100 transition">
                                            +
                                        </button>
                                    </form>
                                </div>

                                <div class="text-center">
                                    <span class="text-sm text-gray-500 block">جمع جزئی</span>
                                    <span class="text-xl font-bold text-blue-600 whitespace-nowrap">
                                        {{ format_price($item['price'] * $item['quantity']) }}
                                    </span>

                                </div>

                                <div>
                                    <form action="{{ route('cart.remove', ['product' => $id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="حذف از سبد"
                                            class="p-2 text-red-500 hover:text-red-700 transition rounded-full hover:bg-red-50">
                                            X
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    @endforeach

                </div>

                <div class="lg:col-span-1">
                    <div class="bg-white p-6 rounded-2xl shadow-xl border border-blue-100 sticky top-28 space-y-6">
                        <h2 class="text-2xl font-extrabold text-gray-900 border-b pb-3 mb-4">خلاصه فاکتور</h2>

                        <div class="flex justify-between items-center text-xl font-medium">
                            <span>جمع کل محصولات</span>
                            <span class="text-gray-800">{{ number_format($total) }} تومان</span>
                        </div>

                        <div class="flex justify-between items-center text-lg text-gray-600 border-b pb-4 border-dashed">
                            <span>هزینه ارسال</span>
                            <span class="text-green-600 font-semibold">رایگان</span>
                        </div>

                        <div class="flex justify-between items-center text-2xl font-extrabold text-blue-600 pt-2">
                            <span>مبلغ قابل پرداخت</span>
                            <span>{{ number_format($total) }}
                        </div>

                        <a href="#"
                            class="block text-center bg-blue-600 text-white py-3 rounded-xl font-extrabold text-lg shadow-xl shadow-blue-500/50 hover:bg-blue-700 transition transform hover:scale-[1.01]">
                            ادامه جهت تسویه حساب <i class="fas fa-arrow-left mr-2"></i>
                        </a>

                        <form action="{{ route('cart.clear') }}" method="POST" class="w-full">
                            @csrf
                            <button type="submit"
                                class="w-full text-center text-gray-600 py-3 rounded-xl font-semibold border border-gray-300 hover:bg-gray-100 transition">
                                <i class="fas fa-trash-restore ml-2"></i> پاک کردن کامل سبد
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        @else
            <div
                class="flex flex-col items-center justify-center h-80 bg-white rounded-3xl shadow-lg border border-gray-200 mt-10">
                <i class="fas fa-shopping-cart text-8xl text-gray-300 mb-4"></i>
                <p class="text-gray-600 text-2xl font-bold mb-4">سبد خرید شما خالی است.</p>
                <a href="{{ route('products') }}"
                    class="bg-blue-600 text-white px-6 py-3 rounded-xl font-semibold hover:bg-blue-700 transition">
                    شروع خرید 🛍️
                </a>
            </div>
        @endif
    </div>

@endsection
