<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Engagement;
use App\User;

class EngagementUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Engagement::with('users')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $total_user = count($request->input('user_id'));

        $mapped_engagement_id = $request->input('engagement_id');

        foreach ($request->input('user_id') as $user_id) {
            $engagement_id = Engagement::find($mapped_engagement_id);

            $engagement_id->users()->attach($user_id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return Engagement::with('users')->where('id', $id)->get(['id', 'name']);

        $_engagement_id = Engagement::find($id);

        $_user_id = [];

        foreach ($_engagement_id->users as $user) {
            $_user_id[] = $user->id;
        }

        if (count($_user_id) >= 1) {
            $_not_engaged_user = User::whereIn('type', ['engagement-lead','stakeholder'])
                                ->whereNotIn('id', $_user_id)
                                ->get(['id', 'name','first_name','last_name']);
        }
        else {
            $_not_engaged_user =  User::whereIn('type', ['engagement-lead','stakeholder'])
                                    ->get(['id', 'name','first_name','last_name']);
        }
        return $_not_engaged_user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    /**
     * Load All Engagement Users
    */
    public function loadAllEngagementsUsers()
    {
        //return Engagement::withCount('users')->get();
        return Engagement::withCount('users')->having('users_count', '>', 0)->get();
    }
}
