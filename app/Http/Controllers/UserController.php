<?php

namespace App\Http\Controllers;

use App\User;
use App\Department;
use App\Unit;
use App\Group;
use App\Position;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserNotification;
use Notification;
use Storage;

class UserController extends Controller
{
    public function __construct()
	{
        $this->middleware(['auth']);
    }

    public function index()
    {
        $departments = Department::all();
        $positions = Position::all();
        $supervisors = User::where('role_id', '!=', 1)->get();
        $users = User::with(['role', 'department', 'unit', 'group', 'position'])->paginate(10);
        return view('admin.user.index', [
            'users' => $users,
            'supervisors' => $supervisors,
            'departments' => $departments,
            'positions' => $positions
        ]);
    }

    public function get_unit_by_department($id)
    {
        if ($id < 1) {
            return response()->json(['units' => '']);
        }

        $units = Unit::where('department_id', (int)$id)->get();
        return response()->json(['units' => $units]);
    }

    public function get_group_by_unit($id)
    {
        if ($id < 1) {
            return response()->json(['groups' => '']);
        }

        $groups = Group::where('unit_id', (int)$id)->get();
        return response()->json(['groups' => $groups]);
    }

    public function detail($id)
    {
        $user = User::with(['department', 'unit', 'position', 'group', 'role'])
            ->where('id', $id)
            ->get();
        $supervisor = User::find($user[0]->supervisor_id);
        return view('admin.user.share.detail', ['user' => $user[0], 'supervisor' => $supervisor]);
    }

    public function id_card_download($id)
    {
        $user = User::find($id);
        $file = public_path() . '/' . $user->id_card;
        return response()->download($file);
    }

