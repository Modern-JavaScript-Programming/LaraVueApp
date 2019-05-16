<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OtaceCriteriaSection; // Including Model

class OtaceCriteriaSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // fetch first 5 rows from database with pagination
        return OtaceCriteriaSection::latest()->paginate(5);
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
            'section_name' => 'required|string|max:191',
        ]);

        return OtaceCriteriaSection::create([
            'section_name' => $request['section_name']
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
        $otace_criteria_section = OtaceCriteriaSection::findOrFail($id);

        $this->validate($request, [
            'section_name' => 'required|string|max:191',
        ]);

        $otace_criteria_section->update($request->all());

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
        $otace_criteria_section = OtaceCriteriaSection::findOrFail($id);

        $otace_criteria_section->delete();

        return ['message' => 'Criteria Section Deleted'];
    }

    /**
     * Search Functionality.
     */
    public function search()
    {
        if ($search = \Request::get('q')) {
            $otace_criteria_section = OtaceCriteriaSection::where(function ($query) use ($search) {
                $query->where('section_name', 'LIKE', "%$search%");
            })->paginate(20);
        } else {
            $otace_criteria_section = OtaceCriteriaSection::latest()->paginate(5);
        }

        return $otace_criteria_section;
    }
}
