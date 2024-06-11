<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;


    protected function error403Response($data)
    {
        return response()
            ->json(
                ['message' => $data],
                403
            );
    }

    protected function successResponse($data = '')
    {
        return response()
            ->json(
                $data
            );
    }

    protected function error404Response($data = null)
    {
        return response()
            ->json(
                ['message' => $data],
                404
            );
    }
    protected function error400Response($data = null)
    {
        return response()
            ->json(
                ['message' => $data],
                400
            );
    }
    protected function error409Response($data = null)
    {
        return response()
            ->json(
                ['message' => $data],
                409
            );
    }
}
