@extends('main.layouts.master')

@section('title', 'بلاگ‌ها')

@section('content')
    <div class="max-w-6xl mx-auto py-12 px-4 space-y-10" dir="rtl">

        <h1 class="text-4xl font-extrabold text-gray-900 border-r-4 border-blue-500 pr-3">تازه‌های بلاگ</h1>

        <div class="flex flex-col md:flex-row items-center gap-4 bg-white p-5 rounded-2xl shadow-lg border border-gray-100">
            <span class="text-gray-700 font-semibold md:ml-4">فیلتر بر اساس:</span>
            <form method="GET" class="flex flex-wrap items-center gap-4 w-full md:w-auto">

                <select name="archive" onchange="this.form.submit()"
                    class="border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition bg-white appearance-none text-gray-700 font-medium shadow-sm">
                    <option value="">همه دسته‌ها</option>
                    @foreach ($archives as $archive)
                        <option value="{{ $archive->slug }}" {{ request('archive') == $archive->slug ? 'selected' : '' }}>
                            {{ $archive->title }}
                        </option>
                    @endforeach
                </select>

                <select name="pin" onchange="this.form.submit()"
                    class="border border-gray-300 rounded-xl p-3 focus:outline-none focus:ring-2 focus:ring-blue-500 transition bg-white appearance-none text-gray-700 font-medium shadow-sm">
                    <option value="">همه تگ‌ها</option>
                    @foreach ($pins as $pin)
                        <option value="{{ $pin->slug }}" {{ request('pin') == $pin->slug ? 'selected' : '' }}>
                            {{ $pin->name }}
                        </option>
                    @endforeach
                </select>

                @if (request('archive') || request('pin'))
                    <a href="{{ route('blogs') }}" class="text-red-500 font-medium hover:underline">
                        حذف فیلترها
                    </a>
                @endif


            </form>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($blogs as $blog)
                @include('main.components.blogCart', ['blog' => $blog])
            @empty
                <div
                    class="col-span-full flex flex-col items-center justify-center h-48 bg-white rounded-2xl shadow-lg border border-gray-100">
                    <i class="far fa-newspaper text-6xl text-gray-400 mb-4"></i>
                    <p class="text-gray-600 text-xl font-medium">هیچ مقاله‌ای یافت نشد.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-10 flex justify-center">
            {{ $blogs->withQueryString()->links() }}
        </div>

    </div>
@endsection
