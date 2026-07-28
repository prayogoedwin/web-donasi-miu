<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KategoriProgram;

class KategoriProgramController extends Controller
{
    public function index()
    {
        return view('kategori-programs.index');
    }

    public function indexTable(Request $request)
    {
        if ($request->ajax()) {
            $kategoriPrograms = KategoriProgram::select('kategori_programs.*');

            return datatables()->of($kategoriPrograms)
                ->addColumn('actions', function ($kategoriProgram) {
                    $actions = '';


                    if (auth()->user()->hasPermission('edit-kategori-programs')) {
                        $actions .= '<a href="' . route('kategori-programs.edit', $kategoriProgram) . '" class="text-blue-600 dark:text-blue-400 hover:underline mr-3">Edit</a>';
                    }

                    if (auth()->user()->hasPermission('delete-kategori-programs')) {
                        $actions .= '<form action="' . route('kategori-programs.destroy', $kategoriProgram) . '" method="POST" class="inline" onsubmit="return confirm(\'Are you sure?\')">
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

    public function show(KategoriProgram $kategoriProgram)
    {
        return view('kategori-programs.show', compact('kategoriProgram'));
    }

    public function create()
    {
        return view('kategori-programs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        KategoriProgram::create(
            [
                'title' => $request->input('title'),
                'description' => $request->input('description'),
            ]
        );

        return redirect()->route('kategori-programs.index')->with('success', 'Kategori Program created successfully.');
    }

    public function edit(KategoriProgram $kategoriProgram)
    {
        return view('kategori-programs.edit', compact('kategoriProgram'));
    }

    public function update(Request $request, KategoriProgram $kategoriProgram)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        $kategoriProgram->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('kategori-programs.index')->with('success', 'Kategori Program updated successfully.');
    }

    public function destroy(KategoriProgram $kategoriProgram)
    {
        $kategoriProgram->delete();

        return redirect()->route('kategori-programs.index')->with('success', 'Kategori Program deleted successfully.');
    }
}
