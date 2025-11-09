@extends('main.layouts.master')

@section('title', 'فروشگاه و بلاگ')

@section('content')
<div class="space-y-16 py-12 px-4 max-w-7xl mx-auto" dir="rtl">






    @if(isset($featuredProducts) && $featuredProducts->count())
        <section>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-8 border-r-4 border-blue-500 pr-3 inline-block">
                محصولات پرفروش
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                @foreach($featuredProducts->take(4) as $product)
                    @include('main.components.productCart', ['product' => $product])
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('products') }}" class="text-lg font-semibold text-blue-600 hover:text-blue-700 transition">
                    مشاهده همه محصولات <i class="fas fa-chevron-left mr-2 text-sm"></i>
                </a>
            </div>
        </section>
    @endif

    @if(isset($latestBlogs) && $latestBlogs->count())
        <section>
            <h2 class="text-3xl font-extrabold text-gray-900 mb-8 border-r-4 border-blue-500 pr-3 inline-block">
                جدیدترین مقالات
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                @foreach($latestBlogs->take(3) as $blog)
                    @include('main.components.blogCart', ['blog' => $blog])
                @endforeach
            </div>
            <div class="text-center mt-10">
                <a href="{{ route('blogs') }}" class="text-lg font-semibold text-blue-600 hover:text-blue-700 transition">
                    مشاهده همه مقالات <i class="fas fa-chevron-left mr-2 text-sm"></i>
                </a>
            </div>
        </section>
    @endif


    {{-- ۵. فوتر کوچک (Small Footer Status) --}}
    <div class="text-center pt-8 border-t border-gray-200">
        <p class="text-sm text-gray-500">
            وضعیت سایت: <span class="font-bold text-green-600">فعال</span> | بازدید صفحه اصلی تا به امروز:
            <span class="font-bold text-gray-700">{{ number_format($visits ?? 0) }}</span>
        </p>
    </div>

</div>
@endsection
