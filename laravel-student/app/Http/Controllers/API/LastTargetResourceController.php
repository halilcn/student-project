<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LastTargetResource;
use App\Models\LastSchoolScore;
use App\Models\LastTarget;
use App\Models\Target;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LastTargetResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return LastTargetResource::collection($request->user()->lastTargets);
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
    public function store(Request $request)
    {
        //En son eklenmiyordu!!!

        $mainTarget = Target::findOrFail($request->targetId);

        if ($mainTarget->target_type === 'school_score') {
            $lessonsCount = $mainTarget->target->loadCount('lessons')->lessons_count;
            $successRate = collect($request->targetRates)->sum() / collect($request->targetRates)->count();

            $resLastSchoolScore = LastSchoolScore::create([
                'last_target_created_at' => $mainTarget->updated_at,
                'lessons_count' => $lessonsCount,
                'success_rate' => $successRate
            ]);

            $resLastSchoolScore->lastTarget()->create([
                'user_id' => Auth::id(),
                'last_target_type' => 'last_school_score'
            ]);

            $mainTarget->target->delete();

            return response()->json([
                'status' => 'success'
            ]);
        }


        // $mainTarget->target->delete();
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }
}
