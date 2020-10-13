<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public $loginAfterSignUp = true;

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'password' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return $this->failed($validator->messages()->first());
        }

        $user = new User();
        $user->name = $request->name;
        $user->password = password($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }
        return $this->success($user);
    }

    public function login(Request $request)
    {
        $input = $request->only('name', 'password');
        $jwt_token = null;

        if (!$jwt_token = JWTAuth::attempt($input)) {
            return $this->failed('Invalid Email or Password');
        }

        return $this->success($jwt_token);
    }

    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        try {
            JWTAuth::invalidate($request->token);
            return $this->message('User logged out successfully');
        } catch (JWTException $exception) {
            return $this->failed('Sorry, the user cannot be logged out');
        }
    }

    public function getAuthUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        $user = JWTAuth::authenticate($request->token);
        return $this->success(['user' => $user]);
    }
}