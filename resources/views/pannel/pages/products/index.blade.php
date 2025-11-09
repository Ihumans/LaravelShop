@extends('pannel.layouts.master')

@section('title', 'مدیریت محصولات')

@section('content')
<div class="min-h-screen bg-gray-50 p-6">
    <div class="max-w-7xl mx-auto bg-white rounded-2xl shadow-md border border-gray-100 p-6">

        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">مدیریت محصولات</h2>
                <p class="text-gray-500 text-sm mt-1">در این بخش می‌توانید محصولات را مشاهده، ویرایش یا حذف کنید.</p>
            </div>
            <a href="{{ route('products.create') }}"
               class="bg-green-600 text-white px-5 py-2 rounded-lg shadow-sm hover:bg-green-700 transition">
                + افزودن محصول جدید
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full border border-gray-200 rounded-xl overflow-hidden">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="p-3 text-center text-sm font-semibold border-b">#</th>
                        <th class="p-3 text-right text-sm font-semibold border-b">تصویر</th>
                        <th class="p-3 text-right text-sm font-semibold border-b">نام محصول</th>
                        <th class="p-3 text-right text-sm font-semibold border-b">دسته‌بندی</th>
                        <th class="p-3 text-right text-sm font-semibold border-b">قیمت</th>
                        <th class="p-3 text-center text-sm font-semibold border-b">عملیات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($products as $product)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="p-3 text-center text-gray-600">{{ $loop->iteration }}</td>
                            <td class="p-3">
                                @if ($product->main_image)
                                    <img src="{{ asset('storage/' . $product->main_image) }}"
                                         class="w-14 h-14 object-cover rounded-md border">
                                @else
                                    <div class="w-14 h-14 flex items-center justify-center text-gray-400 border rounded-md bg-gray-50">
                                        ❌
                                    </div>
                                @endif
                            </td>
                            <td class="p-3 text-gray-800 font-medium">{{ $product->title }}</td>
                            <td class="p-3 text-gray-600">
                                {{ $product->category?->title ?? '---' }}
                            </td>
                            <td class="p-3 text-gray-800 font-semibold">
                                {{ number_format($product->price) }} <span class="text-gray-500 text-sm">تومان</span>
                            </td>
                            <td class="p-3 text-center">
                                <div class="flex justify-center gap-3">
                                    <a href="{{ route('products.edit', $product->id) }}"
                                       class="text-blue-600 hover:text-blue-800 font-medium transition">
                                        ✏️ ویرایش
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST"
                                          onsubmit="return confirm('آیا از حذف این محصول مطمئن هستید؟')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="text-red-600 hover:text-red-800 font-medium transition">
                                            🗑️ حذف
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-6 text-gray-500 text-sm">
                                هیچ محصولی یافت نشد 😔
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>

    </div>
</div>
@endsection
