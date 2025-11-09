@extends('pannel.layouts.master')

@section('title', 'مدیریت دسته‌ها')

@section('content')
<div class="flex flex-col lg:flex-row gap-8 bg-gray-50 p-6 min-h-screen">

    <div class="flex-1 bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800">دسته‌بندی‌ها</h2>
        </div>

        @if ($categories->isEmpty())
            <p class="text-gray-500 text-center py-10">هیچ دسته‌ای وجود ندارد.</p>
        @else
            <div class="overflow-x-auto rounded-lg border border-gray-200 mb-2">
                <table class="min-w-full divide-y divide-gray-200 text-sm text-right">
                    <thead class="bg-gray-100 text-gray-700 font-semibold">
                        <tr>
                            <th class="px-4 py-3">عنوان</th>
                            <th class="px-4 py-3">زیرمجموعه‌ی</th>
                            <th class="px-4 py-3">تصویر</th>
                            <th class="px-4 py-3 text-center">عملیات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach ($categories as $category)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-4 py-3 font-medium text-gray-800">{{ $category->title }}</td>
                                <td class="px-4 py-3 text-gray-600">{{ $category->parent?->title ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    @if ($category->image)
                                        <img src="{{ asset('storage/' . $category->image) }}" alt="Category"
                                             class="w-10 h-10 object-cover rounded-lg border border-gray-200">
                                    @else
                                        <span class="text-gray-400">ندارد</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center flex justify-center gap-3">
                                    <a href="{{ route('categories.edit', $category) }}"
                                       class="text-blue-600 hover:text-blue-800 font-semibold transition">ویرایش</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="POST"
                                          onsubmit="return confirm('آیا از حذف این دسته مطمئن هستید؟')">
                                        @csrf @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-800 font-semibold transition">حذف</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

                {{ $categories->links() }}


        @endif
    </div>

    <div class="w-full lg:w-1/3 bg-white rounded-2xl shadow-lg p-6 border border-gray-100 sticky top-6 h-fit">
        <h2 class="text-xl font-bold text-gray-800 mb-6">ایجاد دسته جدید</h2>

        <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-gray-700 font-semibold mb-1">عنوان دسته</label>
                <input type="text" name="title" placeholder="مثلاً: پوشاک مردانه"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('title') }}">
                @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">زیرمجموعه‌ی</label>
                <select name="parent_id"
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="">بدون والد</option>
                    @foreach($parents as $parent)
                        <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                            {{ $parent->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">آیکون (اختیاری)</label>
                <input type="text" name="icon" placeholder="مثلاً: fa-shirt یا 🧥"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                       value="{{ old('icon') }}">
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">توضیحات (اختیاری)</label>
                <textarea name="description" rows="3"
                          class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                          placeholder="توضیح کوتاه برای این دسته...">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="block text-gray-700 font-semibold mb-1">تصویر دسته</label>
                <input type="file" name="image"
                       class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="pt-2">
                <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2.5 rounded-lg shadow-md transition">
                    ذخیره دسته
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
