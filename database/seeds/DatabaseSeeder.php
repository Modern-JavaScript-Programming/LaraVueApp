<?php
// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            EngagementsSeeder::class,
            OtaceCriteriaSectionsSeeder::class,
            OtaceCriteriaSubSectionsSeeder::class,
            // RolesAndPermissionsSeeder::class,
            // OtaceFrequenciesSeeder::class,
            // SectionsSeeder::class,
            // SubSectionsSeeder::class,
            // FormFieldsSeeder::class,
        ]);
    }
}
