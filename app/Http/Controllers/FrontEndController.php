<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;

use App\Models\Program;
use App\Models\Informasi;
use App\Models\MetodePembayaran;
use Illuminate\Support\Str;

use Midtrans\Config;
use Midtrans\Snap;

class FrontEndController extends Controller
{
    public function index()
    {

        $trusts = Informasi::where('parent_id', function ($query) {
            $query->select('id')
                ->from('informasis')
                ->where('key', 'keunggulan_portal');
        })->get();

        $informasi_facts = Informasi::where('parent_id', function ($query) {
            $query->select('id')
                ->from('informasis')
                ->where('key', 'statistik_masjid');
        })->get();

        $cara_berdonasi = Informasi::where('parent_id', function ($query) {
            $query->select('id')
                ->from('informasis')
                ->where('key', 'cara_berdonasi');
        })->get();

        $alur_steps = Informasi::where('parent_id', function ($query) {
            $query->select('id')
                ->from('informasis')
                ->where('key', 'cara_berdonasi');
        })->get();

        $rekening = Informasi::where('parent_id', function ($query) {
            $query->select('id')
                ->from('informasis')
                ->where('key', 'rekening_resmi');
        })->get();

        $informasi = Informasi::all()->pluck('value', 'key')->toArray();

        $programs = Program::all();

        $program_prioritas = Program::where('is_priority', true)->first();

        // dd($informasi, $trusts, $cara_berdonasi, $programs);

        return view('frontend.mainpage', compact('programs', 'program_prioritas', 'trusts', 'cara_berdonasi', 'informasi', 'informasi_facts', 'alur_steps', 'rekening'));
    }

    public function donasi(string $link)
    {
        $program = Program::where('link', $link)->firstOrFail();

        $metode_pembayarans = MetodePembayaran::all();

        $template_name = config('helper.template_name');

        $informasi = Informasi::all()->pluck('value', 'key')->toArray();


        return view('frontend.donating', compact('program', 'metode_pembayarans', 'template_name', 'informasi'));
    }

    public function donasiStore(Program $program, Request $request)
    {
        $request->validate([
            'jumlah_donasi' => 'required|numeric|min:1000', // Batas minimal pembayaran online
            'nama'          => 'required|string|max:255',
            'nomor_hp'      => 'required|string|max:20',
            'metode_pembayaran_id' => 'nullable', // Boleh diabaikan jika memilih metode langsung di popup Snap
        ]);

        // 1. Generate Order ID Unik
        $orderId = 'DONASI-' . time() . '-' . Str::random(5);

        // 2. Simpan Data Donasi Awal ke Database
        $donasi = Donasi::create([
            'order_id'             => $orderId,
            'program_id'           => $program->id,
            'jumlah_donasi'        => $request->input('jumlah_donasi'),
            'nama'                 => $request->input('nama'),
            'nomor_hp'             => $request->input('nomor_hp'),
            'metode_pembayaran_id' => $request->input('metode_pembayaran_id'),
            'status_pembayaran'    => 'pending',
        ]);

        // 3. Konfigurasi SDK Midtrans
        Config::$serverKey     = config('services.midtrans.server_key', env('MIDTRANS_SERVER_KEY'));
        Config::$isProduction  = config('services.midtrans.is_production', env('MIDTRANS_IS_PRODUCTION', false));
        Config::$isSanitized   = config('services.midtrans.is_sanitized', env('MIDTRANS_IS_SANITIZED', true));
        Config::$is3ds         = config('services.midtrans.is_3ds', env('MIDTRANS_IS_3DS', true));

        // 4. Susun Payload untuk Midtrans Snap
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
            // 5. Minta Snap Token dari Midtrans
            $snapToken = Snap::getSnapToken($params);

            // Update record donasi dengan Snap Token
            $donasi->update(['snap_token' => $snapToken]);

            // 6. Redirect ke halaman pembayaran dengan membawa token
            return redirect()->route('donasi.pembayaran', $donasi->order_id);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', 'Gagal memproses pembayaran: ' . $e->getMessage());
        }
    }

    public function pembayaran(string $orderId)
    {
        $donasi = Donasi::where('order_id', $orderId)->firstOrFail();

        return view('frontend.pembayaran', [
            'donasi' => $donasi,
            'clientKey' => env('MIDTRANS_CLIENT_KEY')
        ]);
    }
}
