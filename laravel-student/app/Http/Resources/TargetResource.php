<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TargetResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'target_type' => $this->target_type,
            'target_data' => $this->when($this->whenLoaded('target'), function () {
                switch (true) {
                    case $this->target instanceof \App\Models\SchoolScore:
                        return new TargetSchoolResource($this->target);
                        break;

                    // others...
                }
            })
        ];
    }
}
