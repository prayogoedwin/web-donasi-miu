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

                    if (auth()->user()->hasPermission('show-kategori-programs')) {
                        $actions .= '<a href="' . route('kategori-programs.show', $kategoriProgram) . '" class="text-green-600 dark:text-green-400 hover:underline mr-3">View</a>';
                    }

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
}
