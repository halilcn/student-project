<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LastTargetResource extends JsonResource
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
            'last_target_type' => $this->last_targetable_type,
            'last_target_data' => $this->when($this->whenLoaded('lastTargetable'), function () {
                switch (true) {
                    case $this->lastTargetable instanceof \App\Models\LastSchoolScore:
                        return new LastTargetSchoolResource($this->lastTargetable);
                        break;


                    // others...
                }
            })
        ];
    }
}
