<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'request_date',
        'leave_time',
        'total_leave_date',
        'reason',
        'first_app_comment',
        'second_app_comment',
        'remaining_leave',
        'status',
        'leave_type',
        'back_date',
        'supervisor_id',
        'user_id',
        'second_app_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
