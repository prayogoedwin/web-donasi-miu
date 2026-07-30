<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;

use App\Models\Program;
use App\Models\Informasi;
use App\Models\MetodePembayaran;

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
            'jumlah_donasi' => 'required|numeric|min:1',
            'nama' => 'required|string|max:255',
            'nomor_hp' => 'required|string|max:20',
            'metode_pembayaran_id' => 'required|exists:metode_pembayarans,id',
        ]);

        $donasi = Donasi::create([
            'program_id' => $program->id,
            'jumlah_donasi' => $request->input('jumlah_donasi'),
            'nama' => $request->input('nama'),
            'nomor_hp' => $request->input('nomor_hp'),
            'metode_pembayaran_id' => $request->input('metode_pembayaran_id'),
        ]);

        // dd($donasi);

        return redirect()->route('frontend.mainpage')->with('status', 'Donasi berhasil.');
    }
}
