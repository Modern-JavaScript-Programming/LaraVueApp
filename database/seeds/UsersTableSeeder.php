<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = 'saadling';
        $user->first_name = 'Sachin';
        $user->last_name = 'Adlinge';
        $user->email = 'sachin.adlinge@capgemini.com';
        $user->password = Hash::make('pass1234');
        $user->type = 'super-admin';
        $user->country = '';
        $user->status = 'Active';
        $user->save();

        //$user = User::where("email", "sachin.adlinge@capgemini.com")->first();
        //$user->assignRole('stakeholder');


        $user = new User();
        $user->name = 'kasarkar';
        $user->first_name = 'Kaushik';
        $user->last_name = 'Sarkar';
        $user->email = 'kaushik.a.sarkar@capgemini.com';
        $user->password = Hash::make('pass1234');
        $user->type = 'super-admin';
        $user->country = '';
        $user->status = 'Active';
        $user->save();

        //$user = User::where("email", "kaushik.a.sarkar@capgemini.com")->first();
        //$user->assignRole('stakeholder');

        //Uncomment this before making live

        //*************** IMPORTANT NOTES *******************/
        //Following records only for test and need to be deleted before making live
        //$user->assignRole('engagement-lead');

        $user = new User();
        $user->name = 'asarkar';
        $user->first_name = 'Arup';
        $user->last_name = 'Sarkar';
        $user->email = 'arup.sarkar@capgemini.com';
        $user->password = Hash::make('pass1234');
        $user->type = 'engagement-lead';
        $user->country = '';
        $user->status = 'Active';
        $user->save();


        //$user = User::where("email", "arup.sarkar@capgemini.com")->first();
        //$user->assignRole('stakeholder');

        $user = new User();
        $user->name = 'ahadkar';
        $user->first_name = 'Amit';
        $user->last_name = 'Hadkar';
        $user->email = 'amit.hadkar@capgemini.com';
        $user->password = Hash::make('pass1234');
        $user->type = 'financial';
        $user->country = '';
        $user->status = 'Active';
        $user->save();

        //$user = User::where("email", "amit.hadkar@capgemini.com")->first();

        //$user->assignRole('financial');
    }
}
