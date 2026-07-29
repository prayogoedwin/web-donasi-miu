<?php

namespace App\Http\Controllers;

use App\Models\Program;
use App\Models\KategoriProgram;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ProgramController extends Controller
{
    public function index()
    {
        return view('programs.index');
    }

    public function indexTable(Request $request)
    {
        if ($request->ajax()) {
            $programs = Program::with('kategori_program')->select('programs.*');
            
            return DataTables::of($programs)
                ->addColumn('kategori_programs', function ($program) {
                    return $program->kategori_program ? $program->kategori_program->title : '<span class="text-sm text-gray-500 dark:text-gray-400">No category</span>';
                })
                ->addColumn('progress', function ($program) {
                    
                    // collected_amount / target_amount * 100
                    $progress = ($program->collected_amount / $program->target_amount) * 100;
                    return number_format($progress, 2) . '%';

                })
                ->addColumn('actions', function ($program) {
                    $actions = '';
                    
                    if (auth()->user()->hasPermission('show-programs')) {
                        $actions .= '<a href="' . route('programs.show', $program) . '" class="text-green-600 dark:text-green-400 hover:underline mr-3">View</a>';
                    }
                    
                    if (auth()->user()->hasPermission('edit-programs')) {
                        $actions .= '<a href="' . route('programs.edit', $program) . '" class="text-blue-600 dark:text-blue-400 hover:underline mr-3">Edit</a>';
                    }
                    
                    if (auth()->user()->hasPermission('delete-programs')) {
                        $actions .= '<form action="' . route('programs.destroy', $program) . '" method="POST" class="inline" onsubmit="return confirm(\'Are you sure?\')">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="submit" class="text-red-600 dark:text-red-400 hover:underline">Delete</button>
                        </form>';
                    }
                    
                    return $actions;
                })
                ->editColumn('created_at', function ($program) {
                    return $program->created_at->format('M d, Y');
                })
                ->rawColumns(['kategori_programs', 'actions', 'progress'])
                ->make(true);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }

    public function show(Program $program)
    {
        return view('programs.show', compact('program'));
    }

    public function create()
    {
        $kategoriPrograms = KategoriProgram::all();
        
        return view('programs.create', compact('kategoriPrograms'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'kategori_program_id' => 'required|exists:kategori_programs,id',
        ]);

        Program::create($request->all());

        return redirect()->route('programs.index')->with('success', 'Program created successfully.');
    }

    public function edit(Program $program)
    {

        $kategoriPrograms = KategoriProgram::all();

        return view('programs.edit', compact('program', 'kategoriPrograms'));
    }

    public function update(Request $request, Program $program)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'target_amount' => 'required|numeric|min:0',
            'kategori_program_id' => 'required|exists:kategori_programs,id',
        ]);

        $program->update($request->all());

        return redirect()->route('programs.index')->with('success', 'Program updated successfully.');
    }

    public function destroy(Program $program)
    {
        $program->delete();

        return redirect()->route('programs.index')->with('success', 'Program deleted successfully.');
    }
}
