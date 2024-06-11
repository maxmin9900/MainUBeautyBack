<?php

namespace App\Http\Controllers\Api\Home;

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProviderResource;
use App\Models\User\User;
use Illuminate\Http\Request;

class SearchController extends ApiController
{
    public function index(Request $request)
    {
        $inputs = $request->only('service_id', 'service_name');
        $inputs['level'] = 2;
        $inputs['search'] = true;
        $inputs['order'] = 'trustedScore';
        $trustedProviders = User::search($inputs)
            ->orderBy('trustedScore', 'desc')
            ->paginate(4);

        $inputs['order'] = 'popularScore';
        $popularProviders = User::search($inputs)
            ->orderBy('popularScore', 'desc')
            ->paginate(4);

        return $this->successResponse([
            'trustedProviders' => [
                'items' => ProviderResource::collection($trustedProviders),
                'total' => $trustedProviders->total(),
                'lastPage' => $trustedProviders->lastPage(),
            ],
            'popularProviders' => [
                'items' => ProviderResource::collection($popularProviders),
                'total' => $popularProviders->total(),
                'lastPage' => $popularProviders->lastPage(),
            ],
        ]);
    }

    public function providers(Request $request)
    {
        $inputs = $request->only(['order', 'name', 'surname']);
        $inputs['level'] = 'providers';

        $users = User::search($inputs)->paginate();
        return $this->successResponse([
            'providers' => ProviderResource::collection($users->items()),
            'total' => $users->total(),
            'lastPage' => $users->lastPage(),
            'page' => $request->get('page', 1)
        ]);
    }
}
