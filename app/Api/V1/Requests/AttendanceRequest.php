<?php

namespace App\Api\V1\Requests;

use Config;
use Dingo\Api\Http\FormRequest;

class AttendanceRequest extends FormRequest
{
    public function rules()
    {
        return Config::get('boilerplate.attendance_leave.validation_rules');
    }

    public function authorize()
    {
        return true;
    }
}
