<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClickAttendance extends Model
{
    protected $fillable = [
        'name',
        'date',
        'real_time_in',
        'real_time_out',
        'total_time',
        'status',
        'staff_note',
        'hr_note',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
