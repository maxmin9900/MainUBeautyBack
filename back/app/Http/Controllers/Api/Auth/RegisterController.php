<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User\User;

class RegisterController extends ApiController
{
    public function index(RegisterRequest $request)
    {
        $result = User::registerUser($request->all());

        if ($result['status'] != 'ok') {
            return $this->error403Response($result['message']);
        }
        return $this->successResponse($result);
    }

}
