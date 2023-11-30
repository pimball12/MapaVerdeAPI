<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $res = parent::toArray($request);
        // $res['garden'] = new GardenResource($this->whenLoaded('garden'));
        // $res['members'] = UserResource::collection($this->whenLoaded('members'));
        return $res;
    }
}
