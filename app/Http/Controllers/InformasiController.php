<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Informasi;

class InformasiController extends Controller
{
    public function index()
    {
        return view('informasis.index');
    }

    public function indexTable(Request $request)
    {
        if ($request->ajax()) {
            $informasis = Informasi::select('informasis.*')->orderBy('id', 'asc');

            return datatables()->of($informasis)
                ->addColumn('parent', function ($informasi) {
                    return $informasi->parent ? $informasi->parent->key : "Tidak Ada";
                })
                ->addColumn('actions', function ($informasi) {
                    $actions = '';

                    if (auth()->user()->hasPermission('show-informasis')) {
                        $actions .= '<a href="' . route('informasis.show', $informasi) . '" class="text-green-600 dark:text-green-400 hover:underline mr-3">View</a>';
                    }

                    if (auth()->user()->hasPermission('edit-informasis')) {
                        $actions .= '<a href="' . route('informasis.edit', $informasi) . '" class="text-blue-600 dark:text-blue-400 hover:underline mr-3">Edit</a>';
                    }

                    if (auth()->user()->hasPermission('delete-informasis')) {
                        $actions .= '<form action="' . route('informasis.destroy', $informasi) . '" method="POST" class="inline" onsubmit="return confirm(\'Are you sure?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Delete</button>
                        </form>';
                    }

                    return $actions;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function create()
    {

        $informasis = Informasi::all();

        return view('informasis.create', compact('informasis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'key' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:informasis,id',
        ]);

        Informasi::create([
            'key' => $request->input('key'),
            'value' => $request->input('value'),
            'parent_id' => $request->input('parent_id'),
        ]);

        return redirect()->route('informasis.index')->with('success', 'Informasi created successfully.');
    }

    public function show(Informasi $informasi)
    {
        return view('informasis.show', compact('informasi'));
    }

    public function edit(Informasi $informasi)
    {
        $informasis = Informasi::where('id', '!=', $informasi->id)->get();

        return view('informasis.edit', compact('informasi', 'informasis'));
    }

    public function update(Request $request, Informasi $informasi)
    {
        $request->validate([
            'key' => 'required|string|max:255',
            'value' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:informasis,id',
        ]);

        $informasi->update($request->all());

        return redirect()->route('informasis.index')->with('success', 'Informasi updated successfully.');
    }

    public function destroy(Informasi $informasi)
    {
        $informasi->delete();

        return redirect()->route('informasis.index')->with('success', 'Informasi deleted successfully.');
    }
}
