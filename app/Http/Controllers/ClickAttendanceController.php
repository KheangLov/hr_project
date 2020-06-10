<?php

namespace App\Http\Controllers;

use App\ClickAttendance;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Location;

class ClickAttendanceController extends Controller
{
    public function __construct()
    {
        $this->ipInfo = file_get_contents('https://ipapi.co/ip/');
        $this->clientInformation = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . request()->ip()));
        $this->middleware(['auth']);
    }

    public function startWork(Request $request)
    {
        // dd(request()->ip());
        // if ($this->ipInfo != '110.74.219.98') {
        //     alert()->error('Wrong IP!');
        //     return redirect()->route('admin_dashboard');
        // }
        // dd($this->clientInformation);
        $ip = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));

        dd("Public IP: ".$ip);
        $status = 0;
        $strtime = strtotime('08:00:00');
        $start_time = date('H:i:s', $strtime);
        $now = Carbon::now($this->clientInformation['geoplugin_timezone']);
        $date = $now->toDateString();
        $time = $now->toTimeString();
        $clicked = ClickAttendance::where('date', $date)
            ->where('user_id', Auth::user()->id)
            ->get();

        if (count($clicked) > 0) {
            if ($clicked[0]->real_time_out != null) {
                alert()->error('You have ended work!');
                return redirect()->route('admin_dashboard');
            }
            alert()->error('You have clicked already!');
            return redirect()->route('admin_dashboard');
        }

        if ($time < '07:00:00' || $time > '17:30:00') {
            alert()->error('Wait until 7am!');
            return redirect()->route('admin_dashboard');
        }
        if (strtolower($this->clientInformation['geoplugin_city']) != 'phnom penh') {
            alert()->error('You can not click from your current location!');
            return redirect()->route('admin_dashboard');
        }

        if ($start_time > $time) {
            $status = 1;
        }

        $data = [
            'name' => Auth::user()->name,
            'date' => $date,
            'real_time_in' => $time,
            'status' => $status,
            'user_id' => Auth::user()->id
        ];

        $clickAtt = ClickAttendance::create($data);
        alert()->success('Successfully clicked!');
        return redirect()
            ->route('admin_dashboard')
            ->with([
                'status' => $status,
                'date' => $date
            ]);
    }

    public function staffNote(Request $request) {
        if ($request->status == 0) {
            $validator = Validator::make($request->all(), [
                'staff_note' => 'required|min:6|max:255'
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->route('admin_dashboard')
                    ->withErrors($validator)
                    ->with('error', 'There are some errors, please check!');
            }
            $click = ClickAttendance::where('user_id', Auth::user()->id)
                ->where('date', $request->date)
                ->get();
            $click[0]->staff_note = $request->staff_note;
            $click[0]->save();
            $click[0]->update();
            $request->session()->forget('status');
            return redirect()->route('admin_dashboard')->with('success', 'Noted!');
        }
    }

    public function endWork(Request $request) {
        if ($this->ipInfo != '110.74.219.98') {
            alert()->error('Wrong IP!');
            return redirect()->route('admin_dashboard');
        }

        $strtime = strtotime('17:30:00');
        $end_time = date('H:i:s', $strtime);
        $now = Carbon::now($this->clientInformation['geoplugin_timezone']);
        $date = $now->toDateString();
        $time = Carbon::createFromFormat('H:i:s', $now->toTimeString());

        $clicked = ClickAttendance::where('date', $date)
            ->where('user_id', Auth::user()->id)
            ->get();
        if (count($clicked) < 0 || $clicked[0]->real_time_in == null) {
            alert()->error('You have not clicked yet!');
            return redirect()->route('admin_dashboard');
        }
        if ($clicked[0]->real_time_out != null) {
            alert()->error('Already ended work!');
            return redirect()->route('admin_dashboard');
        }

        $total_time = Carbon::createFromFormat('H:i:s', $clicked[0]->real_time_in)->diffInHours($time);
        $clicked[0]->real_time_out = $time;
        $clicked[0]->total_time = $total_time;
        $clicked[0]->save();
        $clicked[0]->update();
        return redirect()->route('admin_dashboard')->with('success', 'Ended work!');
    }

    public function list()
    {
        $clicked = ClickAttendance::all();
        return view('admin.attendance.click-attendance', ['clicked' => $clicked]);
    }

    public function hrNote(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'hr_note' => 'required|min:6|max:255'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('click_attendance_list')
                ->withErrors($validator)
                ->with('error', 'There are some errors, please check!');
        }

        $click = ClickAttendance::find($id);
        return redirect()->route('click_attendance_list')->with('success', 'Noted!');
    }
}
