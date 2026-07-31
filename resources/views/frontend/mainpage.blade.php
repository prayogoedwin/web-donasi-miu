<x-frontend.app>
    <!-- paksa mobile view seperti kitabisa.com -->
    <div style="max-width: 480px; margin: 0 auto; border: 1px solid #ccc; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <div class="app-shell">
            <div class="container">

                <label class="search-bar">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                        <circle cx="11" cy="11" r="7" stroke="#A9791E" stroke-width="2" />
                        <path d="M20 20L16.5 16.5" stroke="#A9791E" stroke-width="2" stroke-linecap="round" />
                    </svg>
                    <input type="text" id="searchProgram" placeholder="Coba cari &ldquo;Wakaf Kubah Masjid&rdquo;">
                </label>

                <section class="hero-banner">
                    <div class="hero-banner-glow"></div>

                    <!-- Bungkus bagian teks ke dalam div ini -->
                    <div class="hero-banner-content">
                        <p class="eyebrow" style="color:var(--gold-300)">Portal Donasi &middot; 'Izzatul 'Ulya</p>
                        <h1>Sebar Kebaikan,<br>Rawat Rumah <em>Allah</em></h1>
                        <p class="lead">{{ $informasi['sub_tagline_hero'] }}</p>
                        <div class="banner-actions">
                            <a href="#program" class="store-btn">
                                <span class="store-ic">🤲</span>
                                <span><b>Donasi</b>Program Prioritas</span>
                            </a>
                            <a href="#tentang" class="store-btn">
                                <span class="store-ic">🕌</span>
                                <span><b>Tentang</b>Masjid Kami</span>
                            </a>
                        </div>
                    </div>

                    <!-- Foto berada di luar div teks -->
                    <div class="hero-banner-photo">
                        <img src="{{ asset('images/bg.jpg') }}" alt="Interior Masjid Izzatul Ulya">
                    </div>
                </section>

                <section class="promo-card">
                    <h3>Wujudkan Kubah &amp; Ruang Utama yang Lebih Layak</h3>
                    <p>Bantu percepat penyelesaian renovasi masjid lewat donasi terkurasi & transparan dari Takmir langsung.</p>
                    <a href="#program" class="btn-block">Lihat Program Donasi <span>&rsaquo;</span></a>
                </section>

                <section class="menu-section">
                    <h4 class="menu-heading">Mau Berbuat Baik Apa Hari Ini?</h4>
                    <div class="menu-grid">
                        <a href="#program" class="menu-item">
                            <span class="menu-icon">🤲</span>
                            <span>Donasi</span>
                        </a>
                        <a href="#program" class="menu-item">
                            <span class="menu-icon">☾</span>
                            <span>Zakat &amp; Infak</span>
                        </a>
                        <a href="#program" class="menu-item">
                            <span class="menu-icon">🕌</span>
                            <span>Wakaf</span>
                        </a>
                        <a href="#alur" class="menu-item">
                            <span class="menu-icon">📅</span>
                            <span>Kegiatan Masjid</span>
                        </a>
                    </div>
                </section>

            </div>
        </div>

        <section class="trust-strip">
            <div class="container">
                <div class="trust-grid">
                    @forelse($trusts as $trust)
                    <div class="trust-item">
                        <div class="trust-icon">✓</div>
                        <div>
                            <h4>{{ $trust->key }}</h4>
                            <p>{{ $trust->value }}</p>
                        </div>
                    </div>
                    @empty

                    @endforelse
                </div>
            </div>
        </section>


        <section id="program">
            <div class="container">
                <div class="section-head">
                    <p class="eyebrow">Program Prioritas</p>
                    <h2>Sedang Butuh Uluran Tangan</h2>
                    <p>Program dengan kebutuhan mendesak dari kepengurusan masjid saat ini.</p>
                </div>
                @if($program_prioritas)
                <div class="featured-card">
                    <span class="tag">Prioritas</span>
                    <div class="featured-img"></div>
                    <div class="featured-body">
                        <h3>{{ $program_prioritas->title ?? '' }}</h3>
                        <p>oleh {{ $program_prioritas->proposed_by ?? '' }}</p>
                        <div class="progress-wrap">
                            <div class="progress-track">
                                <div class="progress-fill" style="width:64%"></div>
                            </div>
                            <div class="progress-meta">
                                <span><strong>Rp {{ number_format($program_prioritas->collected_amount ?? 0, 0, ',', '.') }}</strong><br>terkumpul</span>
                                <span style="text-align:right">dari target<br><strong>Rp {{ number_format($program_prioritas->target_amount ?? 0, 0, ',', '.') }}</strong></span>
                            </div>
                        </div>
                        <div class="featured-foot">
                            <span class="days-left">{{ number_format($program_prioritas->donor_count ?? 0, 0, ',', '.') }} donatur &middot; {{ $program_prioritas->days_left ?? 0 }} hari lagi</span>
                            <a href="{{ route('donasi', $program_prioritas->link) }}" class="btn-on-dark">Donasi</a>
                        </div>
                    </div>
                </div>
                @endif

            </div>
        </section>

        <section id="programSection" style="padding-top:0;">
            <div class="container">
                <div class="section-head">
                    <p class="eyebrow">Seluruh Program</p>
                    <h2>Pilih Program Donasi</h2>
                </div>

                <div class="filters">
                    <button class="chip active" data-filter="Semua">Semua</button>
                    @foreach($kategori_programs as $kategori)
                    <button class="chip" data-filter="{{ $kategori->title }}">{{ $kategori->title }}</button>
                    @endforeach

                </div>

                <div class="campaign-grid">
                    @forelse($programs as $program)
                    <div class="campaign-card" data-category="{{ strtolower($program->kategori_program->title ?? 'lainnya') }}"
                        data-title="{{ strtolower($program->title) }}">
                        <div class="campaign-thumb" style="background-image: url('{{ asset($program->image_path) }}');">
                            <span class="campaign-cat">{{ $program->kategori_program->title  }}</span>
                        </div>
                        <div class="campaign-body">
                            <h4>{{ $program->title }}</h4>
                            <p class="by">oleh {{ $program->proposed_by ?? 'Takmir Masjid' }}</p>

                            @php
                            // Menghitung persentase progres donasi
                            $target = $program->target_amount ?? 1;
                            $collected = $program->collected_amount ?? 0;
                            $percentage = min(100, round(($collected / $target) * 100));
                            @endphp

                            <div class="c-progress-track">
                                <div class="c-progress-fill" style="width: {{ $percentage }}%"></div>
                            </div>
                            <div class="c-meta">
                                <strong>Rp {{ number_format($collected, 0, ',', '.') }}</strong>
                                <span>dari Rp {{ number_format($target, 0, ',', '.') }}</span>
                            </div>
                            <div class="c-foot">
                                <span class="donor-count">{{ number_format($program->donor_count, 0, ',', '.') }} donatur</span>
                                <a href="{{ route('donasi', $program->link) }}" class="btn-outline-sm">Donasi</a>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px 0; color: var(--walnut-700);">
                        <p>Belum ada program donasi yang tersedia saat ini.</p>
                    </div>
                    @endforelse
                </div>

                <div id="emptySearch" style="display:none; text-align:center; padding:30px;">
                    Program tidak ditemukan.
                </div>

            </div>
        </section>

        <div class="lattice-divider"></div>

        <section class="about lattice-bg-fade" id="tentang">
            <div class="container about-inner">
                <div>
                    <p class="eyebrow">Tentang Kami</p>
                    <h2>{{ $informasi['nama_masjid'] }}</h2>
                    <p>{{ $informasi['deskripsi_singkat'] }}</p>
                    <div class="about-facts">
                        @forelse($informasi_facts as $fact)
                        <div class="about-fact"><span class="num">{{ $fact->value }}</span><span class="lbl">{{ $fact->key }}</span></div>
                        @empty
                        @endforelse
                    </div>
                </div>
                <div class="about-logo-wrap">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Masjid Izzatul Ulya">
                </div>
            </div>
        </section>

        <section id="alur">
            <div class="container">
                <div class="section-head">
                    <p class="eyebrow">Cara Berdonasi</p>
                    <h2> Langkah Sederhana</h2>
                </div>
                <div class="steps">
                    @forelse($alur_steps as $step)
                    <div class="step">
                        <span class="step-num">{{ $loop->iteration < 10 ? '0' . $loop->iteration : $loop->iteration }}</span>
                        <div>
                            <h4>{{ $step->key }}</h4>
                            <p>{{ $step->value }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="step">
                        <span class="step-num">01</span>
                        <div>
                            <h4>Pilih Program</h4>
                            <p>Tentukan program donasi sesuai niat & kepedulian Anda.</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </section>

        <footer id="kontak">
            <div class="container">
                <div class="footer-grid">
                    <div>
                        <div class="footer-brand">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo">
                            <div>
                                <div class="name">'Izzatul 'Ulya</div>
                                <div class="place">Masjid Nandan, Sariharjo, Ngaglik, Sleman</div>
                            </div>
                        </div>
                        <p class="footer-desc">Portal donasi resmi Masjid 'Izzatul 'Ulya. Dikelola oleh Takmir untuk kemakmuran masjid, pendidikan, serta kepedulian sosial jamaah dan warga sekitar.</p>
                        <div class="social-row">
                            @forelse($link_link as $link)
                            <a href="{{ $link->value }}" target="_blank">{{ $link->key }}</a>
                            @empty
                            @endforelse

                        </div>
                    </div>
                    <div>
                        <h5>Tautan</h5>
                        <ul>
                            <li><a href="#program">Program Donasi</a></li>
                            <li><a href="#tentang">Tentang Masjid</a></li>
                            <li><a href="#alur">Cara Berdonasi</a></li>
                            <li><a href="#">Laporan Keuangan</a></li>
                        </ul>
                    </div>
                    <div>
                        <h5>Rekening Resmi</h5>
                        <div class="bank-box">
                            @forelse($rekening as $rek)
                            <div class="bank-name">{{ $rek->value }}</div>
                            @empty
                            @endforelse

                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    &copy; {{ date('Y') }} {{ $informasi['nama_masjid'] }} — Konsep desain portal donasi. Semua nominal & progres pada mockup ini adalah data contoh.
                </div>
            </div>
        </footer>

        <nav class="bottom-nav">
            <a href="#" class="active"><span class="bn-ic">⌂</span>Beranda</a>
            <a href="#program"><span class="bn-ic">🎁</span>Program</a>
            <a href="#program"><span class="bn-ic">🧾</span>Donasi</a>
            <a href="#tentang"><span class="bn-ic">🔔</span>Kabar</a>
            <a href="#kontak"><span class="bn-ic">☰</span>Akun</a>
        </nav>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filters .chip');
            const campaignCards = document.querySelectorAll('.campaign-grid .campaign-card');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // 1. Ubah status active pada tombol
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    // 2. Ambil kategori filter yang dipilih
                    const selectedFilter = this.getAttribute('data-filter');

                    // 3. Filter kartu kampanye
                    campaignCards.forEach(card => {
                        const cardCategory = card.getAttribute('data-category');

                        console.log('Card Category:', cardCategory, 'Selected Filter:', selectedFilter); // Debugging

                        if (selectedFilter === 'Semua' || cardCategory === selectedFilter) {
                            card.style.display = ''; // Tampilkan kartu
                        } else {
                            card.style.display = 'none'; // Sembunyikan kartu
                        }
                    });
                });
            });


            const searchInput = document.getElementById("searchProgram");
            const cards = document.querySelectorAll(".campaign-card");
            const chips = document.querySelectorAll(".chip");

            let activeCategory = "semua";

            function filterPrograms() {
                const keyword = searchInput.value.toLowerCase().trim();

                cards.forEach(card => {
                    const title = card.dataset.title;
                    const category = card.dataset.category;

                    const matchKeyword =
                        title.includes(keyword) ||
                        category.includes(keyword);

                    const matchCategory =
                        activeCategory === "semua" ||
                        category === activeCategory;

                    card.style.display =
                        (matchKeyword && matchCategory) ? "" : "none";
                });
            }

            // Search
            searchInput.addEventListener("input", filterPrograms);

            // Filter kategori
            chips.forEach(chip => {
                chip.addEventListener("click", function() {

                    chips.forEach(c => c.classList.remove("active"));
                    this.classList.add("active");

                    activeCategory = this.dataset.filter.toLowerCase();

                    filterPrograms();
                });
            });

            const programSection = document.getElementById("programSection");

            searchInput.addEventListener("keydown", function(e) {
                if (e.key === "Enter") {
                    e.preventDefault();

                    // Jalankan filter (jika belum otomatis)
                    filterPrograms();

                    // Scroll ke daftar program
                    programSection.scrollIntoView({
                        behavior: "smooth",
                        block: "start"
                    });
                }
            });
        });
    </script>

</x-frontend.app>