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
        <span class="text-gray-500 dark:text-gray-400">Buat</span>
    </div>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Buat Program</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Isi detail di bawah ini</p>
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
            <form action="{{ route('programs.store') }}" method="POST" class="max-w-2xl">
                @csrf
                @method('POST')

                
                
                <div class="mb-4">
                    <x-forms.input label="Judul" name="title" type="text" value="{{ old('title') }}" required />
                </div>
                <div class="mb-4">
                    <x-forms.input label="Deskripsi" name="description" type="text" value="{{ old('description') }}" required />
                </div>


                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Kategori Program
                    </label>

                    <select
                        name="category_program"
                        class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-2">

                        @foreach($kategori_programs as $kategori)
                        <option value="{{ $kategori['id'] }}" {{ old('category_program') == $kategori['id'] ? 'selected' : '' }}>
                            {{ $kategori['title'] }}
                        </option>
                        @endforeach
                    </select>

                    @error('category_program')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <x-forms.input label="Target Donasi" name="target_donasi" type="number"  value="{{ old('target_donasi') }}" required />
                </div>

                <div class="mb-4">
                    <x-forms.input label="Tanggal Mulai" name="tanggal_mulai" type="date" value="{{ old('tanggal_mulai') }}" required />
                </div>

                <div class="mb-4">
                    <x-forms.input label="Tanggal Berakhir" name="tanggal_berakhir" type="date" value="{{ old('tanggal_berakhir') }}" required />
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Status
                    </label>

                    <select
                        name="status"
                        class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-2">

                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>

                    @error('status')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>


                <div class="flex gap-3">
                    <x-button type="primary">{{ __('Buat') }}</x-button>
                    <a href="{{ route('programs.index') }}" class="text-white font-medium py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors flex items-center justify-center cursor-pointer bg-gray-600 hover:bg-gray-700 focus:ring-gray-500 dark:bg-gray-500 dark:hover:bg-gray-600">
                        {{ __('Batal') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>