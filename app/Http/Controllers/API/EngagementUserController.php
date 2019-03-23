<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Engagement;

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

        $engagement_id = Engagement::find($id);

        $engagement_user = [];

        foreach ($engagement_id->users as $user) {
            $engagement_user[] = $user->name;
        }

        return $engagement_user;
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
}