    public function contact_download($id)
    {
        $user = User::find($id);
        $file = public_path() . '/' . $user->contact;
        return response()->download($file);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50|unique:users',
            'name_khmer' => 'required',
            'gender' => 'required',
            'email' => 'required|email|max:125|unique:users',
            'dob' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('user_list')
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'There are some errors, please check!');
        }

        $data = [
            'name_khmer' => $request->name_khmer,
            'name' => $request->name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'status' => $request->status,
            'email' => $request->email,
            'password' => Hash::make('not4you'),
            'department_id' => $request->department,
            'unit_id' => $request->unit,
            'group_id' => $request->group,
            'supervisor_id' => $request->supervisor,
            'position_id' => $request->position,
            'annual_leave' => $request->annual_leave,
            'salary' => $request->salary,
            'back_account' => $request->bank_account,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'phone' => $request->phone,
            'address' => $request->address,
            'emer_contact_name' => $request->contact_name,
            'emer_contact_relation' => $request->relationship,
            'emer_contact_phone' => $request->contact_tel,
            'role_id' => 2
        ];

        if (isset($request->id_card)) {
            $imageName = time() . '.' . $request->id_card->extension();
            $request->id_card->move(public_path('id_cards'), $imageName);
            $img = 'id_cards/' . $imageName;
            $data['id_card'] = $img;
        }

        if (isset($request->contact)) {
            $imageName = time() . '.' . $request->contact->extension();
            $request->contact->move(public_path('contacts'), $imageName);
            $img = 'contacts/' . $imageName;
            $data['contact'] = $img;
        }

        // if (isset($request->profile)) {
        //     $imageName = time() . '.' . $request->profile->extension();
        //     $request->profile->move(public_path('images'), $imageName);
        //     $img = 'images/' . $imageName;
        //     $data['profile'] = $img;
        // }
        if ($request->hasfile('profile'))
        {
            $file = $request->file('profile');
            $name = time() . $file->getClientOriginalName();
            $filePath = 'hr_project/images/' . $name;
            $uploaded = Storage::disk('s3')->put($filePath, file_get_contents($file), 'public');
            $data['profile'] = Storage::disk('s3')->url($filePath);
        }

        $details = [
            'name' => $request->name,
            'email' => $request->email
        ];

        $users = User::all();
        Notification::send($users, new UserNotification($details));
        $user = User::create($data);
        return redirect()->route('user_list')->with('success', 'User created!');
    }

    public function edit($id)
    {
        $user = User::find($id);
        $departments = Department::all();
        $positions = Position::all();
        $supervisors = User::where('id', '!=', $id)
            ->where('role_id', '!=', 1)
            ->get();
        $units = Unit::where('department_id', $user->department_id)->get();
        $groups = Group::where('unit_id', $user->unit_id)->get();
        if ($user->role_id == 1) {
            $supervisors = [];
        }
        return view('admin.user.share.form', [
            'user' => $user,
            'type' => 'edit',
            'departments' => $departments,
            'positions' => $positions,
            'supervisors' => $supervisors,
            'units' => $units,
            'groups' => $groups
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:50|unique:users,name,' . $id,
            'name_khmer' => 'required',
            'gender' => 'required',
            'email' => 'required|max:125|unique:users,email,' . $id,
            'dob' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('user_list')
                ->withErrors($validator)
                ->with('error', 'There are some errors, please check!');
        }

        $user = User::find($id);

        $user->name = $request->name;
        $user->name_khmer = $request->name_khmer;
        $user->gender = $request->gender;
        $user->dob = $request->dob;
        $user->status = $request->status;
        $user->email = $request->email;
        $user->department_id = $request->department;
        $user->unit_id = $request->unit;
        $user->group_id = $request->group;
        $user->supervisor_id = $request->supervisor;
        $user->position_id = $request->position;
        $user->annual_leave = $request->annual_leave;
        $user->salary = $request->salary;
        $user->back_account = $request->bank_account;
        $user->start_date = $request->start_date;
        $user->end_date = $request->end_date;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->emer_contact_name = $request->contact_name;
        $user->emer_contact_relation = $request->relationship;
        $user->emer_contact_phone = $request->contact_tel;

        // if (isset($request->profile)) {
        //     $imageName = time() . '.' . $request->profile->extension();
        //     $request->profile->move(public_path('images'), $imageName);
        //     $img = 'images/' . $imageName;
        //     $user->profile = $img;
        // }
        if ($request->hasfile('profile'))
        {
            $file = $request->file('profile');
            $name = time() . $file->getClientOriginalName();
            $filePath = 'hr_project/images/' . $name;
            $uploaded = Storage::disk('s3')->put($filePath, file_get_contents($file), 'public');
            $user->profile = Storage::disk('s3')->url($filePath);
        }

        if (isset($request->id_card)) {
            $imageName = time() . '.' . $request->id_card->extension();
            $request->id_card->move(public_path('id_cards'), $imageName);
            $img = 'id_cards/' . $imageName;
            $user->id_card = $img;
        }

        if (isset($request->contact)) {
            $imageName = time() . '.' . $request->contact->extension();
            $request->contact->move(public_path('contacts'), $imageName);
            $img = 'contacts/' . $imageName;
            $user->contact = $img;
        }

		$user->save();
        $user->update();
		return redirect()->route('user_list')->with('success', 'User updated!');
    }

    public function edit_password($id)
    {
        $user = User::find($id);
        return view('admin.user.share.password', [
            'type' => 'user',
            'user' => $user
        ]);
    }

    public function changeUserPassword($id)
    {
        $user = User::find($id);
        return redirect()->route('user_list')->with('success', "User's password updated!");
    }


    public function changePassword(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8|confirmed'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('user_list')
                ->withErrors($validator)
                ->with('error', 'There are some errors, please check!');
        }

        $user = User::find($id);

        if (Hash::check($request->old_password, $user->password)) {
            return redirect()
                ->route('user_list')
                ->withErrors($validator)
                ->with('error', 'There are some errors, please check!');
        }

        $user->password = Hash::make($request->password);
		$user->save();
		$user->update();
		return redirect()
			->route('user_edit', ['id' => $id, 'user' => $user])
			->with('success', 'User\'s password updated successfully!');
    }

    public function delete($id)
    {
        $user = User::where('id', $id)
            ->where('id', '!=', Auth::user()->id);

        $deleted = $user->delete();
        if ($deleted === 0)
            return redirect()
                ->route('user_list')
                ->with('warning', 'Can\'t delete current user!');

		return redirect()
			->route('user_list')
			->with('success', 'User deleted successfully');
    }

    public function staffList()
    {
        $users = User::paginate(18);
        $departments = Department::all();
        // $units = Unit::all();
        // $groups = Group::all();
        return view('admin.user.list', [
            'users' => $users,
            'departments' => $departments,
            // 'units' => $units,
            // 'groups' => $groups
        ]);
    }

    public function search(Request $request)
    {
        $users = User::with('role')
            ->whereRaw('LOWER(`name`) LIKE ? ', ['%' . strtolower($request->search) .'%'])
            ->paginate(10);

        return view('admin.user.share.table', ['users' => $users]);
    }

    public function filter($dep, $unit, $grp)
    {
        $query = User::query();
        if ($dep > 0) {
            $query = $query->where('department_id', $dep);
        }
        if ($unit > 0) {
            $query = $query->where('unit_id', $unit);
        }
        if ($grp > 0) {
            $query = $query->where('group_id', $grp);
        }

        $users = $query->paginate(18);

        return view('admin.user.share.cards', [
            'users' => $users
        ]);
    }

    public function staff_search(Request $request)
    {
        $users = User::with('role')
            ->whereRaw('LOWER(`name`) LIKE ? ', ['%' . strtolower($request->search) .'%'])
            ->paginate(18);

        return view('admin.user.share.cards', ['users' => $users]);
    }

    public function notifications()
    {
        return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
    }
}
