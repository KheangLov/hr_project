<?php

namespace App\Http\Controllers;

use App\Department;
use App\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UnitController extends Controller
{
    public function __construct()
	{
        $this->middleware(['auth']);
    }

    public function index()
    {
        $units = Unit::with('department')->paginate(10);
        $departments = Department::all();
        return view('admin.unit.index', [
            'units' => $units,
            'departments' => $departments
        ]);
    }

    public function create(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|max:50|unique:units',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('unit_list')
                ->withErrors($validator)
                ->with('error', 'There are some errors, please check!');
        }

        $unit = Unit::create([
            'name' => $req->name,
            'department_id' => $req->department
        ]);
        return redirect()->route('unit_list')->with('success', 'Unit created!');
    }

    public function edit($id)
    {
        $unit = Unit::find($id);
        $departments = Department::all();
        return view('admin.unit.share.form', [
            'unit' => $unit,
            'departments' => $departments,
            'type' => 'edit'
        ]);
    }

    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|max:50|unique:units,name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('unit_list')
                ->withErrors($validator)
                ->with('error', 'There are some errors, please check!');
        }

        $unit = Unit::find($id);
        $unit->name = $req->name;
        $unit->department_id = $req->department;
        $unit->save();
		$unit->update();
        return redirect()->route('unit_list')->with('success', 'Unit updated!');
    }

    public function delete($id)
    {
        $unit = Unit::where('id', $id);

        $deleted = $unit->delete();
        if ($deleted === 0)
            return redirect()
                ->route('unit_list')
                ->with('warning', 'Can delete current unit!');

		return redirect()
			->route('unit_list')
			->with('success', 'Unit deleted successfully');
    }

    public function search(Request $request)
    {
        $units = Unit::whereRaw('LOWER(`name`) LIKE ? ', ['%' . strtolower($request->search) .'%'])
            ->paginate(10);

        return view('admin.unit.share.table', ['units' => $units]);
    }
}
