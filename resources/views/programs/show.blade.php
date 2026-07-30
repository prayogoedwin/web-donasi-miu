<x-layouts.app>
    <div class="mb-6 flex items-center text-sm">
        <a href="{{ route('dashboard') }}" class="text-blue-600 dark:text-blue-400 hover:underline">{{ __('Dashboard') }}</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <a href="{{ route('programs.index') }}" class="text-blue-600 dark:text-blue-400 hover:underline">Program</a>
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
        <span class="text-gray-500 dark:text-gray-400">Detail</span>
    </div>

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100">Detail Program</h1>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Informasi lengkap program</p>
    </div>

    @if ($errors->any())
    <div class="bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 text-red-700 dark:text-red-300 p-4 mb-6 rounded-lg">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <!-- Program Detail Card -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden mb-6">
        <!-- Header with Image -->
        <div class="relative h-48 bg-gradient-to-r from-blue-500 to-purple-600 dark:from-blue-600 dark:to-purple-700">
            @if($program->image_path)
            <img src="{{ asset($program->image_path) }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent"></div>
            <div class="absolute bottom-0 left-0 right-0 p-6">
                <div class="flex items-start justify-between">
                    <div>
                        <h2 class="text-2xl font-bold text-white mb-1">{{ $program->title }}</h2>
                        <p class="text-white/80 text-sm">Diusulkan oleh: {{ $program->proposed_by ?? 'Admin' }}</p>
                    </div>
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        @if($program->status == 'active') bg-green-500 text-white
                        @elseif($program->status == 'completed') bg-blue-500 text-white
                        @elseif($program->status == 'cancelled') bg-red-500 text-white
                        @else bg-gray-500 text-white @endif">
                        {{ ucfirst($program->status) }}
                    </span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="p-6">
            <!-- Priority Badge -->
            @if($program->is_priority)
            <div class="mb-4 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400 border border-yellow-200 dark:border-yellow-800">
                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                Program Prioritas
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                            Kategori
                        </label>
                        <div class="text-gray-900 dark:text-gray-100 font-medium">
                            {{ $program->kategoriProgram->title ?? 'Tidak ada kategori' }}
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                            Deskripsi
                        </label>
                        <div class="text-gray-700 dark:text-gray-300 leading-relaxed">
                            {{ $program->description }}
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                Tanggal Mulai
                            </label>
                            <div class="text-gray-900 dark:text-gray-100">
                                {{ \Carbon\Carbon::parse($program->start_date)->format('d F Y') }}
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                                Tanggal Berakhir
                            </label>
                            <div class="text-gray-900 dark:text-gray-100">
                                {{ \Carbon\Carbon::parse($program->end_date)->format('d F Y') }}
                            </div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                            Sisa Hari
                        </label>
                        <div class="text-gray-900 dark:text-gray-100 font-semibold">
                            {{ $program->days_left }} hari lagi
                        </div>
                    </div>
                </div>

                <!-- Right Column - Donation Progress -->
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 dark:text-gray-400 mb-1">
                            Progress Donasi
                        </label>
                        <div class="flex items-end justify-between mb-2">
                            <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">
                                Rp {{ number_format($program->collected_amount, 0, ',', '.') }}
                            </div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">
                                dari Rp {{ number_format($program->target_amount, 0, ',', '.') }}
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden">
                            @php
                            $percentage = $program->target_amount > 0 ? ($program->collected_amount / $program->target_amount) * 100 : 0;
                            $percentage = min($percentage, 100);
                            @endphp
                            <div class="bg-gradient-to-r from-blue-500 to-blue-600 h-3 rounded-full transition-all duration-500"
                                style="width: {{ $percentage }}%"></div>
                        </div>
                        <div class="flex justify-between mt-1">
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ number_format($percentage, 1) }}% terkumpul</span>
                            <span class="text-xs text-gray-500 dark:text-gray-400">{{ $program->donor_count }} donatur</span>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex gap-3 pt-2">
                        <a href="{{ route('programs.edit', $program->id) }}"
                            class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Program
                        </a>
                        <a href="{{ route('programs.index') }}"
                            class="flex-1 inline-flex justify-center items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-lg transition-colors duration-200">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                            </svg>
                            Kembali
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Donation History Section -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-200 dark:border-gray-700 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700 flex items-center justify-between">
            <div>
                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-100">Riwayat Donasi</h3>
                <p class="text-sm text-gray-500 dark:text-gray-400">Daftar donasi yang telah masuk untuk program ini</p>
            </div>
            <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 rounded-full text-sm font-medium">
                Total: {{ $program->donasis->count() }} donasi
            </span>
        </div>

        <div class="overflow-x-auto">
            @if($program->donasis->count() > 0)
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">No</th>
                        <th scope="col" class="px-6 py-3">Nama Donatur</th>
                        <th scope="col" class="px-6 py-3">Nomor HP</th>
                        <th scope="col" class="px-6 py-3">Jumlah Donasi</th>
                        <th scope="col" class="px-6 py-3">Metode Pembayaran</th>
                        <th scope="col" class="px-6 py-3">Status</th>
                        <th scope="col" class="px-6 py-3">Tanggal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($program->donasis as $index => $donasi)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors duration-200">
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            {{ $index + 1 }}
                        </td>
                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center text-blue-600 dark:text-blue-400 font-semibold text-sm mr-2">
                                    {{ strtoupper(substr($donasi->nama, 0, 1)) }}
                                </div>
                                {{ $donasi->nama }}
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            {{ $donasi->nomor_hp }}
                        </td>
                        <td class="px-6 py-4 font-semibold text-green-600 dark:text-green-400">
                            Rp {{ number_format($donasi->jumlah_donasi, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-300">
                                {{ $donasi->metode_pembayaran_id ?? 'Belum dipilih' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2 py-1 rounded-full text-xs font-medium
                                @if($donasi->status == 'success' || $donasi->status_pembayaran == 'success') 
                                    bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-300
                                @elseif($donasi->status == 'pending' || $donasi->status_pembayaran == 'pending')
                                    bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-300
                                @elseif($donasi->status == 'failed' || $donasi->status_pembayaran == 'failed')
                                    bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-300
                                @else
                                    bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300
                                @endif">
                                {{ ucfirst($donasi->status ?? $donasi->status_pembayaran ?? 'Belum diketahui') }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($donasi->created_at)->format('d F Y H:i') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <td colspan="3" class="px-6 py-3 text-right font-semibold text-gray-700 dark:text-gray-300">
                            Total Terkumpul:
                        </td>
                        <td colspan="4" class="px-6 py-3 font-bold text-blue-600 dark:text-blue-400">
                            Rp {{ number_format($program->donasis->sum('jumlah_donasi'), 0, ',', '.') }}
                        </td>
                    </tr>
                </tfoot>
            </table>
            @else
            <div class="text-center py-12">
                <svg class="w-16 h-16 mx-auto text-gray-300 dark:text-gray-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3-.895 3-2-1.343-2-3-2zM4 8c0-2.761 3.581-5 8-5s8 2.239 8 5c0 2.761-3.581 5-8 5s-8-2.239-8-5z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 13c0 2.761 3.581 5 8 5s8-2.239 8-5" />
                </svg>
                <p class="text-gray-500 dark:text-gray-400">Belum ada donasi untuk program ini</p>
                <p class="text-sm text-gray-400 dark:text-gray-500 mt-1">Donasi akan muncul di sini setelah ada yang berdonasi</p>
            </div>
            @endif
        </div>
    </div>
</x-layouts.app>