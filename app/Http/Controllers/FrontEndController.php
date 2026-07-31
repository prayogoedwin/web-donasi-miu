<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
use App\Models\KategoriProgram;
use App\Models\Program;
use App\Models\Informasi;
use App\Models\MetodePembayaran;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache; // Import Facade Cache
use Midtrans\Config;
use Midtrans\Snap;

class FrontEndController extends Controller
{
    private int $cacheLong = 86400; // 1 Hari
    private int $cacheShort = 60; // 1 Menit


    public function index()
    {
        // 1. Cache Data Informasi & Key-Value (Tahan selama 1 hari / 86400 detik)
        $informasi = Cache::remember('site_informasi_pluck', $this->cacheLong, function () {
            return Informasi::all()->pluck('value', 'key')->toArray();
        });

        $trusts = Cache::remember('site_trusts', $this->cacheLong, function () {
            return Informasi::where('parent_id', function ($query) {
                $query->select('id')->from('informasis')->where('key', 'keunggulan_portal');
            })->get();
        });

        $informasi_facts = Cache::remember('site_facts', $this->cacheLong, function () {
            return Informasi::where('parent_id', function ($query) {
                $query->select('id')->from('informasis')->where('key', 'statistik_masjid');
            })->get();
        });

        $cara_berdonasi = Cache::remember('site_cara_berdonasi', $this->cacheLong, function () {
            return Informasi::where('parent_id', function ($query) {
                $query->select('id')->from('informasis')->where('key', 'cara_berdonasi');
            })->get();
        });

        // Note: alur_steps memanggil query yang sama dengan cara_berdonasi, bisa reuse variable
        $alur_steps = $cara_berdonasi;

        $rekening = Cache::remember('site_rekening_resmi', $this->cacheLong, function () {
            return Informasi::where('parent_id', function ($query) {
                $query->select('id')->from('informasis')->where('key', 'rekening_resmi');
            })->get();
        });

        $link_link = Cache::remember('site_link_link', $this->cacheLong, function () {
            return Informasi::where('parent_id', function ($query) {
                $query->select('id')->from('informasis')->where('key', 'link_link');
            })->get();
        });

        // 2. Cache Kategori Program
        $kategori_programs = Cache::remember('kategori_programs_all', $this->cacheLong, function () {
            return KategoriProgram::all();
        });

        // 3. Cache Program (Durasi lebih pendek, 1 menit)
        $programs = Cache::remember('programs_active', $this->cacheShort, function () {
            return Program::where('status', 'active')->get();
        });

        $program_prioritas = Cache::remember('program_priority', $this->cacheShort, function () {
            return Program::where('is_priority', true)->first();
        });

        return view('frontend.mainpage', compact(
            'programs',
            'program_prioritas',
            'trusts',
            'cara_berdonasi',
            'informasi',
            'informasi_facts',
            'alur_steps',
            'rekening',
            'kategori_programs',
            'link_link'
        ));
    }

    public function donasi(string $link)
    {
        // Cache program detail berdasarkan slug/link
        $program = Cache::remember("program_detail_{$link}", $this->cacheShort, function () use ($link) {
            return Program::where('link', $link)->firstOrFail();
        });

        // Cache metode pembayaran (1 Hari)
        $metode_pembayarans = Cache::remember('metode_pembayaran_all', $this->cacheLong, function () {
            return MetodePembayaran::all();
        });

        $template_name = config('helper.template_name');

        $informasi = Cache::remember('site_informasi_pluck', $this->cacheLong, function () {
            return Informasi::all()->pluck('value', 'key')->toArray();
        });

        return view('frontend.donating', compact('program', 'metode_pembayarans', 'template_name', 'informasi'));
    }

    public function donasiStore(Program $program, Request $request)
    {
        // JANGAN DICACHE: Proses penyimpanan transaksi & request ke API Midtrans
        $request->validate([
            'jumlah_donasi'        => 'required|numeric|min:1000',
            'nama'                 => 'required|string|max:255',
            'nomor_hp'             => 'required|string|max:20',
            'metode_pembayaran_id' => 'nullable',
        ]);

        $orderId = 'DONASI-' . time() . '-' . Str::random(5);

        $donasi = Donasi::create([
            'order_id'             => $orderId,
            'program_id'           => $program->id,
            'jumlah_donasi'        => $request->input('jumlah_donasi'),
            'nama'                 => $request->input('nama'),
            'nomor_hp'             => $request->input('nomor_hp'),
            'metode_pembayaran_id' => $request->input('metode_pembayaran_id'),
            'status_pembayaran'    => 'pending',
        ]);

        Config::$serverKey     = config('services.midtrans.server_key', env('MIDTRANS_SERVER_KEY'));
        Config::$isProduction  = config('services.midtrans.is_production', env('MIDTRANS_IS_PRODUCTION', false));
        Config::$isSanitized   = config('services.midtrans.is_sanitized', env('MIDTRANS_IS_SANITIZED', true));
        Config::$is3ds         = config('services.midtrans.is_3ds', env('MIDTRANS_IS_3DS', true));

        $params = [
            'transaction_details' => [
                'order_id'     => $donasi->order_id,
                'gross_amount' => (int) $donasi->jumlah_donasi,
            ],
            'customer_details' => [
                'first_name' => $donasi->nama,
                'phone'      => $donasi->nomor_hp,
            ],
            'item_details' => [
                [
                    'id'       => 'PROG-' . $program->id,
                    'price'    => (int) $donasi->jumlah_donasi,
                    'quantity' => 1,
                    'name'     => Str::limit('Donasi: ' . $program->title, 50),
                ]
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $donasi->update(['snap_token' => $snapToken]);

            return redirect()->route('donasi.pembayaran', $donasi->order_id);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function pembayaran(string $orderId)
    {
        // JANGAN DICACHE: Memanggil data pembayaran spesifik per transaksi user
        $donasi = Donasi::where('order_id', $orderId)->firstOrFail();

        return view('frontend.pembayaran', [
            'donasi' => $donasi,
            'clientKey' => config('services.midtrans.client_key', env('MIDTRANS_CLIENT_KEY'))
        ]);
    }
}
