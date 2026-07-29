<x-layouts.app>
    <div class="mb-6 flex items-center text-sm">
        <a href="{{ route('dashboard') }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ __('Dashboard') }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('programs.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Program</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-500 dark:text-gray-400">Detail</span>
    </div>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Detail Program</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Informasi lengkap program</p>
    </div>

    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        @if ($errors->any())
        <div class="bg-red-50 dark:bg-red-900 text-red-700 dark:text-red-300 p-4">
            <ul class="list-disc pl-5 space-y-1">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif


        <div class="p-6">



            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Judul
                </label>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ $program->title }}
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Deskripsi
                </label>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ $program->description }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Kategori Program
                </label>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ $program->kategoriProgram->title }}
                </div>
            </div>


            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Jumlah Donasi Terkumpul
                </label>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ $program->collected_amount }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Target Donasi
                </label>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ $program->target_amount }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Tanggal Mulai
                </label>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ $program->tanggal_mulai }}
                </div>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Tanggal Berakhir
                </label>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ $program->tanggal_berakhir }}
                </div>
            </div>


            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                    Status
                </label>
                <div class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                    {{ $program->status }}
                </div>
            </div>


        </div>
    </div>
</x-layouts.app>