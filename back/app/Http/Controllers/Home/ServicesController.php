<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Api\ApiController;
use App\Http\Resources\ServiceResource;
use App\Models\Service\Service;
use Illuminate\Http\Request;

class ServicesController extends ApiController
{
    public function index(Request $request)
    {
        $services = Service::search($request->only(['title', 'order']))
            ->paginate($request->get('perPage',10));

        return $this->successResponse([
            'services' => ServiceResource::collection($services->items()),
            'total' => $services->total(),
            'lastPage' => $services->lastPage(),
            'page' => $request->get('page', 1)
        ]);

    }

    public function show($id)
    {
        $service = Service::with(['Providers', 'Providers.User'])->find($id);

        if (!$service) {
            return $this->error404Response("Service Not Found");
        }

        return $this->successResponse([
            'service' => new ServiceResource($service)
        ]);
    }
}
