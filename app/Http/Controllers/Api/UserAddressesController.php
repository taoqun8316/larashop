<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use Illuminate\Http\Request;

class UserAddressesController extends Controller
{
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function index(Request $request)
    {
        return $this->success($this->user->addresses);
    }

    public function create()
    {
        return view('user_addresses.create_and_edit', ['address' => new UserAddress()]);
    }
}