<?php

namespace App\Http\Controllers\Api;

use App\Service\AuthService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'password' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return $this->failed($validator->messages()->first());
        }
        AuthService::register($request);
        return $this->message('注册成功');
    }

    protected function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return $this->failed($validator->messages()->first());
        }
        AuthService::login($request);
        return $this->message('登陆成功');
    }
}