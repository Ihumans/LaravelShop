@extends('main.layouts.master')

@section('title', 'درباره پروژه')

@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4" dir="rtl">

    <div class="max-w-4xl w-full">

        <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12 border border-gray-100 space-y-10">

            <div class="text-center space-y-3">
                <h1 class="text-4xl md:text-5xl font-extrabold pb-2 border-b-4 border-blue-500 inline-block text-gray-900">
                    درباره این پروژه
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed max-w-2xl mx-auto pt-4">
                    این یک پلتفرم فروشگاهی/بلاگی <span class="font-bold text-blue-600">مدرن و واکنش‌گرا</span> است که با جدیدترین تکنولوژی‌های توسعه وب ساخته شده. این پروژه، معماری <span class="text-indigo-600 font-semibold">پاک و اصولی</span> را به نمایش می‌گذارد.
                </p>
            </div>


            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center gap-3 border-r-4 border-blue-500 pr-3">
                    <i class="fas fa-code text-blue-500"></i>
                    تکنولوژی‌های اصلی
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                    @php
                        $technologies = [
                            ['text' => 'Laravel (Backend)', 'color' => 'bg-red-500', 'icon' => 'fab fa-laravel'],
                            ['text' => 'Tailwind CSS (Styling)', 'color' => 'bg-teal-500', 'icon' => 'fab fa-css3-alt'],
                            ['text' => 'Blade Templating', 'color' => 'bg-yellow-500', 'icon' => 'fas fa-cogs'],
                            ['text' => 'SQLite (DB)', 'color' => 'bg-blue-500', 'icon' => 'fas fa-database'],
                        ];
                    @endphp

                    @foreach($technologies as $tech)
                        <div class="flex items-center gap-4 p-4 rounded-xl bg-white shadow hover:shadow-lg transition transform hover:scale-[1.02] border border-gray-100">
                            <div class="p-3 rounded-full {{ $tech['color'] }} text-white shadow-md">
                                <i class="{{ $tech['icon'] }} text-xl w-6 h-6 flex items-center justify-center"></i>
                            </div>
                            <span class="text-gray-700 font-medium text-lg">{{ $tech['text'] }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <div>
                <h2 class="text-3xl font-bold text-gray-800 mb-6 flex items-center gap-3 border-r-4 border-blue-500 pr-3">
                    <i class="fas fa-rocket text-indigo-500"></i>
                    ویژگی‌ها و قابلیت‌ها
                </h2>
                <ul class="space-y-4 text-gray-700 list-none p-0">
                    @php
                        $features = [
                            'سیستم کامل مدیریت محتوا (CMS) برای محصولات و مقالات.',
                            'پنل مدیریت قدرتمند و امن برای مدیریت داده‌ها.',
                            'قابلیت فیلترینگ و دسته‌بندی پیشرفته در بلاگ و فروشگاه.',
                            'ماژول سبد خرید پیشرفته با قابلیت به‌روزرسانی آنی.',
                            'طراحی ریسپانسیو کامل با تمرکز بر موبایل و دسکتاپ.',
                        ];
                    @endphp

                    @foreach($features as $feature)
                        <li class="flex items-start gap-3 p-2 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                            <i class="fas fa-check-circle text-lg text-green-500 mt-1 flex-shrink-0"></i>
                            <span class="text-base leading-relaxed">{{ $feature }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="border-t pt-8 text-center space-y-6">

                <p class="mt-8 text-sm text-gray-500">
                    ساخته شده با ❤️ توسط
                    <span class="font-bold text-blue-600">هومن صادقی | امیرحسین بشیری</span>
                </p>
            </div>

        </div>
    </div>
</div>
@endsection
