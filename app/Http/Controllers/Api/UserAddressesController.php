<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

class UserAddressesController extends Controller
{
    public function index(Request $request)
    {
        return $this->success($request->user());
        return $this->success($request->user()->addresses);
    }
}