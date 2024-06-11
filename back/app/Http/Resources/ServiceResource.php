<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
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
            'title' => $this->service->title,
            'image' => $this->service->image,
            'description' => $this->service->description,
            'score' => $this->service->score,
            'minPrice' => $this->service->minPrice,
            'providersCount' => $this->service->providersCount,
        ];
    }
}
