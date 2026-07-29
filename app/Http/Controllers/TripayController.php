<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tripay;

class TripayController extends Controller
{
    public function index()
    {
        $tripay = Tripay::first();
        return view('enviroment.tripay', compact('tripay'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'environment' => 'required|in:sandbox,production',
            'api_key' => 'required|string',
            'url_sandbox' => 'required|url',
            'url_production' => 'required|url',
        ]);

        $tripay = Tripay::first();
        if (!$tripay) {
            $tripay = new Tripay();
        }
        $tripay->update(
            [
                'environment' => $request->input('environment'),
                'api_key' => $request->input('api_key'),
                'url_sandbox' => $request->input('url_sandbox'),
                'url_production' => $request->input('url_production'),
            ]
        );
        return redirect()->route('tripay.index')->with('status', 'Tripay configuration updated successfully.');
    }
}
