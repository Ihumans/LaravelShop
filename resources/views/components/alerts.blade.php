@if ($errors->any() || session('status') || session('success'))
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-3" dir="rtl">
        @if ($errors->any())
            <div
                class="flex items-center gap-4 bg-white border-r-4 border-red-500 text-gray-800 p-4 rounded-lg shadow-xl animate-fade-in-right ring-1 ring-red-200 min-w-[300px]">
                <i class="fas fa-times-circle text-2xl text-red-500"></i>
                <span class="font-medium text-sm flex-grow">{{ $errors->first() }}</span>
                <button onclick="this.closest('div').remove()" class="text-gray-400 hover:text-red-600 transition">✕</button>
            </div>
        @endif

        @if (session('success'))
            <div
                class="flex items-center gap-4 bg-white border-r-4 border-green-500 text-gray-800 p-4 rounded-lg shadow-xl animate-fade-in-right ring-1 ring-green-200 min-w-[300px]">
                <i class="fas fa-check-circle text-2xl text-green-500"></i>
                <span class="font-medium text-sm flex-grow">{{ session('success') }}</span>
                <button onclick="this.closest('div').remove()" class="text-gray-400 hover:text-green-600 transition">✕</button>
            </div>
        @endif

        @if (session('status'))
            <div
                class="flex items-center gap-4 bg-white border-r-4 border-yellow-500 text-gray-800 p-4 rounded-lg shadow-xl animate-fade-in-right ring-1 ring-yellow-200 min-w-[300px]">
                <i class="fas fa-exclamation-triangle text-2xl text-yellow-500"></i>
                <span class="font-medium text-sm flex-grow">{{ session('status') }}</span>
                <button onclick="this.closest('div').remove()" class="text-gray-400 hover:text-yellow-600 transition">✕</button>
            </div>
        @endif

    </div>
@endif
<script>

    setTimeout(() => {
        document.querySelectorAll('#toast-container > div').forEach(el => {
            el.classList.add('opacity-0', 'translate-x-full', 'transition', 'duration-500'); 
            setTimeout(() => el.remove(), 500);
        });
    }, 4000);
</script>
