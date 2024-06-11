<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Api\ApiController;
use App\Http\Requests\Api\AvatarRequest;
use App\Http\Resources\UserProfileResource;
use App\Services\Utility;
use function auth;

class ProfileController extends ApiController
{
    public function index()
    {
        return $this->successResponse(
            new UserProfileResource(auth()->user())
        );
    }

    public function avatar(AvatarRequest $request)
    {
        if (auth()->user()->avatar) {
            Utility::deleteFile(auth()->user()->avatar);
        }
        $file = Utility::uploadFile($request->file('avatar'));
        auth()->user()->update([
            'avatar'=>$file
        ]);
        return $this->successResponse('ok');
    }
}
