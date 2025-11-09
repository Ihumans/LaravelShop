@extends('main.layouts.master')

@section('title', 'محصولات')

@section('content')
<div class="container mx-auto mt-10 px-4" dir="rtl">
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">

        <div class="lg:col-span-1">

            <form action="{{ route('products') }}" method="GET"
                  class="space-y-6 bg-white p-6 rounded-3xl shadow-xl border border-gray-100 sticky top-28"> {{-- فیلتر Sticky می‌شود --}}

                <h2 class="text-2xl font-extrabold mb-4 text-gray-800 border-r-4 border-blue-500 pr-3 pb-1">فیلتر محصولات</h2>

                <div>
                    <label for="search" class="block text-gray-700 font-semibold mb-2">جستجو</label>
                    <div class="relative">
                         <input type="text" name="search" id="search" value="{{ request('search') }}"
                            class="w-full border border-gray-300 rounded-xl p-3 pl-10 focus:outline-none focus:ring-2 focus:ring-blue-500 transition"
                            placeholder="عنوان محصول...">
                         <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i> {{-- آیکون جستجو --}}
                    </div>
                </div>

                <div>
                    <label for="category" class="block text-gray-700 font-semibold mb-2">دسته‌بندی</label>
                    <select name="category" id="category"
                        class="w-full border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition appearance-none bg-white">
                        <option value="">همه دسته‌ها</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }} class="font-bold">
                                {{ $category->title }}
                            </option>
                            @foreach ($category->children as $child)
                                <option value="{{ $child->id }}"
                                    {{ request('category') == $child->id ? 'selected' : '' }}>
                                    &nbsp;&nbsp;└ {{ $child->title }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">محدوده قیمت (تومان)</label>
                    <div class="flex gap-2">
                        <input type="number" name="min_price" placeholder="حداقل" value="{{ request('min_price') }}"
                            class="w-1/2 border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                        <input type="number" name="max_price" placeholder="حداکثر" value="{{ request('max_price') }}"
                            class="w-1/2 border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">
                    </div>
                </div>

                <div class="flex gap-3 pt-3">
                    <button type="submit"
                        class="flex-1 flex items-center justify-center gap-2 bg-blue-600 text-white py-3 rounded-xl hover:bg-blue-700 transition font-bold shadow-lg shadow-blue-500/50">
                        <i class="fas fa-filter"></i>
                        اعمال فیلتر
                    </button>
                    <a href="{{ route('products') }}"
                        class="flex-1 flex items-center justify-center gap-2 text-center bg-gray-200 text-gray-700 py-3 rounded-xl hover:bg-gray-300 transition font-semibold">
                        <i class="fas fa-redo"></i>
                        بازنشانی
                    </a>
                </div>

            </form>

        </div>
        <div class="lg:col-span-3">
             <h1 class="text-3xl font-extrabold text-gray-900 mb-6 border-b pb-2">لیست کامل محصولات</h1>

            @if ($products->count())
                <div class="grid gap-6 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 shrink-0">
                    @foreach ($products as $product)
                        @include('main.components.productCart')
                    @endforeach
                </div>

                <div class="mt-10 flex justify-center">
                    {{ $products->links() }}
                </div>
            @else
                <div class="flex flex-col items-center justify-center h-64 bg-white rounded-2xl shadow-lg mt-10">
                     <i class="fas fa-box-open text-6xl text-gray-400 mb-4"></i>
                     <p class="text-gray-600 text-xl font-medium">هیچ محصولی با فیلترهای اعمال شده یافت نشد.</p>
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
