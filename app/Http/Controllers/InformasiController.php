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
}
