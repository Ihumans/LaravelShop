@extends('main.layouts.master')

@section('title', $category->title)

@section('content')
    <div class="container mx-auto px-6 py-12">

        <div
            class="flex flex-col md:flex-row justify-between items-start gap-10 bg-white border border-gray-100 rounded-3xl shadow-xl p-8 lg:p-12">

            <div class="md:w-2/3 flex flex-col justify-center items-end text-right">
                <h1 class="text-4xl lg:text-5xl font-extrabold mb-4 text-gray-900 tracking-tight">
                    {{ $category->title }}
                </h1>

                @if ($category->description)
                    <p
                        class="text-gray-600 leading-relaxed border-r-4 border-blue-500 pr-4 py-3 text-lg bg-blue-50/50 rounded-r-lg">
                        {{ $category->description }}
                    </p>
                @else
                    <p
                        class="text-gray-600 leading-relaxed border-r-4 border-blue-500 pr-4 py-3 text-lg bg-blue-50/50 rounded-r-lg">
                        لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ لورم ایپسوم متن ساختگی با تولید سادگی
                        نامفهوم از صنعت چاپ لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ لورم ایپسوم متن ساختگی
                        با تولید سادگی نامفهوم از صنعت چاپلورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ
                    </p>
                @endif

                @if ($category->children->count())
                    <div class="mt-8 pt-4 border-t border-gray-100 text-right w-full">
                        <p class="text-sm font-semibold text-gray-500 mb-3">زیر‌دسته‌ها:</p>
                        <div class="flex flex-wrap gap-3 justify-end">
                            @foreach ($category->children as $child)
                                <a href="{{ route('category', $child->slug) }}"
                                    class="bg-blue-100 hover:bg-blue-600 text-blue-700 hover:text-white font-medium text-sm px-4 py-1.5 rounded-full transition duration-300 transform hover:scale-105 shadow-sm">
                                    {{ $child->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div class="mt-8 pt-4 border-t border-gray-100 text-right w-full">
                        <p class="text-sm font-semibold text-gray-500 mb-3">زیر‌دسته‌ها:</p>
                        <div class="flex flex-wrap gap-3 justify-end">
                            <p class="text-sm font-semibold text-gray-500 mb-3">زیر دسته ای وجود ندارد</p>
                        </div>
                    </div>
                @endif
            </div>

            @if ($category->image)
                <div class="md:w-1/3 flex justify-center items-center">
                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->title }}"
                        class="rounded-3xl shadow-2xl w-full max-w-xs object-cover border-4 border-white transform hover:rotate-2 transition duration-500 ease-in-out">
                </div>
                @else
                <div class="md:w-1/3 flex justify-center items-center">
                    <img src="{{ asset('img/defaultPic.png') }}" alt="{{ $category->title }}"
                        class="rounded-3xl shadow-2xl w-full max-w-xs object-cover border-4 border-white transform hover:rotate-2 transition duration-500 ease-in-out">
                </div>
            @endif
        </div>

        <div class="mt-16" dir="rtl">
            <div class="flex justify-between items-end mb-8 border-b border-gray-200 pb-2">
                <h2 class="text-2xl font-extrabold text-gray-800 flex items-center gap-2">
                    <i class="fas fa-list-alt text-blue-500"></i>
                    محصولات این دسته
                </h2>
                <span class="text-gray-500 text-sm font-medium">({{ $products->count() }} محصول)</span>
            </div>

            @if ($products->count())
                <div class="mt-3 grid gap-8 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 justify-items-center">
                    @foreach ($products as $product)
                        @include('main.components.productCart')
                    @endforeach
                </div>
                <div class="mt-10">
                </div>
            @else
                <p class="text-gray-500 text-center mt-10 p-8 bg-white rounded-xl shadow-md text-xl font-medium">
                    🛍️ هنوز محصولی در این دسته وجود ندارد.
                </p>
            @endif
        </div>

    </div>
@endsection
