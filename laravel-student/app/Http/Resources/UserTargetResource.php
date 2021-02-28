<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserTargetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'username' => $this->name,
            'image' => $this->image,
            'targets_success_rate' => $this->lastTargets->avg('lastTargetable.success_rate')
        ];
    }
}
