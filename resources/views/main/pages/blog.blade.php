@extends('main.layouts.master')

@section('title', $blog->title)

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 space-y-8" dir="rtl">

    <div class="bg-white rounded-3xl shadow-2xl p-6 lg:p-10 space-y-6 border border-gray-100">

        <div class="text-right space-y-3 border-b pb-4 border-gray-100">
            <h1 class="text-4xl font-extrabold text-gray-900 leading-snug">{{ $blog->title }}</h1>
            <div class="text-sm text-gray-500 flex items-center justify-end gap-6 font-medium">

                <span class="flex items-center gap-1">
                    <i class="far fa-calendar-alt text-blue-500"></i>
                    {{ jdate($blog->created_at)->format('Y/m/d') }}
                </span>

                <a href="{{ route('blogs', ['archive' => $blog->archive->slug ?? '']) }}" class="flex items-center gap-1 text-blue-600 hover:text-blue-700 transition">
                    <i class="fas fa-folder-open"></i>
                    {{ $blog->archive->title ?? 'بدون دسته' }}
                </a>
            </div>
        </div>

        @if($blog->main_image)
            <div class="rounded-2xl overflow-hidden shadow-lg border border-gray-200">
                <img src="{{ asset('storage/' . $blog->main_image) }}" alt="{{ $blog->title }}" class="w-full h-auto object-cover max-h-96">
            </div>
        @endif

        <div class="prose prose-lg prose-blue text-justify leading-relaxed pt-4 text-gray-800">
             {!! nl2br(e($blog->body)) !!}
        </div>

        @if($blog->pins->count())
            <div class="flex flex-wrap gap-3 mt-8 border-t pt-6 border-gray-100">
                <span class="font-bold text-gray-700 ml-2 flex items-center gap-1">
                    <i class="fas fa-tags text-blue-500"></i>
                    تگ‌ها:
                </span>
                @foreach($blog->pins as $pin)
                    <a href="{{ route('blogs', ['pin' => $pin->slug]) }}"
                       class="bg-blue-100 text-blue-700 px-3 py-1 rounded-full text-sm font-semibold hover:bg-blue-200 transition transform hover:scale-105">
                        #{{ $pin->name }}
                    </a>
                @endforeach
            </div>
        @endif

    </div>

    @if($relatedBlogs->count())
        <div class="mt-16 border-t pt-8">
            <h3 class="text-2xl font-extrabold mb-6 border-r-4 border-blue-500 pr-3 text-gray-900">مطالب مرتبط</h3>
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($relatedBlogs as $related)
                    @include('main.components.blogCart', ['blog' => $related])
                @endforeach
            </div>
        </div>
    @endif

</div>
@endsection
