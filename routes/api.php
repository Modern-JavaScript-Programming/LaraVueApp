<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Creating routes for Resource Controller
Route::apiResources([
    'user' => 'API\UserController',
    'engagement' => 'API\EngagementController',
    'engagement-user' => 'API\EngagementUserController',
    'otace-criteria-section' => 'API\OtaceCriteriaSectionController',
    'otace-criteria-subsection' => 'API\OtaceCriteriaSubSectionController',
    ]);

// List of routes for customer methods
// Users resource routes
Route::get('findUser', 'API\UserController@search');
Route::get('all-users', 'API\UserController@loadAllUsers');
Route::get('findEngagementUser', 'API\EngagementUserController@search');
Route::get('loadAllEngagementsUsers', 'API\EngagementUserController@loadAllEngagementsUsers');

// Engagements resource routes
Route::get('findEngagement', 'API\EngagementController@search');
Route::get('all-engagements', 'API\EngagementController@loadAllEngagements');

// Otace Criteria Section
Route::get('findSections', 'API\OtaceCriteriaSectionController@search');

// Otace Criteria Subsection
Route::get('findSubsections', 'API\OtaceCriteriaSubSectionController@search');
