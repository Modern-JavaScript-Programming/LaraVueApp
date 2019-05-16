<?php
// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

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
        $engagementArr = array(
            array('name' => 'Business Services', 'status' => 'Active'),
            array('name' => 'sogeti UK', 'status' => 'Active'),
            array('name' => 'India Marcom', 'status' => 'Active'),
            array('name' => 'Australia', 'status' => 'Active'),
            array('name' => 'France', 'status' => 'Active'),
            array('name' => 'University', 'status' => 'Active'),
            array('name' => 'Germany', 'status' => 'Active'),
            array('name' => 'Netherlands', 'status' => 'Active'),
            array('name' => 'Italy', 'status' => 'Active'),
            array('name' => 'Finland', 'status' => 'Active'),
            array('name' => 'Sogeti', 'status' => 'Active'),
            array('name' => 'Poland', 'status' => 'Active'),
            array('name' => 'Mexico', 'status' => 'Active'),
            array('name' => 'Sogeti NL', 'status' => 'Active'),
            array('name' => 'Odigo', 'status' => 'Active'),
            array('name' => 'Denmark', 'status' => 'Active'),
            array('name' => 'Group', 'status' => 'Active'),
            array('name' => 'Japan', 'status' => 'Active'),
            array('name' => 'Group Sales', 'status' => 'Active'),
            array('name' => 'Belgium', 'status' => 'Active'),
            array('name' => 'UK CSR', 'status' => 'Active'),
            array('name' => 'CIS', 'status' => 'Active'),
            array('name' => 'Sogeti France', 'status' => 'Active'),
            array('name' => 'ODS', 'status' => 'Active'),
            array('name' => 'MACS Adminstration', 'status' => 'Active'),
            array('name' => 'sogeti US', 'status' => 'Active'),
            array('name' => 'Scandinavia', 'status' => 'Active'),
        );
        Engagement::insert($engagementArr);
    }
}
