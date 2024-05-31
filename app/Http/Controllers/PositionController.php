<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    public function index() {
        $positions = Position::where('tbl_positions.is_deleted', false);

        if(request()->has('search')) {
            $searchTerm = request()->get('search');

            if($searchTerm) {
                $positions = $positions->where(function($query) use($searchTerm) {
                    $query->where('tbl_positions.position', 'like', "%$searchTerm%");
                });
            }
        }

        $positions = $positions->paginate(25)
            ->appends(['search' => request()->get('search')]);

        return view('position.index', compact('positions'));
    }

    public function create() {
        return view('position.create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'position' => ['required', 'max:55'],
        ]);

        Position::create([
            'position' => strtoupper($validated['position']),
        ]);

        return redirect('/positions')->with('success', 'POSITION SUCCESSFULLY ADDED.');
    }

    public function edit($position_id) {
        $position = Position::find($position_id);
        return view('position.edit', compact('position'));
    }

    public function update(Request $request, Position $position) {
        $validated = $request->validate([
            'position' => ['required', 'max:55'],
        ]);

        $position->update([
            'position' => strtoupper($validated['position']),
        ]);

        return redirect('/positions')->with('success', 'POSITION SUCCESSFULLY UPDATED.');
    }

    public function delete($position_id) {
        $position = Position::find($position_id);
        return view('position.delete', compact('position'));
    }

    public function destroy(Position $position) {
        $position->update([
            'is_deleted' => true,
        ]);

        return redirect('/positions')->with('success', 'POSITION SUCCESSFULLY DELETED.');
    }
}
