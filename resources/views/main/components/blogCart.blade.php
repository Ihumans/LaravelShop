<a href="{{ route('blog', $blog->slug) }}"
    class="block bg-white rounded-3xl shadow-xl hover:shadow-2xl transition-all duration-300 group overflow-hidden border border-gray-100 transform hover:-translate-y-1">

    @if ($blog->main_image)
        <div class="overflow-hidden">
            <img src="{{ asset('storage/' . $blog->main_image) }}" alt="{{ $blog->title }}"
                 class="w-full h-52 object-cover group-hover:scale-110 transition-transform duration-500 ease-in-out">
        </div>
    @endif

    <div class="p-5 space-y-3 text-right">

        <h2 class="font-extrabold text-xl text-gray-900 line-clamp-2 leading-8 group-hover:text-blue-600 transition">
            {{ $blog->title }}
        </h2>

        <p class="text-sm text-gray-600 line-clamp-3 min-h-[60px]">
            {{ $blog->summary }}
        </p>

        <div class="border-t border-gray-100 pt-3 flex items-center justify-between text-xs font-medium">
            <div class="flex items-center gap-1 text-gray-500">
                <i class="far fa-calendar-alt"></i>
                <span>{{ jdate($blog->created_at)->format('Y/m/d') }}</span>
            </div>

            <span class="bg-blue-50 text-blue-700 px-3 py-1.5 rounded-full font-semibold transition hover:bg-blue-100">
                {{ $blog->archive->title ?? 'بدون دسته' }}
            </span>
        </div>
    </div>
</a>
