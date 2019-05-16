<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OtaceCriteriaSubsection; // Including Model

class OtaceCriteriaSubSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // fetch first 5 rows from database with pagination
        return OtaceCriteriaSubsection::latest()->paginate(5);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'subsection_name' => 'required|string|max:191',
            'subsection_desc' => 'required|string',
            'rating' => 'required'
        ]);

        return OtaceCriteriaSubsection::create([
            'section_id' => $request['section_id'],
            'subsection_name' => $request['subsection_name'],
            'subsection_desc' => $request['subsection_desc'],
            'rating' => $request['rating'],

        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $otace_criteria_subsection = OtaceCriteriaSubsection::findOrFail($id);

        $this->validate($request, [
            'subsection_name' => 'required|string|max:191',
            'subsection_desc' => 'required|string',
            'rating' => 'required'
        ]);

        $otace_criteria_subsection->update($request->all());

        return ['message' => 'Criteria Section Updated'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $otace_criteria_subsection = OtaceCriteriaSubsection::findOrFail($id);

        $otace_criteria_subsection->delete();

        return ['message' => 'Criteria Section Deleted'];
    }

     /**
     * Search Functionality.
     */
    public function search()
    {
        if ($search = \Request::get('q')) {
            $otace_criteria_subsection = OtaceCriteriaSubsection::where(function ($query) use ($search) {
                $query->where('subsection_name', 'LIKE', "%$search%");
            })->paginate(20);
        } else {
            $otace_criteria_subsection = OtaceCriteriaSubsection::latest()->paginate(5);
        }

        return $otace_criteria_subsection;
    }
}
