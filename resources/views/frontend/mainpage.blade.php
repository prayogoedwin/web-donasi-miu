<x-frontend.app>


    <div class="app-shell">
        <div class="container">

            <label class="search-bar">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none">
                    <circle cx="11" cy="11" r="7" stroke="#A9791E" stroke-width="2" />
                    <path d="M20 20L16.5 16.5" stroke="#A9791E" stroke-width="2" stroke-linecap="round" />
                </svg>
                <input type="text" placeholder="Coba cari &ldquo;Wakaf Kubah Masjid&rdquo;">
            </label>

            <section class="hero-banner">
                <div class="hero-banner-glow"></div>
                <p class="eyebrow" style="color:var(--gold-300)">Portal Donasi &middot; 'Izzatul 'Ulya</p>
                <h1>Sebar Kebaikan,<br>Rawat Rumah <em>Allah</em></h1>
                <p class="lead">Satu genggaman untuk menunaikan infak, sedekah, dan wakaf bagi kemakmuran masjid.</p>
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
                <div class="hero-banner-photo">
                    <img src="bg.jpg" alt="Interior Masjid Izzatul Ulya">
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
                <div class="trust-item">
                    <div class="trust-icon">✓</div>
                    <div>
                        <h4>Pengelola Terverifikasi</h4>
                        <p>Dikelola langsung oleh Takmir & Bendahara Masjid 'Izzatul 'Ulya, bukan pihak ketiga.</p>
                    </div>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">◈</div>
                    <div>
                        <h4>Laporan Transparan</h4>
                        <p>Rekap dana masuk dan penyaluran dipublikasikan tiap bulan di papan infak & laman ini.</p>
                    </div>
                </div>
                <div class="trust-item">
                    <div class="trust-icon">☾</div>
                    <div>
                        <h4>Real-time Progress</h4>
                        <p>Pantau capaian tiap program donasi secara langsung, kapan pun dan di mana pun.</p>
                    </div>
                </div>
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

            <div class="featured-card">
                <span class="tag">Prioritas</span>
                <div class="featured-img"></div>
                <div class="featured-body">
                    <h3>Penyempurnaan Ruang Utama & Kubah Masjid</h3>
                    <p>Melanjutkan renovasi tahap akhir mihrab dan ornamen kubah agar jamaah semakin khusyuk beribadah.</p>
                    <div class="progress-wrap">
                        <div class="progress-track">
                            <div class="progress-fill" style="width:64%"></div>
                        </div>
                        <div class="progress-meta">
                            <span><strong>Rp 384.000.000</strong><br>terkumpul</span>
                            <span style="text-align:right">dari target<br><strong>Rp 600.000.000</strong></span>
                        </div>
                    </div>
                    <div class="featured-foot">
                        <span class="days-left">1.482 donatur &middot; 24 hari lagi</span>
                        <a href="#" class="btn-on-dark">Donasi</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section style="padding-top:0;">
        <div class="container">
            <div class="section-head">
                <p class="eyebrow">Seluruh Program</p>
                <h2>Pilih Program Donasi</h2>
            </div>

            <div class="filters">
                <button class="chip active" data-filter="semua">Semua</button>
                <button class="chip" data-filter="pembangunan">Pembangunan</button>
                <button class="chip" data-filter="operasional">Operasional</button>
                <button class="chip" data-filter="yatim">Yatim &amp; Dhuafa</button>
                <button class="chip" data-filter="pendidikan">Pendidikan</button>
                <button class="chip" data-filter="sosial">Sosial</button>
            </div>

            <div class="campaign-grid">
                @forelse($programs as $program)
                <div class="campaign-card" data-category="{{ Str::slug($program->category ?? 'semua') }}">
                    <div class="campaign-thumb {{ $program->theme_class ?? 't-bangunan' }}">
                        <span class="campaign-cat">{{ $program->category_name ?? $program->category }}</span>
                        <span class="icon">{{ $program->icon ?? '🕌' }}</span>
                    </div>
                    <div class="campaign-body">
                        <h4>{{ $program->title }}</h4>
                        <p class="by">oleh {{ $program->organizer ?? 'Takmir Masjid' }}</p>

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
                            <span class="donor-count">{{ number_format($program->donors_count ?? 0, 0, ',', '.') }} donatur</span>
                            <a href="{{ route('program.show', $program->id ?? $program->slug) }}" class="btn-outline-sm">Donasi</a>
                        </div>
                    </div>
                </div>
                @empty
                <div style="grid-column: 1 / -1; text-align: center; padding: 40px 0; color: var(--walnut-700);">
                    <p>Belum ada program donasi yang tersedia saat ini.</p>
                </div>
                @endforelse
            </div>

            <a href="#" class="view-all">Lihat Semua Program &rarr;</a>
        </div>
    </section>

    <div class="lattice-divider"></div>

    <section class="about lattice-bg-fade" id="tentang">
        <div class="container about-inner">
            <div>
                <p class="eyebrow">Tentang Kami</p>
                <h2>Masjid 'Izzatul 'Ulya</h2>
                <p>Berdiri di Nandan, Sariharjo, Ngaglik, Sleman, Masjid 'Izzatul 'Ulya menjadi pusat ibadah dan kegiatan sosial-dakwah bagi warga sekitar. Portal donasi ini adalah kanal resmi kepengurusan masjid untuk menghimpun infak, sedekah, dan wakaf dari donatur di mana saja.</p>
                <div class="about-facts">
                    <div class="about-fact"><span class="num">1.200+</span><span class="lbl">Jamaah Tetap</span></div>
                    <div class="about-fact"><span class="num">12</span><span class="lbl">Tahun Melayani</span></div>
                    <div class="about-fact"><span class="num">30+</span><span class="lbl">Kegiatan Dakwah/Th</span></div>
                    <div class="about-fact"><span class="num">100%</span><span class="lbl">Dana Tersalurkan</span></div>
                </div>
            </div>
            <div class="about-logo-wrap">
                <img src="logo.png" alt="Logo Masjid Izzatul Ulya">
            </div>
        </div>
    </section>

    <section id="alur">
        <div class="container">
            <div class="section-head">
                <p class="eyebrow">Cara Berdonasi</p>
                <h2>Tiga Langkah Sederhana</h2>
            </div>
            <div class="steps">
                <div class="step">
                    <span class="step-num">01</span>
                    <div>
                        <h4>Pilih Program</h4>
                        <p>Tentukan program donasi sesuai niat & kepedulian Anda.</p>
                    </div>
                </div>
                <div class="step">
                    <span class="step-num">02</span>
                    <div>
                        <h4>Isi Nominal & Data</h4>
                        <p>Masukkan jumlah donasi dan data diri (opsional anonim).</p>
                    </div>
                </div>
                <div class="step">
                    <span class="step-num">03</span>
                    <div>
                        <h4>Bayar via Transfer/QRIS</h4>
                        <p>Selesaikan pembayaran melalui bank transfer, e-wallet, atau QRIS.</p>
                    </div>
                </div>
                <div class="step">
                    <span class="step-num">04</span>
                    <div>
                        <h4>Terima Bukti & Doa</h4>
                        <p>Bukti donasi dikirim otomatis, doa jazakumullahu khairan menyertai.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="kontak">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <div class="footer-brand">
                        <img src="logo.png" alt="Logo">
                        <div>
                            <div class="name">'Izzatul 'Ulya</div>
                            <div class="place">Masjid Nandan, Sariharjo, Ngaglik, Sleman</div>
                        </div>
                    </div>
                    <p class="footer-desc">Portal donasi resmi Masjid 'Izzatul 'Ulya. Dikelola oleh Takmir untuk kemakmuran masjid, pendidikan, serta kepedulian sosial jamaah dan warga sekitar.</p>
                    <div class="social-row">
                        <a href="#">IG</a>
                        <a href="#">FB</a>
                        <a href="#">WA</a>
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
                        <div class="bank-name">Bank Syariah Indonesia (BSI)</div>
                        <div class="bank-num">7 xxx xxx xxx</div>
                        <div class="bank-holder">a.n. Takmir Masjid Izzatul Ulya</div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                &copy; 2026 Masjid 'Izzatul 'Ulya — Konsep desain portal donasi. Semua nominal & progres pada mockup ini adalah data contoh.
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

</x-frontend.app>