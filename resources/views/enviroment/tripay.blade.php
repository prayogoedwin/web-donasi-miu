<x-layouts.app>
    <div class="mb-6 flex items-center text-sm">
        <a href="{{ route('dashboard') }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ __('Dashboard') }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('tripay.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Tripay</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-500 dark:text-gray-400">Edit</span>
    </div>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Edit Tripay Configuration</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Isi informasi berikut</p>
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
            <form action="{{ route('tripay.update') }}" method="POST" class="max-w-2xl">
                @csrf
                @method('PUT')


                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Environment
                    </label>

                    <select
                        name="environment"
                        class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm p-2">

                        
                        
                        @if($tripay->environment == 'sandbox')
                            <option value="sandbox" selected>Sandbox</option>
                            <option value="production">Production</option>
                        @else
                            <option value="sandbox">Sandbox</option>
                            <option value="production" selected>Production</option>
                        @endif
                    </select>

                    @error('environment')
                    <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <x-forms.input label="Api Key" name="api_key" type="text" value="{{ old('api_key', $tripay->api_key) }}" required />
                </div>

                <div class="mb-4">
                    <x-forms.input label="Url Sandbox" name="url_sandbox" type="text" value="{{ old('url_sandbox', $tripay->url_sandbox) }}" required /> 
                </div>

                <div class="mb-4">
                    <x-forms.input label="Url Production" name="url_production" type="text" value="{{ old('url_production', $tripay->url_production) }}" required />
                </div>

                


                <div class="flex gap-3">
                    <x-button type="primary">{{ __('Simpan') }}</x-button>
                    <a href="{{ route('tripay.index') }}" class="text-white font-medium py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors flex items-center justify-center cursor-pointer bg-gray-600 hover:bg-gray-700 focus:ring-gray-500 dark:bg-gray-500 dark:hover:bg-gray-600">
                        {{ __('Batal') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layouts.app>