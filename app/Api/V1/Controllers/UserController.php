<?php

namespace App\Api\V1\Controllers;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Tymon\JWTAuth\JWTAuth;
use App\Http\Controllers\Controller;
use App\Api\V1\Requests\LoginRequest;
use App\Api\V1\Requests\UserRequest;
use App\User;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Auth;
use Storage;
use Dingo\Api\Http\FormRequest;

class UserController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('jwt.auth', []);
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->guard('api')->user());
    }

    public function list()
    {
        $users = User::with(['role', 'department', 'unit', 'group', 'position'])->get();
        return response()->json([
            'status' => 'ok',
            'data' => $users
        ]);
    }


    public function update(FormRequest $request, $id)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => 'required|max:50|unique:users,name,' . $id,
        //     'name_khmer' => 'required',
        //     'gender' => 'required',
        //     'email' => 'required|max:125|unique:users,email,' . $id,
        //     'dob' => 'required'
        // ]);

        // if ($validator->fails()) {
        //     return response()->json([
        //         'message' => 'There are some errors, please check!',
        //         'status' => 'error',
        //         'code' => 400
        //     ]);
        // }

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
        $user->bank_account = $request->bank_account;
        $user->start_date = $request->start_date;
        $user->end_date = $request->end_date;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->emer_contact_name = $request->contact_name;
        $user->emer_contact_relation = $request->relationship;
        $user->emer_contact_phone = $request->contact_tel;

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
        return response()->json([
            'status' => 'ok',
            'message' => 'User updated!',
            'data' => $user
        ]);
    }
}
