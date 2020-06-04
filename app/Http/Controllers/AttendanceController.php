<?php

namespace App\Http\Controllers;

use App\Attendance;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Carbon;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('admin.attendance.index');
    }

    public function myLeave()
    {
        $admin = User::where('role_id', 1)->get();
        $supervisor = User::find(Auth::user()->supervisor_id);
        $leave_lists = Attendance::where('user_id', Auth::user()->id)->get();
        return view('admin.attendance.my-leave', [
            'supervisor' => $supervisor,
            'admin' => $admin[0],
            'leave_lists' => $leave_lists
        ]);
    }

    public function leave(Request $req)
    {
        $admin = User::where('role_id', 1)->get();

        $validator = Validator::make($req->all(), [
            'request_date' => 'required|date|date_format:Y-m-d|after:yesterday',
            'leave_time' => 'required',
            'reason' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('staff_my_leave')
                ->withErrors($validator)
                ->with('error', 'There are some errors, please check!');
        }

        $data = [
            'request_date' => $req->request_date,
            'leave_time' => $req->leave_time,
            'reason' => $req->reason,
            'status' => '1',
            'leave_type' => $req->leave_type,
            'user_id' => Auth::user()->id,
            'second_app_id' => $admin[0]->id
        ];

        $leave = 0;
        if ($req->leave_type == 0 && $req->leave_time == 0) $leave = 1;
        else $leave = 0.5;

        if (Auth::user()->supervisor_id != '') {
            $data['supervisor_id'] = Auth::user()->supervisor_id;
            $data['status'] = 0;
        }

        if ($req->leave_type == 1 && !isset($req->back_date)) {
            return redirect()
                ->route('staff_my_leave')
                ->with('error', 'Please give the back date!');
        }
        if ($req->leave_type == 1 && isset($req->back_date)) {
            $data['back_date'] = $req->back_date;
            $bd = Carbon::parse($req->back_date);
            $leave = $bd->diffInDays($req->request_date) + 1;
        }

        $data['total_leave_date'] = $leave;

        $attendance = Attendance::create($data);
        return redirect()
            ->route('staff_my_leave')
            ->with('success', 'Request submited!');
    }

    public function leave_type($type)
    {
        return view('admin.attendance.share.form', ['type' => $type]);
    }

    public function list()
    {
        $leave_lists = Attendance::with(['user'])->get();
        $current_date = Carbon::now();
        return view('admin.attendance.list', [
            'leave_lists' => $leave_lists,
            'current_date' => $current_date
        ]);
    }

    public function sort_by_status($status)
    {
        $leave_lists = null;
        if ($status == '*') {
            $leave_lists = Attendance::all();
        } else {
            $leave_lists = Attendance::where('status', $status)->get();
        }
        $current_date = Carbon::now();
        return view('admin.attendance.share.table', [
            'leave_lists' => $leave_lists,
            'current_date' => $current_date
        ]);
    }

    public function approval(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'comment' => 'required|max:255',
            'user_id' => 'required',
            'id' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('staff_leave_list')
                ->withErrors($validator)
                ->with('error', 'There are some errors, please check!');
        }

        $attendance = Attendance::find($req->id);

        if (isset($req->disapprove) && strtolower($req->disapprove) == 'disapproved') {
            $attendance->status = -1;
            $attendance->save();
            $attendance->update();
            return redirect()->route('staff_leave_list')->with('error', 'Request disapproved!');
        }

        if (Auth::user()->role_id == 1) {
            $attendance->second_app_comment = $req->comment;
            $attendance->status = 2;

            $user = User::find($req->user_id);

            $user->annual_leave = floatval($user->annual_leave) - floatval($attendance->total_leave_date);
            $user->save();
            $user->update();
        } else {
            $attendance->first_app_comment = $req->comment;
            $attendance->status = 1;
        }

        $attendance->save();
        $attendance->update();
        return redirect()->route('staff_leave_list')->with('success', 'Request approved!');
    }

    public function teamLeave()
    {
        $leave_lists = Attendance::with(['user'])->get();
        $current_date = Carbon::now();
        return view('admin.attendance.list', [
            'leave_lists' => $leave_lists,
            'current_date' => $current_date
        ]);
    }
}
