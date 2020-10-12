<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:12', 'unique:users,name'],
            'password' => ['required', 'max:16', 'min:6']
        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }

        User::create($request->all());
        return '用户注册成功。。。';
    }

    public function login(Request $request)
    {
        3/0;
        $validator = Validator::make($request->all(), [
            'name' => ['required'],
            'password' => ['required']
        ]);
        if ($validator->fails()) {
            return $validator->errors()->first();
        }

        $res=Auth::guard('web')->attempt(['name'=>$request->name,'password'=>$request->password]);
        if($res){
            return $this->success();
        }
        return $this->failed('登录失败');
    }
}