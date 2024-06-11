<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\Auth\VerifyRequest;
use App\Models\User\User;

class VerifyController extends ApiController
{
    public function index(VerifyRequest $request)
    {
        $user = User::findByEmail($request->get('email'));

        if (!$user || $user->email_verified_at) {
            return $this->error400Response('Account Not Found');
        }
        $result = $user->canSendEmail();
        if (!$result['status']) {
            return $this->error400Response("You will not be able to send a request for another {$result['time']}");
        }
        $user->resendVerificationEmail();
        return $this->successResponse("ok");

    }
}
