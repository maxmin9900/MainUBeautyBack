<?php

namespace App\Http\Resources;

use App\Models\Service\ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class ServiceProviderResource extends JsonResource
{
    private $service;

    /**
     * @param $service
     */
    public function __construct($service)
    {
        $this->service = $service;
    }


    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->service->id,
            'blockchain_id' => $this->service->blockchain_id,
            'score' => $this->service->score,
            'price' => $this->service->price,
            'provider' => [
                'name' => $this->service->User->name,
                'surname' => $this->service->User->surname,
                'avatar' => $this->service->User->getAvatar(),
            ],
            'service' => [
                'id' => $this->service->Service->id,
                'title' => $this->service->Service->title,
                'image' => $this->service->Service->image,
                'description' => $this->service->Service->description,
                'score' => $this->service->Service->score,
                'minPrice' => $this->service->Service->minPrice,
                'providersCount' => $this->service->Service->providersCount,
            ]
        ];
    }
}
