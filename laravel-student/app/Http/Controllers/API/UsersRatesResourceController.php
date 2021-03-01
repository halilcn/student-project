<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProfileActiveTargetResource;
use App\Http\Resources\ProfileInformationResource;
use App\Http\Resources\ProfileLastTargetResource;
use App\Http\Resources\UserTargetResource;
use App\Models\LastTarget;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;

class UsersRatesResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $listType = $request->listType;

        $users = User::query()
            ->select('id', 'name', 'image')
            ->with(
                [
                    'lastTargets:last_targetable_id,last_targetable_type,user_id',
                    'lastTargets.lastTargetable'
                ]
            )
            ->skip($request->usersSkipCount)
            ->take(5)
            ->get();

        return UserTargetResource::collection($users);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if ($request->type == 'profile') {
            return new ProfileInformationResource($user);
        } else {
            if ($request->type == 'activeTargets') {
                return ProfileActiveTargetResource::collection($user->profileActiveTargets);
            } else {
                if ($request->type == 'lastTargets') {
                    return ProfileLastTargetResource::collection($user->profileLastTargets);
                }
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
