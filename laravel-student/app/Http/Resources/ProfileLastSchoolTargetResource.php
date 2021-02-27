<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileLastSchoolTargetResource extends JsonResource
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
            'lessons_count' => $this->lessons_count,
            'success_rate' => $this->success_rate,
            'last_target_date' => $this->last_target_created_at
        ];
    }
}
