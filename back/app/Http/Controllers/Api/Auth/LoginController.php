<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Models\User\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LoginController extends ApiController
{
    public function index(LoginRequest $request)
    {
        $result = User::loginApi($request->get('token'));

        if ($result['status'] != 'ok') {
            return $this->error403Response($result['message']);
        }
        return $this->successResponse($result);
    }

    public function logout(Request $request)
    {
        Auth::user()->currentAccessToken()->delete();
        return $this->successResponse('ok');
    }
}
