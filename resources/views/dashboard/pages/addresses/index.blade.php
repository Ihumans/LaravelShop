@extends('dashboard.layouts.master')

@section('title', 'آدرس‌ها')

@section('content')
    <div class="flex justify-center items-start min-h-screen bg-gray-50 py-10 px-4">
        <div class="bg-white/80 backdrop-blur-md shadow-xl rounded-2xl p-8 w-full max-w-3xl border border-gray-100">

            <div class="flex flex-row-reverse justify-between items-center mb-8">
                <h2 class="text-2xl font-bold text-gray-800">آدرس‌های من</h2>
                <a href="{{ route('addresses.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-semibold shadow-md transition">
                    + افزودن آدرس جدید
                </a>
            </div>

            @if ($addresses->isEmpty())
                <div class="text-center text-gray-600 py-10">
                    <p class="text-lg mb-4">هنوز هیچ آدرسی ثبت نکرده‌اید.</p>
                    <a href="{{ route('addresses.create') }}"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg text-sm font-medium shadow-md transition">
                        ایجاد آدرس جدید
                    </a>
                </div>
            @else
                <div class="space-y-4">
                    @foreach ($addresses as $address)
                        <div
                            class="border border-gray-200 rounded-xl p-5 bg-gray-50 hover:shadow-md transition-all duration-300">
                            <div class="text-right space-y-1 text-gray-700">
                                <p><span class="font-semibold text-gray-800">نام:</span> {{ $address->name }}</p>
                                <p><span class="font-semibold text-gray-800">استان:</span> {{ $address->province }}</p>
                                <p><span class="font-semibold text-gray-800">شهر:</span> {{ $address->city }}</p>
                                <p><span class="font-semibold text-gray-800">کد پستی:</span>
                                    {{ $address->postal_code ?? '---' }}</p>
                                <p><span class="font-semibold text-gray-800">آدرس:</span> {{ $address->address }}</p>
                            </div>

                            <div
                                class="flex flex-row-reverse items-center justify-start gap-3 mt-5 border-t border-gray-200 pt-3">
                                <a href="{{ route('addresses.edit', $address) }}"
                                    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-1.5 rounded-lg text-sm font-medium shadow transition">
                                    ✏️ ویرایش
                                </a>

                                <form method="POST" action="{{ route('addresses.destroy', $address) }}"
                                    onsubmit="return confirm('آیا از حذف این آدرس مطمئن هستید؟');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-1.5 rounded-lg text-sm font-medium shadow transition">
                                        🗑 حذف
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
@endsection
