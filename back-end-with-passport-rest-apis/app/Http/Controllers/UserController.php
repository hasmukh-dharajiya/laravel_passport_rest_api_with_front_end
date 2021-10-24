<?php

namespace App\Http\Controllers;

use App\Classes\UserClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use HasApiTokens;

class UserController extends Controller
{
    private $user;

    public function __construct(UserClass $user)
    {
        $this->user = $user;
    }

    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required|same:confirm_password|min:8',
            'confirm_password' => 'required|min:8'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['status' => false, 'message' => $error])->setStatusCode(400);
        }
        $email = Auth::user()->email;

        return $this->user->changePassword($email, $request->current_password, $request->new_password);
    }

    public function getProfile(){
        return $this->user->getProfile();
    }
    public function updateSetting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'setting_name' => 'required|string',
            'setting_value' => 'required|boolean'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['status' => false, 'message' => $error])->setStatusCode(400);
        }
        $email = Auth::user()->email;
        return $this->user->updateSetting($email, $request->setting_name, $request->setting_value);
    }

    public function updateProfileHeadline(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'headline' => 'required|string|max:100'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['status' => false, 'message' => $error])->setStatusCode(400);
        }
        $email = Auth::user()->email;
        return $this->user->updateProfileHeadline($email, $request->name, $request->headline);
    }

    public function updateProfileInformation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'mobile' => 'required|max:10',
            'description' => 'required|string',
            'location' => 'required|string'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->first();
            return response()->json(['status' => false, 'message' => $error])->setStatusCode(400);
        }
        $email = Auth::user()->email;
        return $this->user->updateProfileInformation($email, $request->name, $request->mobile, $request->description, $request->location);
    }

    public function logoutUser(Request $request)
    {
        if (Auth::user()->token()){
            $user = Auth::user()->token();
            if ( $user->revoke()) {
                return response()->json([
                    'status' => true,
                    'message' => 'User has been logged out'
                ]);
            }
            return response()->json([
                'status' => false,
                'message' => 'error while logged out'
            ]);
        }
    }
}
