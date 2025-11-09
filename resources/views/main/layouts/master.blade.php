<!DOCTYPE html>
<html lang="fa" dir="rtl" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('meta')
    @yield('style')
    <title>Shop | @yield('title')</title>

</head>

<body dir="rtl" class="bg-gray-50 text-gray-800">
    @include('components.alerts')
    <div class="min-h-screen w-full  mx-auto ">
        @include('main.components.header')
        <div class="max-w-[1260px] mx-auto">

            @include('main.components.banner')
            @include('main.components.categories')

            <main>
                @yield('content')
            </main>
        </div>

    </div>
    @include('main.components.footer')
    @yield('script')
</body>

</html>
