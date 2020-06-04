<?php

namespace App\Http\Controllers;

use App\Group;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    public function __construct()
	{
        $this->middleware(['auth']);
    }

    public function index()
    {
        $groups = Group::with('unit')->paginate(10);
        $units = Unit::all();
        return view('admin.group.index', [
            'groups' => $groups,
            'units' => $units
        ]);
    }

    public function create(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|max:50|unique:groups',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('group_list')
                ->withErrors($validator)
                ->with('error', 'There are some errors, please check!');
        }

        $group = Group::create([
            'name' => $req->name,
            'unit_id' => $req->unit
        ]);
        return redirect()->route('group_list')->with('success', 'Group created!');
    }

    public function edit($id)
    {
        $group = Group::find($id);
        $units = Unit::all();
        return view('admin.group.share.form', [
            'group' => $group,
            'units' => $units,
            'type' => 'edit'
        ]);
    }

    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|max:50|groups:units,name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('group_list')
                ->withErrors($validator)
                ->with('error', 'There are some errors, please check!');
        }

        $group = Group::find($id);
        $group->name = $req->name;
        $group->unit_id = $req->unit;
        $group->save();
		$group->update();
        return redirect()->route('group_list')->with('success', 'Group updated!');
    }

    public function delete($id)
    {
        $group = Group::where('id', $id);

        $deleted = $group->delete();
        if ($deleted === 0)
            return redirect()
                ->route('group_list')
                ->with('warning', 'Can delete current group!');

		return redirect()
			->route('group_list')
			->with('success', 'Group deleted successfully');
    }

    public function search(Request $request)
    {
        $groups = Group::whereRaw('LOWER(`name`) LIKE ? ', ['%' . strtolower($request->search) .'%'])
            ->paginate(10);

        return view('admin.group.share.table', ['groups' => $groups]);
    }
}
