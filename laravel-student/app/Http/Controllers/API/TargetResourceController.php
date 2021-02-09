<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\TargetRequest;
use App\Http\Resources\TargetResource;
use App\Models\Lesson;
use App\Models\LessonScore;
use App\Models\SchoolScore;
use App\Models\Target;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TargetResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->targetsCount) {
            return TargetResource::collection(
                $request->user()
                    ->targets
                    ->skip($request->targetsCount)
                    ->take(7)
            );
        }

        return TargetResource::collection(
            $request->user()
                ->targets
                ->take(7)
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TargetRequest $request)
    {

        if ($request->type == 'school_score') {

            // Create School Score
            $resSchoolScore = SchoolScore::create([
                'first_exam_percent' => $request->input('lessonPerce.firstExam'),
                'second_exam_percent' => $request->input('lessonPerce.secondExam'),
                'total_average' => $request->input('totalAvg')
            ]);

            // TargetResourceController Create
            $resSchoolScore->targets()->create([
                'user_id' => Auth::id(),
            ]);

            foreach ($request->input('lessons') as $lessonData) {
                // Create Lesson
                $resLesson = $resSchoolScore->lessons()->create([
                    'name' => $lessonData['name'],
                    'credit' => $lessonData['credit']
                ]);

                //Create Lesson Score
                $lessonScoreData = $lessonData['score'];
                $resLesson->score()->create([
                    'first_exam' => $lessonScoreData['firstExam'],
                    'second_exam' => $lessonScoreData['secondExam'],
                    'average' => $lessonScoreData['avgScore'],
                    'character' => $lessonScoreData['characterScore']
                ]);
            }
        }

        return new TargetResource(
            $request->user()
                ->targets
                ->first()
        );
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Target $target)
    {
        //Yetki varmı? Gerçekten o target'a sahip mi?
        //**/
        $target->targetable->delete();

        return response()->json([
            'status' => 'success'
        ]);
    }
}
