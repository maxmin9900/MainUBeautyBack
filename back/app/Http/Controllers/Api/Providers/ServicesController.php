<?php

namespace App\Http\Controllers\Api\Providers;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Providers\ServiceRequest;
use App\Http\Requests\Api\Providers\UpdateServiceRequest;
use App\Http\Resources\ServiceProviderResource;
use App\Models\Service\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ServicesController extends ApiController
{

    public function index(Request $request)
    {
        $services = auth()->user()
            ->Services()
            ->search($request->only('title'))
            ->orderBy('id', 'desc')
            ->paginate(10);
        return $this->successResponse([
            'serviceProviders' => ServiceProviderResource::collection($services->items()),
            'total' => $services->total(),
            'lastPage' => $services->lastPage(),
        ]);
    }

    public function store(ServiceRequest $request)
    {
        $serviceProvider = auth()
            ->user()
            ->Services()
            ->search($request->only('service_id'))
            ->first();
        $inputs = $request->only(['price', 'service_id', 'blockchain_id']);
        if ($serviceProvider) {
            $serviceProvider->update($inputs);
        } else {
            auth()
                ->user()
                ->Services()
                ->create($inputs);
        }
        return $this->successResponse('ok');
    }

    public function update(UpdateServiceRequest $request)
    {
        $serviceProvider = auth()
            ->user()
            ->Services()
            ->search($request->only('service_id'))
            ->first();
        if (!$serviceProvider) {
            return $this->error404Response("Service Not Found");
        }
        $serviceProvider->update([
            'trustedScore' => $request->get('totalScores') / $request->get('votes'),
            'popularScore' => $request->get('likes'),
        ]);
        auth()->user()->updateScores();
        return $this->successResponse('ok');
    }
}
