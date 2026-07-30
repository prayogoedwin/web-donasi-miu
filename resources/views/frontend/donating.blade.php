<x-frontend.app>



    <div class="max-w-2xl mx-auto space-y-4">

        <!-- Header / Banner Program -->
        <div class="bg-white rounded-xl mx-3 shadow-sm overflow-hidden border border-gray-200 border-t-8 border-t-gold-700">
            @if(!empty($program->image_path))
            <div class="w-full h-48 sm:h-64 overflow-hidden">
                <img src="{{ asset($program->image_path) }}" alt="{{ $program->title }}" class="w-full h-full object-cover">
            </div>
            @endif
            <div class="p-6">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">{{ $program->title }}</h1>
                <p class="text-gray-600 text-sm leading-relaxed whitespace-pre-line">{{ $program->description }}</p>
            </div>
        </div>

        <form action="{{ route('donasi.store', $program->id) }}" method="POST" class="space-y-4">
            @csrf

            <!-- Section 1: Nominal Donasi -->
            <div class="bg-white rounded-xl p-6   mx-3 shadow-sm border border-gray-200">
                <label class="block text-gray-800 font-semibold mb-1">
                    Jumlah Donasi <span class="text-red-500">*</span>
                </label>
                <p class="text-xs text-gray-500 mb-4">Pilih nominal cepat atau masukkan jumlah sendiri.</p>

                <!-- Pilihan Nominal Cepat -->
                <div class="grid grid-cols-2 sm:grid-cols-3 gap-2 mb-3">
                    @foreach([10000, 25000, 50000, 100000, 250000, 500000] as $nominal)
                    <button type="button"
                        onclick="setNominal({{ $nominal }})"
                        class="btn-nominal border border-purple-200 hover:border-purple-600 hover:bg-purple-50 text-purple-700 font-medium py-2 px-3 rounded-lg text-sm text-center transition">
                        Rp {{ number_format($nominal, 0, ',', '.') }}
                    </button>
                    @endforeach
                </div>

                <!-- Input Custom Nominal -->
                <div class="relative">
                    <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 font-medium">Rp</span>
                    <input type="number"
                        id="jumlah_donasi"
                        name="jumlah_donasi"
                        required
                        min="1000"
                        placeholder="Masukkan nominal lainnya..."
                        class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent outline-none transition text-gray-800 font-medium">
                </div>
                @error('jumlah_donasi')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Section 2: Informasi Donatur -->
            <div class="bg-white rounded-xl p-6  mx-3 shadow-sm border border-gray-200 space-y-4">

                <!-- Input Nama / Opsi Template -->
                <div>
                    <label for="nama" class="block text-gray-800 font-semibold mb-1">
                        Nama Donatur <span class="text-red-500">*</span>
                    </label>
                    <p class="text-xs text-gray-500 mb-2">Ketik nama Anda atau pilih sebutan anonim di bawah:</p>

                    <!-- Template Nama Quick Select -->
                    @if(isset($template_name) && count($template_name) > 0)
                    <div class="flex flex-wrap gap-2 mb-3">
                        @foreach($template_name as $template)
                        <button type="button"
                            onclick="setNama('{{ $template }}')"
                            class="text-xs bg-gray-100 hover:bg-purple-100 text-gray-700 hover:text-purple-700 px-3 py-1.5 rounded-full border border-gray-300 transition">
                            + {{ $template }}
                        </button>
                        @endforeach
                    </div>
                    @endif

                    <input type="text"
                        id="nama"
                        name="nama"
                        required
                        placeholder="Nama Lengkap Anda"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent outline-none transition text-gray-800">
                    @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Input No HP -->
                <div>
                    <label for="nomor_hp" class="block text-gray-800 font-semibold mb-1">
                        Nomor WhatsApp / HP <span class="text-red-500">*</span>
                    </label>
                    <input type="tel"
                        id="nomor_hp"
                        name="nomor_hp"
                        required
                        placeholder="08xxxxxxxxxx"
                        class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-600 focus:border-transparent outline-none transition text-gray-800">
                    @error('nomor_hp')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

            </div>

            <!-- Section 3: Metode Pembayaran -->
            <div class="bg-white rounded-xl p-6  mx-3 shadow-sm border border-gray-200">
                <label class="block text-gray-800 font-semibold mb-3">
                    Pilih Metode Pembayaran <span class="text-red-500">*</span>
                </label>

                <div class="space-y-2">
                    @foreach($metode_pembayarans as $metode)
                    <label class="flex items-center justify-between p-3.5 border border-gray-200 rounded-lg cursor-pointer hover:bg-purple-50 hover:border-purple-300 transition group">
                        <div class="flex items-center space-x-3">
                            <input type="radio"
                                name="metode_pembayaran_id"
                                value="{{ $metode->id }}"
                                required
                                class="w-4 h-4 text-purple-600 focus:ring-purple-500 border-gray-300">
                            <span class="text-sm font-medium text-gray-800 group-hover:text-purple-900">
                                {{ $metode->title }}
                            </span>
                        </div>

                        @if(!empty($metode->image))
                        <img src="{{ asset('storage/' . $metode->image) }}"
                            alt="{{ $metode->title }}"
                            class="h-6 w-auto object-contain">
                        @endif
                    </label>
                    @endforeach
                </div>
                @error('metode_pembayaran_id')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Submit Button & Clear Form (Centered) -->
            <div class="flex flex-col mx-3 items-center justify-center space-y-3 pt-4">
                <button type="submit"
                    class="w-full sm:w-auto min-w-[200px] bg-purple-700 hover:bg-purple-800 text-white font-semibold px-8 py-3 rounded-lg shadow transition hover:shadow-md text-center">
                    Kirim Donasi
                </button>

                <button type="reset"
                    onclick="resetNominal()"
                    class="text-xs text-gray-500 hover:text-purple-700 underline transition">
                    Kosongkan Formulir
                </button>
            </div>

        </form>

    </div>

    <!-- Script Interaktif -->
    <script>
        function setNominal(amount) {
            document.getElementById('jumlah_donasi').value = amount;
        }

        function setNama(name) {
            document.getElementById('nama').value = name;
        }

        function resetNominal() {
            document.getElementById('jumlah_donasi').value = '';
            document.getElementById('nama').value = '';
        }
    </script>

</x-frontend.app>