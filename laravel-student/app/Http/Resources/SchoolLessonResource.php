<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SchoolLessonResource extends JsonResource
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
            'name' => $this->name,
            'credit' => $this->credit,
            'score' => [
                'first_exam' => $this->score->first_exam,
                'second_exam' => $this->score->second_exam,
                'average' => $this->score->average,
                'character' => $this->score->character,
            ]
        ];
    }
}
