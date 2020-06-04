<?php

namespace App\Http\Controllers;

use App\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function __construct()
	{
        $this->middleware(['auth']);
    }

    public function index()
    {
        $departments = Department::paginate(10);
        return view('admin.department.index', [
            'departments' => $departments
        ]);
    }

    public function create(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|max:50|unique:departments',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('department_list')
                ->withErrors($validator)
                ->with('error', 'There are some errors, please check!');
        }

        $department = Department::create([
            'name' => $req->name
        ]);
        return redirect()->route('department_list')->with('success', 'Department created!');
    }

    public function edit($id)
    {
        $department = Department::find($id);
        return view('admin.department.share.form', [
            'department' => $department,
            'type' => 'edit'
        ]);
    }

    public function update(Request $req, $id)
    {
        $validator = Validator::make($req->all(), [
            'name' => 'required|max:50|unique:departments,name,' . $id,
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('department_list')
                ->withErrors($validator)
                ->with('error', 'There are some errors, please check!');
        }

        $department = Department::find($id);
        $department->name = $req->name;
        $department->save();
		$department->update();
        return redirect()->route('department_list')->with('success', 'Department updated!');
    }

    public function delete($id)
    {
        $department = Department::where('id', $id);

        $deleted = $department->delete();
        if ($deleted === 0)
            return redirect()
                ->route('department_list')
                ->with('warning', 'Can delete current department!');

		return redirect()
			->route('department_list')
			->with('success', 'Department deleted successfully');
    }

    public function search(Request $request)
    {
        $departments = Department::whereRaw('LOWER(`name`) LIKE ? ', ['%' . strtolower($request->search) .'%'])
            ->paginate(10);

        return view('admin.department.share.table', ['departments' => $departments]);
    }
}
