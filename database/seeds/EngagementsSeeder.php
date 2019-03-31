<?php

use Illuminate\Database\Seeder;
use App\Engagement;
use App\EngagementUser;
use App\User;

class EngagementsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //*************** IMPORTANT NOTES *******************/
        //Following records only for test and need to be deleted before making live
        $engagement = new Engagement();
        $engagement->name = 'Sogeti';
        $engagement->status = 'Active';
        $engagement->save();

        $engagement = new Engagement();
        $engagement->name = 'United Kingdom';
        $engagement->status = 'Active';
        $engagement->save();

        $engagement = new Engagement();
        $engagement->name = 'Netherland';
        $engagement->status = 'Active';
        $engagement->save();

        $engagement = new Engagement();
        $engagement->name = 'Germany';
        $engagement->status = 'Active';
        $engagement->save();

        $engagement = new Engagement();
        $engagement->name = 'ODS';
        $engagement->status = 'Active';
        $engagement->save();

        //$engagementId = DB::getPdo()->lastInsertId();

        //$user = User::where("email", "arup.sarkar@capgemini.com")->first();

/*      $engagementUser = new EngagementUser();
        $engagementUser->engagement()->associate($engagement);
        $engagementUser->user()->associate($user);
        $engagementUser->status = 'Active';
        $engagementUser->save(); */

        //$user = User::where("email", "kaushik.a.sarkar@capgemini.com")->first();

/*      $engagementUser = new EngagementUser();
        $engagementUser->engagement()->associate($engagement);
        $engagementUser->user()->associate($user);
        $engagementUser->status = 'Active';
        $engagementUser->save(); */
    }
}
