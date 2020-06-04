<?php

namespace App\Api\V1\Controllers;

use Config;
use App\User;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\SignUpRequest;
use Symfony\Component\HttpKernel\Exception\HttpException;

class SignUpController extends Controller
{
    public function signUp(SignUpRequest $request, JWTAuth $JWTAuth)
    {
        $data = [
            'name_khmer' => $request->name_khmer,
            'name' => $request->name,
            'gender' => $request->gender,
            'dob' => $request->dob,
            'status' => $request->status,
            'email' => $request->email,
            'password' => $request->password,
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

        if ($request->hasfile('profile'))
        {
            $file = $request->file('profile');
            $name = time() . $file->getClientOriginalName();
            $filePath = 'hr_project/images/' . $name;
            $uploaded = Storage::disk('s3')->put($filePath, file_get_contents($file), 'public');
            $data['profile'] = Storage::disk('s3')->url($filePath);
        }

        // $user = new User($request->all());
        $user = User::create($data);
        if(!$user) {
            throw new HttpException(500);
        }

        if(!Config::get('boilerplate.sign_up.release_token')) {
            return response()->json([
                'status' => 'ok'
            ], 201);
        }

        $token = $JWTAuth->fromUser($user);
        return response()->json([
            'status' => 'ok',
            'token' => $token,
            'user' => $user
        ], 201);
    }
}
