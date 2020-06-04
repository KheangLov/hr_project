<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PositionController extends Controller
{
    public function __construct()
	{
        $this->middleware(['auth']);
        $this->count_position = count(Position::all());
    }

    public function index()
    {
        $positions = Position::paginate(10);
        return view('admin.position.index', [
            'positions' => $positions,
            'count_position' => $this->count_position
        ]);
    }

    public function create(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|max:50|postitions',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('position_list')
                ->withErrors($validator)
                ->with('error', 'There are some errors, please check!');
        }

        $position = Position::create([
            'name' => $req->name,
            'role' => $this->count_position + 1
        ]);
        return redirect()->route('position_list')->with('success', 'Position created!');
    }

    public function edit($id)
    {
        $position = Position::find($id);
        return view('admin.position.share.form', [
            'position' => $position,
            'type' => 'edit',
            'count_position' => $this->count_position
        ]);
    }

    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|max:50|groups:positions,name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('position_list')
                ->withErrors($validator)
                ->with('error', 'There are some errors, please check!');
        }

        $position = Position::find($id);
        $other_pos = Position::where('role', $req->role)->get();
        if (count($other_pos) > 0) {
            $other_pos[0]->role = $position->role;
            $other_pos[0]->save();
            $other_pos[0]->update();
        }

        $position->name = $req->name;
        $position->role = $req->role;
        $position->save();
        $position->update();
        return redirect()->route('position_list')->with('success', 'Position updated!');
    }

    public function delete($id)
    {
        $position = Position::where('id', $id);

        $deleted = $position->delete();
        if ($deleted === 0)
            return redirect()
                ->route('position_list')
                ->with('warning', 'Can delete current position!');

        $max_role = Position::max('role');
        if ($max_role > count(Position::all())) {
            $pos = Position::where('role', $max_role)->get();
            $pos[0]->role = count(Position::all());
            $pos[0]->save();
            $pos[0]->update();
        }

		return redirect()
			->route('position_list')
			->with('success', 'Position deleted successfully');
    }

    public function search(Request $request)
    {
        $positions = Position::whereRaw('LOWER(`name`) LIKE ? ', ['%' . strtolower($request->search) .'%'])
            ->paginate(10);

        return view('admin.position.share.table', ['positions' => $positions]);
    }
}
