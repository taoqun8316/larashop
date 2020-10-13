<?php
namespace App\Service;

use App\Models\User as UserModel;
use Illuminate\Support\Facades\Auth;

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
        $res = Auth::guard('web')->attempt(['name'=>$name,'password'=>$password]);
        if($res){
            throw new \Exception('账户或密码错误');
        }
        $adminUser = UserModel::where('name',$name)->where('password',$password)->first();
        Auth::login($adminUser);
        return true;
    }
}