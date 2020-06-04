<?php

namespace App\Api\V1\Controllers;

use App\Api\V1\Requests\AttendanceRequest;
use App\Http\Controllers\Controller;
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
        $this->middleware('jwt.auth', []);
    }

    public function my_leave()
    {
        $leave_lists = Attendance::with('user')
            ->where('user_id', auth()->guard('api')->user()->id)
            ->get();
        return response()->json($leave_lists);
    }

    public function leave(AttendanceRequest $req)
    {
        $admin = User::where('role_id', 1)->get();

        $data = [
            'request_date' => $req->request_date,
            'leave_time' => 0,
            'reason' => $req->reason,
            'status' => '1',
            'leave_type' => 0,
            'user_id' => auth()->guard('api')->user()->id,
            'second_app_id' => $admin[0]->id
        ];

        if (auth()->guard('api')->user()->supervisor_id != '') {
            $data['supervisor_id'] = auth()->guard('api')->user()->supervisor_id;
            $data['status'] = 0;
        }

        $data['total_leave_date'] = 1;

        $attendance = Attendance::create($data);
        return response()->json([
            'attendance' => $attendance,
            'status' => 'ok',
        ]);
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
