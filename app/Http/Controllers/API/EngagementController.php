<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Engagement;

class EngagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Engagement::latest()->paginate(5);
    }

    public function loadAllEngagements()
    {
        return Engagement::where('status', '=', 'active')->get(['id', 'name']);
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
        $this->validate($request, [
            'name' => 'required|string|max:191',
        ]);

        return Engagement::create([
            'name' => $request['name'],
            'status' => $request['status'],
        ]);
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
        $engagement = Engagement::findOrFail($id);

        $this->validate($request, [
            'name' => 'required|string|max:191',
        ]);

        $engagement->update($request->all());

        return ['message' => 'Engagement Updated'];
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
        $engagement = Engagement::findOrFail($id);
        // delete the Engagement

        $engagement->delete();

        return ['message' => 'Engagement Deleted'];
    }

    /**
     * Search Functionality.
     */
    public function search()
    {
        if ($search = \Request::get('q')) {
            $engagements = Engagement::where(function ($query) use ($search) {
                $query->where('name', 'LIKE', "%$search%");
            })->paginate(20);
        } else {
            $engagements = Engagement::latest()->paginate(5);
        }

        return $engagements;
    }
}
