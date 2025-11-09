<div class="w-full py-4 mt-4">
    <h2 class="text-xl font-extrabold mb-3   pb-5 text-gray-800">دسته‌بندی‌های محبوب</h2>

    <div class="flex items-center gap-6 overflow-x-auto pb-2 scrollbar-hide">
        @foreach ($categories as $category)
            <a href="{{ route('category', [$category->slug]) }}"
                class="flex-shrink-0 flex flex-col items-center p-3 rounded-xl bg-white shadow-md hover:shadow-lg transition-all duration-300 group min-w-[100px]">

                @if(isset($category->image))
                    <img class="w-16 h-16 rounded-full object-cover mb-2 ring-2 ring-gray-100 group-hover:ring-blue-500 transition-all"
                        src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->title }}">
                @else
                     <img class="w-16 h-16 rounded-full object-cover mb-2 ring-2 ring-gray-100 group-hover:ring-blue-500 transition-all"
                        src="{{ asset('img/defaultPic.png' ) }}" alt="{{ $category->title }}">
                @endif

                <span class="text-sm font-semibold text-gray-700 group-hover:text-blue-600 transition">{{ $category->title }}</span>
            </a>
        @endforeach
    </div>
</div>

