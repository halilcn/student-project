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
            'id' => $this->id,
            'target_type' => $this->target_type,
            'created_at' => $this->created_at,
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
