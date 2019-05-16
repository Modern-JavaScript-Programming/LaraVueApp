<?php
// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

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
        $userArr = array(
         array('name' => 'saadling', 'first_name' => 'Sachin', 'last_name' => 'Adlinge', 'email' => 'sachin.adlinge@capgemini.com', 'password' =>Hash::make('pass1234'), 'type' =>'super-admin','country' =>'', 'status' => 'Active'),

         array('name' => 'arusarka', 'first_name' => 'Arup', 'last_name' => 'sarkar', 'email' => 'arup.sarkar@capgemini.com', 'password' =>Hash::make('pass1234'), 'type' =>'engagement-lead','country' =>'', 'status' => 'Active'),

         array('name' => 'kasarkar', 'first_name' => 'Kaushik', 'last_name' => 'Sarkar', 'email' => 'kaushik.a.sarkar@capgemini.com', 'password' =>Hash::make('pass1234'), 'type' =>'super-admin','country' =>'', 'status' => 'Active'),
        );
        User::insert($userArr);
    }
}
