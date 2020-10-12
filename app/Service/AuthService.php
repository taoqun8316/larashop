<?php
namespace App\Service;

use App\Models\User as UserModel;

class AuthService
{
    public static function register($request)
    {
        $name     = $request->input('name');
        $password = $request->input('password');

        $member = new UserModel();
        $member->name  = $name;
        $member->password = password($password);
        $res = $member->save();
        return $res;
    }

    public static function login($request)
    {
        $name     = $request->input('name');
        $password = $request->input('password');

        $password = password($password);
        $res =  UserModel::where([['name', $name], ['password', $password]])->get();
        if ($res->count() == 0){
            throw new \Exception('账户或密码错误');
        }
        return true;
    }
}