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
        <span class="text-gray-500 dark:text-gray-400">Edit</span>
    </div>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Edit Program</h1>
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
            <form action="{{ route('programs.update', $program->id) }}" method="POST" class="max-w-2xl">
                @csrf
                @method('PUT')



                <div class="mb-4">
                    <x-forms.input label="Judul" name="title" type="text" value="{{ old('title', $program->title) }}" required />
                </div>
                <div class="mb-4">
                    <x-forms.input label="Diusulkan Oleh" name="proposed_by" type="text" value="{{ old('proposed_by', $program->proposed_by) }}" placeholder="Takmir Masjid" />
                </div>
                <div class="mb-4">
                    <x-forms.input label="Deskripsi" name="description" type="text" value="{{ old('description', $program->description) }}" required />
                </div>


                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Kategori Program
                    </label>

                    <select
                        name="kategori_program_id"
                        class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-2">

                        @foreach($kategori_programs as $kategori)
                        <option value="{{ $kategori['id'] }}" {{ old('kategori_program_id', $program->kategori_program_id) == $kategori['id'] ? 'selected' : '' }}>
                            {{ $kategori['title'] }}
                        </option>
                        @endforeach
                    </select>

                    @error('kategori_program_id')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <x-forms.input label="Target Donasi" name="target_amount" type="number" value="{{ old('target_amount', $program->target_amount) }}" required />
                </div>

                <div class="mb-4">
                    <x-forms.input label="Tanggal Mulai" name="start_date" type="date" value="{{ old('start_date', $program->start_date) }}" required />
                </div>

                <div class="mb-4">
                    <x-forms.input label="Tanggal Berakhir" name="end_date" type="date" value="{{ old('end_date', $program->end_date) }}" required />
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Prioritas
                    </label>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mb-2">Hanya satu program yang dapat diprioritaskan. (jika dipilih "Ya", program lain akan otomatis tidak diprioritaskan)</p>

                    <select
                        name="is_priority"
                        class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-2">

                        <option value="0" {{ old('is_priority', $program->is_priority) == '0' ? 'selected' : '' }}>Tidak</option>
                        <option value="1" {{ old('is_priority', $program->is_priority) == '1' ? 'selected' : '' }}>Ya</option>

                    </select>

                    @error('is_priority')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Status
                    </label>

                    <select
                        name="status"
                        class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-2">

                        <option value="active" {{ old('status', $program->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="tidak aktif" {{ old('status', $program->status) == 'tidak aktif' ? 'selected' : '' }}>Tidak Aktif</option>
                    </select>

                    @error('status')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>


                <div class="flex gap-3">
                    <x-button type="primary">{{ __('Simpan') }}</x-button>
                    <a href="{{ route('programs.index') }}" class="text-white font-medium py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors flex items-center justify-center cursor-pointer bg-gray-600 hover:bg-gray-700 focus:ring-gray-500 dark:bg-gray-500 dark:hover:bg-gray-600">
                        {{ __('Batal') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>