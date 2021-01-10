<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TargetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type' => ['required'],
            'lessonPerce.*' => ['required', 'numeric'],
            'lessons.*.name' => ['required'],
            'lessons.*.credit' => ['required'],
            'lessons.*.score.*' => ['required'],
            'lessons.*.score.characterScore' => ['alpha', 'max:2'],
            'lessons.*.score.avgScore' => ['numeric'],
            'lessons.*.score.firstExam' => ['numeric'],
            'lessons.*.score.secondExam' => ['numeric'],
            'totalAvg' => ['required', 'numeric'],
        ];
    }
}
