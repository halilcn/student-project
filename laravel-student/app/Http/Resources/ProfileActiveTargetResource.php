<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileActiveTargetResource extends JsonResource
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
            'target_id' => $this->id,
            'target_type' => $this->targetable_type,
            'target_data' => $this->when($this->whenLoaded('targetable'), function () {
                switch (true) {
                    case $this->targetable instanceof \App\Models\SchoolScore:
                        return new ProfileActiveSchoolTargetResource($this->targetable);
                        break;

                    // others...
                }
            })
        ];
    }
}
