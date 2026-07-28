<?php

namespace App\Http\Controllers;
use App\Models\Program;
use App\Models\Informasi;

class FrontEndController extends Controller
{
    public function index()
    {

        $trusts = Informasi::where('parent_id', function($query) {
            $query->select('id')
                ->from('informasis')
                ->where('key', 'keunggulan_portal');
        })->get();

        $informasi_facts = Informasi::where('parent_id', function($query) {
            $query->select('id')
                ->from('informasis')
                ->where('key', 'statistik_masjid');
        })->get();

        $cara_berdonasi = Informasi::where('parent_id', function($query) {
            $query->select('id')
                ->from('informasis')
                ->where('key', 'cara_berdonasi');
        })->get();

        $alur_steps = Informasi::where('parent_id', function($query) {
            $query->select('id')
                ->from('informasis')
                ->where('key', 'cara_berdonasi');
        })->get();

        $rekening = Informasi::where('parent_id', function($query) {
            $query->select('id')
                ->from('informasis')
                ->where('key', 'rekening_resmi');
        })->get();

        $informasi = Informasi::all()->pluck('value', 'key')->toArray();

        $programs = Program::all();

        // dd($informasi, $trusts, $cara_berdonasi, $programs);

        return view('frontend.mainpage', compact('programs', 'trusts', 'cara_berdonasi', 'informasi', 'informasi_facts', 'alur_steps', 'rekening'));
    }
}