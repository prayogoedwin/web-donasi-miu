<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donasi;
class DonasiController extends Controller
{
    // history donasi 
    public function index()
    {
        $donasis = Donasi::all();

        return view('donasis.index', compact('donasis'));
    }

    public function indexTable(Request $request)
    {
        if ($request->ajax()) {
            $donasis = Donasi::with('program')->select('donasis.*')->orderBy('created_at', 'desc');
            
            return datatables()->of($donasis)
                ->addColumn('program_title', function ($donasi) {
                    return $donasi->program ? $donasi->program->title : '<span class="text-sm text-gray-500 dark:text-gray-400">No program</span>';
                })
                ->editColumn('created_at', function ($donasi) {
                    return $donasi->created_at->format('M d, Y');
                })
                ->addColumn('actions', function ($donasi) {
                    $actions = '';
                    
                    if (auth()->user()->hasPermission('show-donasis')) {
                        $actions .= '<a href="' . route('donasis.show', $donasi) . '" class="text-green-600 dark:text-green-400 hover:underline mr-3">View</a>';
                    }
                    
                    if (auth()->user()->hasPermission('edit-donasis')) {
                        $actions .= '<a href="' . route('donasis.edit', $donasi) . '" class="text-blue-600 dark:text-blue-400 hover:underline mr-3">Edit</a>';
                    }
                    
                    if (auth()->user()->hasPermission('delete-donasis')) {
                        $actions .= '<form action="' . route('donasis.destroy', $donasi) . '" method="POST" class="inline" onsubmit="return confirm(\'Are you sure?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Delete</button>
                        </form>';
                    }
                    
                    return $actions;
                })
                ->rawColumns(['program_title', 'actions'])
                ->make(true);
        }
        return response()->json(['error' => 'Invalid request'], 400);
    }
}
